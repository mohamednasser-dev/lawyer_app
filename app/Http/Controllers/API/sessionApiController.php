<?php

namespace App\Http\Controllers\API;

use App\Permission;
use App\Session_Notes;
use App\Sessions;
use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class sessionApiController extends Controller
{
    //Case Session Functions
    public function index(Request $request, $id)
    {
        $api_token = $request->header('api_token');
        $user = User::where('api_token', $api_token)->first();
        if ($user != null) {
            $user_id = $user->id;
            $permission = Permission::where('user_id', $user_id)->first();
            $enabled = $permission->search_case;
            if ($enabled == 'yes') {
                $Sessionsdata = Sessions::select('id', 'session_date', 'status')->where("case_id", $id)->orderBy('created_at', 'desc')->paginate(20);
                return sendResponse(200, 'تم', $Sessionsdata);
            } else {
                return sendResponse(401, trans('site_lang.permission_warrning'), null);
            }
        } else {
            return sendResponse(403, trans('site_lang.loginWarning'), null);
        }
    }

    public function search(Request $request)
    {
        $rules =
            [
                'session_date' => 'required|date',
                'case_id' => 'required',

            ];

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        }
        $api_token = $request->header('api_token');
        $user = User::where('api_token', $api_token)->first();
        if ($user && $api_token != null) {
            $user_id = $user->id;
            $permission = Permission::where('user_id', $user_id)->first();
            $enabled = $permission->search_case;
            if ($enabled == 'yes') {
                $Sessionsdata = Sessions::select('id', 'session_date', 'status')
                    ->where("case_id", $request->case_id)
                    ->where('session_date', $request->session_date)
                    ->orderBy('created_at', 'desc')
                    ->paginate(20);
                return sendResponse(200, 'تم', $Sessionsdata);
            } else {
                return sendResponse(401, trans('site_lang.permission_warrning'), null);
            }
        } else {
            return sendResponse(403, trans('site_lang.loginWarning'), null);
        }
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $api_token = $request->header('api_token');
        $user = User::where('api_token', $api_token)->first();
        if ($user != null) {
            if ($user->type == 'User') {
                $validate = makeValidate($input,
                    [
                        'session_date' => 'required',
                        'case_Id' => 'required',
                    ]);
                $input['parent_id'] = $user->parent_id;
            } else {
                $validate = makeValidate($input,
                    [
                        'session_date' => 'required',
                        'case_Id' => 'required',
                    ]);
                $input['parent_id'] = $user->id;
            }
            $input['status'] = 'No';
            if (!is_array($validate)) {
                //$input['parent_id']= getQuery();
                if ($request->session_date != null) {
                    $month = date('m', strtotime($request->session_date));
                    $year = date('Y', strtotime($request->session_date));
                    // saving case data
                    $input['month'] = $month;
                    $input['year'] = $year;
                    $sessions = Sessions::create($input);
                    return sendResponse(200, 'تم الاضافه بنجاح', $sessions);
                } else {
                    return sendResponse(403, "من فضلك قم بأختيار تاريخ الجلسة", null);
                }
            } else {
                return sendResponse(403, $validate[0], null);
            }
        } else {
            return sendResponse(403, trans('site_lang.loginWarning'), null);
        }
    }

    public function show(Request $request)
    {
        $rules = [
            'api_token' => 'required',
            'session_id' => 'required|exists:sessions,id',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        } else {
            $api_token = $request->input('api_token');
            $user = User::where('api_token', $api_token)->first();
            if ($user != null) {
                $user_id = $user->id;

                $permission = Permission::where('user_id', $user_id)->first();

                $enabled = $permission->search_case;
                if ($enabled == 'yes') {
                    $Sessiondata = Sessions::where("id", "=", $request->session_id)->get();


                    return sendResponse(200, 'تم', array('SessionData' => $Sessiondata));
                } else {
                    return sendResponse(403, 'لا تمتلك الصلاحيه لدخول هذه الصفحه', null);
                }
            } else {
                return sendResponse(403, 'يرجى تسجيل الدخول ', null);
            }
        }
    }

    public function edit(Request $request)
    {
        $input = $request->all();
        $api_token = $request->header('api_token');
        $user = User::where('api_token', $api_token)->first();
        if ($user != null) {
            $validate = makeValidate($input,
                [
                    'session_id' => 'required|exists:sessions,id',
                    'session_date' => 'required',
                ]);
            if (!is_array($validate)) {
                $input['month'] = date('m', strtotime($request->session_date));
                $input['year'] = date('Y', strtotime($request->session_date));
                $Sessions = Sessions::find(intval($request->session_id))->update($input);
                $data = Sessions::find(intval($request->session_id));
                return sendResponse(200, 'تم التعديل  بنجاح', $data);
            } else {
                return sendResponse(403, $validate[0], null);
            }
        } else {
            return sendResponse(403, trans('site_lang.loginWarning'), null);
        }
    }

    public function changeSessionStatus(Request $request, $id)
    {

        $api_token = $request->header('api_token');
        $user = User::where('api_token', $api_token)->first();
        if ($user != null) {
            $status = false;
            $session = Sessions::find($id);
            if ($session->status == trans('site_lang.public_no_text')) {
                $session->status = "Yes";
                $status = true;
            } else {
                $session->status = "No";
                $status = false;
            }
            $session->update();
            $data = Sessions::select('status')->find($id)->status;
            return msgdata($request, success(), 'status_updated_s', $data);
        } else {
            return sendResponse(403, trans('site_lang.loginWarning'), null);
        }
    }

    public function destroy(Request $request, $id)
    {

        $api_token = $request->header('api_token');
        $user = User::where('api_token', $api_token)->first();
        if ($user != null) {
            $permission = Permission::where('user_id', $user->id)->first();
            $enabled = $permission->search_case;
            if ($enabled == 'yes') {
                Session_Notes::where('session_Id', $id)->delete();
                Sessions::findOrFail($id)->delete();
                return sendResponse(200, 'تم حذف الجلسة  بنجاح', null);

            } else {
                return sendResponse(401, trans('site_lang.permission_warrning'), null);
            }
        } else {
            return sendResponse(403, trans('site_lang.loginWarning'), null);
        }
    }
}
