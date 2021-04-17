<?php

namespace App\Http\Controllers\API;

use App\Permission;
use App\Sessions;
use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class sessionApiController extends Controller
{
    //Case Session Functions
    public function index(Request $request)
    {
        $rules = [
            'api_token'=>'required',
            'case_id'=>'required|exists:cases,id',
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            return sendResponse(401, 'يرجى تسجيل الدخول ',null);
        }
        else
        {
            $api_token = $request->input('api_token');
            $user = User::where('api_token',$api_token)->first();
            if($user != null){
                $user_id= $user->id;

                $permission = Permission::where('user_id', $user_id)->first();

                $enabled = $permission->search_case;
                if ($enabled == 'yes') {
                    $Sessionsdata = Sessions::where("case_id", "=", $request->case_id)->get();


                    return sendResponse(200, 'تم',array('SessionsData'=>$Sessionsdata));
                } else {
                    return sendResponse(401, trans('site_lang.permission_warrning'),null);
                }
            }else{
                return sendResponse(403, 'يرجى تسجيل الدخول ',null);
            }
        }
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validate = null;
        $validate_api = makeValidate($input,
            [
                'api_token' => 'required',

            ]);
             $validator = Validator::make($request->all(), $validate_api);
        if ($validator->fails()) {
             return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        }
        if (!is_array($validate_api)) {
            $api_token = $request->input('api_token');
            $auth_user = User::where('api_token', $api_token)->first();
            if (empty($auth_user)) {
                return sendResponse(403, 'يرجى تسجيل الدخول ', null);
            }
            if ($auth_user->type == 'User') {
                $validate = makeValidate($input,
                    [
                        'session_date' => 'required',
                        'case_Id' => 'required',
                    ]);
                $input['parent_id'] = $auth_user->parent_id;
            } else {
                $validate = makeValidate($input,
                    [
                        'session_date' => 'required',
                        'case_Id' => 'required',
                    ]);
                $input['parent_id'] = $auth_user->id;
            }
            $input['status'] = 'No';

            if (!is_array($validate)) {
//                $input['parent_id']= getQuery();
                if ($request->session_date != null ) {
                    $month = date('m', strtotime($request->session_date));
                    $year = date('Y', strtotime($request->session_date));
//            // saving case data
                    $input['month'] = $month;
                    $input['year'] = $year;
                    $sessions = Sessions::create($input);


                    return sendResponse(200, 'تم الاضافه بنجاح', $sessions);
                } else {

                    return sendResponse(403, "من فضلك قم بأختيار تاريخ الجلسة",null);
                }

            } else {
                return sendResponse(403, $validate[0], null);
            }
        }
        return sendResponse(403, "برجاء تسجيل الدخول", null);
    }

    public function show(Request $request)
    {
        $rules = [
            'api_token'=>'required',
            'session_id'=>'required|exists:sessions,id',
        ];
              $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
             return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        }
        else
        {
            $api_token = $request->input('api_token');
            $user = User::where('api_token',$api_token)->first();
            if($user != null){
                $user_id= $user->id;

                $permission = Permission::where('user_id', $user_id)->first();

                $enabled = $permission->search_case;
                if ($enabled == 'yes') {
                    $Sessiondata = Sessions::where("id", "=", $request->session_id)->get();


                    return sendResponse(200, 'تم',array('SessionData'=>$Sessiondata));
                } else {
                    return sendResponse(403, 'لا تمتلك الصلاحيه لدخول هذه الصفحه',null);
                }
            }else{
                return sendResponse(403, 'يرجى تسجيل الدخول ',null);
            }
        }
    }

    public function edit(Request $request)
    {

        $input = $request->all();
        $id = $request->session_id;
        $validate  =   makeValidate($input,
            [
                'api_token'=>'required',
                'session_id'=>'required|exists:sessions,id',
                'session_date' => 'required',

            ]);
 $validator = Validator::make($request->all(), $validate);
        if ($validator->fails()) {
             return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        }
        if (!is_array($validate))
        {

            $api_token =$request->input('api_token');
            $auth_user = User::where('api_token',$api_token)->first();
            if(empty($auth_user))
            {
                return sendResponse(403, 'يرجى تسجيل الدخول ',null);
            }

            $input['month']= date('m', strtotime($request->session_date));
            $input['year']= date('Y', strtotime($request->session_date));

            $Sessions = Sessions::find(intval($id))->update($input);

            return sendResponse(200, 'تم التعديل  بنجاح' ,$Sessions);
        }
        else
        {
            return sendResponse(403, $validate[0] ,null);
        }

    }

    public function changeSessionStatus(Request $request)
    {

        $input = $request->all();
        $id = $request->session_id;
        $validate  =   makeValidate($input,
            [
                'api_token'=>'required',
                'session_id'=>'required|exists:sessions,id',
            ]);
 $validator = Validator::make($request->all(), $validate);
        if ($validator->fails()) {
             return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        }
        if (!is_array($validate))
        {

            $api_token =$request->input('api_token');
            $auth_user = User::where('api_token',$api_token)->first();
            if(empty($auth_user))
            {
                return sendResponse(403, 'يرجى تسجيل الدخول ',null);
            }

            $status = false;
            $session = Sessions::find($id);
            if ($session->status== trans('site_lang.public_no_text')) {
                $session->status = "Yes";
                $status = true;
            } else {
                $session->status = "No";
                $status = false;
            }
            $session->update();

            return sendResponse(200, 'تم التعديل  الحالة بنجاح' ,$status);
        }
        else
        {
            return sendResponse(403, $validate[0] ,null);
        }
    }

    public function destroy(Request $request)
    {
        $input = $request->all();
        $validate  =   makeValidate($input,
            [
                'api_token'=>'required',
                'session_id'=>'required|exists:sessions,id',

            ]);
            
            
 $validator = Validator::make($request->all(), $validate);
        if ($validator->fails()) {
             return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        }
            
        if (!is_array($validate))
        {

            $api_token =$request->input('api_token');
            $auth_user = User::where('api_token',$api_token)->first();

            if(empty($auth_user))
            {
                return sendResponse(403, 'يرجى تسجيل الدخول ',null);
            }
            $user_id= $auth_user->id;
            $permission = Permission::where('user_id', $user_id)->first();

            $enabled = $permission->search_case;
            if ($enabled == 'yes') {

                $session = Sessions::find(intval($request->session_id))->delete();

                return sendResponse(200, 'تم حذف الجلسة  بنجاح' ,$session);
            } else {
                return sendResponse(403, 'لا تمتلك الصلاحيه لدخول هذه الصفحه',null);
            }



        }
        else
        {
            return sendResponse(403, $validate[0] ,null);
        }

    }

}
