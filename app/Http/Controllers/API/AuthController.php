<?php

namespace App\Http\Controllers\API;

use App\Cases;
use App\Http\Controllers\Controller;
use App\Sessions;
use Illuminate\Http\Request;
use App\Permission;
use Illuminate\Support\Facades\Auth;
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
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        } else {
            if (Auth::attempt([
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ])) {
                $user = Auth::user();
                $user->api_token = str_random(60);
                $user->save();
                $permission = Permission::where('user_id', $user->id)->first();
                return msgdata($request, success(), 'login_success', array('user' => $user, 'permission' => $permission));
            } else {

                return response()->json(msg($request, failed(), 'login_warrning'));
            }
        }
    }

    public function logout(Request $request)
    {
        $api_token = $request->header('api_token');
        $user = check_api_token($api_token);

        if (!$user) {
            return response()->json(msg($request, not_authoize(), 'invalid_data'));

        }
        $user->api_token = null;
        if ($user->save()) {
            return response()->json(msg($request, success(), 'logout_success'));

        } else {
            return response()->json(msg($request, not_authoize(), 'invalid_data'));
        }
    }



//    for test
    public function printCase(Request $request,$id)
    {

        $api_token = $request->header('api_token');
        $user = User::where('api_token', $api_token)->first();
        if ($user && $api_token != null) {
            $cases = Cases::query()->where("id",  $id)->get();
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

            return $pdf->stream('print.' . 'pdf');
        }else {
            return sendResponse(403, trans('site_lang.loginWarning'), null);
        }
    }

}
