<?php

namespace App\Http\Controllers\API;

use App\Cases;
use App\Http\Controllers\Controller;
use App\Notifications\UserResetPasswordNotification;
use App\Point;
use App\Sessions;
use App\Verification;
use Illuminate\Http\Request;
use App\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Validator;
use App\User;
use PDF;

class AuthController extends Controller
{
    public $objectName;

    public function __construct(User $model)
    {
        $this->objectName = $model;
    }

    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
            'device_token' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        } else {
            if (Auth::attempt([
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ])) {
                if(Auth::user()->verified == '0'){
                    Auth::logout();
                    return msgdata($request, not_active(), 'verify_email_first', null);
                }
                if (Auth::user()->parent_id == null) {
                    $user = Auth::user();
                    $user->api_token = str_random(60);
                    $user->device_token = $request->device_token;
                    $user->save();
                    $permission = Permission::where('user_id', $user->id)->first();
                    if (Auth::user()->expiry_package == 'n') {
                        return msgdata($request, success(), 'login_success', array('user' => $user, 'permission' => $permission));
                    } else {
                        return msgdata($request, success(), 'package_ended', array('user' => $user, 'permission' => $permission));
                    }
                } else {
                    $parent_user = User::where('id', Auth::user()->parent_id)->first();
                    $user = Auth::user();
                    $user->api_token = str_random(60);
                    $user->device_token = $request->device_token;
                    $user->save();
                    $permission = Permission::where('user_id', $user->id)->first();
                    if ($parent_user->expiry_package == 'n') {
                        return msgdata($request, success(), 'login_success', array('user' => $user, 'permission' => $permission));
                    } else {
                        return msgdata($request, success(), 'package_ended', array('user' => $user, 'permission' => $permission));
                    }
                }
            } else {
                return response()->json(msg($request, failed(), 'login_warrning'));
            }
        }
    }

    public function verify_email(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'code' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        } else {
            $exists_email = Verification::where('email',$request->email)->where('code',$request->code)->first();
            if($exists_email){

                $user_data['api_token'] = str_random(60);
                $user_data['verified'] = '1' ;

                User::where('email',$exists_email->email)->update($user_data);

                if($exists_email->invite_code){
                    $winner_user = User::where('user_code',$exists_email->invite_code)->first();
                    $point = Point::where('type','friend')->first();
                    $winner_user->my_points = $winner_user->my_points + $point->points_num ;
                    $winner_user->save();
                }
                $exists_email->delete();
                $user = User::where('email',$exists_email->email)->first();
                $permission = Permission::where('user_id', $user->id)->first();
                return msgdata($request, success(), 'verify_email', array('user' => $user, 'permission' => $permission));
            }else{
                return response()->json(msg($request, failed(), 'verify_warrning'));
            }
        }
    }



    public function logout(Request $request)
    {
        $api_token = $request->header('api_token');
        $user = check_api_token($api_token);

        if (!$user) {
            return response()->json(msg($request, not_authoize(), 'not_authoize'));

        }
        $user->api_token = null;
        if ($user->save()) {
            return response()->json(msg($request, success(), 'logout_success'));

        } else {
            return response()->json(msg($request, not_authoize(), 'not_authoize'));
        }
    }

//    for test
    public function printCase(Request $request, $id)
    {

        $api_token = $request->api_token;
        $user = User::where('api_token', $api_token)->first();
        if ($user != null) {
            $cases = Cases::query()->where("id", $id)->get();
            $case = Cases::findOrFail($id);
            $clients = array();
            $khesm = array();
            foreach ($case->clients as $key => $client) {
                if ($client->type == trans('site_lang.clients_client_type_khesm')) {
                    $khesm[] = $client;
                } else {
                    $clients[] = $client;
                }
            }

            $Sessions = Sessions::with('notes')
                ->where('case_Id', $id)
                ->get();

            $pdf = PDF::loadView('Reports.CasePDF', ['data' => $cases, 'clients' => $clients, 'khesm' => $khesm, 'Sessions' => $Sessions]);

            return $pdf->stream('print.pdf', array("Attachment" => false));
        } else {
            return sendResponse(403, trans('site_lang.loginWarning'), null);
        }
    }

    public function resetPassword(Request $request)
    {

        $rules = [
            'email' => 'required|email|exists:users',

        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        }
        $code = rand(1000, 9999);
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->code = $code;
            $user->save();

            try {
//                Mail::raw('رمز استعاده كلمه المرور الخاصة بك: ' . $code, function ($message) use ($user) {
//                    $message->subject('تطبيق المحاماه');
//                    $message->from('taheelpost@gmail.com', 'taheelpost');
//                    $message->to($user->email);
//                });
                $user->notify(new UserResetPasswordNotification($code));
            } catch (\Swift_TransportException $e) {
                return response()->json(['status' => 401, 'msg' => $e->getMessage() . 'code is :' . $code]);
            }

            return response()->json(msg($request, success(), 'send_reset'));

        } else {
            return response()->json(msg($request, failed(), 'not_found'));

        }


    }

    public function codeCheck(Request $request)
    {
        $rules = [
            'code' => 'required|exists:users',
            'email' => 'required|exists:users',
            'device_token' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        }

        $user = User::where('code', $request->code)->where('email', $request->email)->first();
        if ($user->api_token == null) {
            $user->api_token = str_random(60);
            $user->device_token = $request->device_token;
            $user->save();
        }
        $permission = Permission::where('user_id', $user->id)->first();
        if ($user) {
            return response()->json(msgdata($request, success(), 'code_confirmed', array('user' => $user, 'permission' => $permission)));
        } else {
            return response()->json(msgdata($request, failed(), 'not_reseted', (object)[]));
        }
    }

    public function changePassword(Request $request)
    {
        $user = check_api_token($request->header('api_token'));
        $rules = [
            'old_password' => '',
            'password' => 'required|min:6',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        }
        if ($user != null) {
            if ($request->old_password == null) {
                $user->code = null;
                $user->password = Hash::make($request->password);
                $user->save();
                return response()->json(msg($request, success(), 'reseted'));
            } else {
                if (\Hash::check($request->old_password, $user->password)) {
                    $user->code = null;
                    $user->password = Hash::make($request->password);
                    $user->save();
                    return response()->json(msg($request, success(), 'reseted'));
                } else {
                    return sendResponse(401, trans('site_lang.check_pass_again'), null);
                }
            }
        } else {
            return sendResponse(403, trans('site_lang.loginWarning'), null);
        }
    }
}
