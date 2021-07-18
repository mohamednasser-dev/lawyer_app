<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Permission;
use App\attachment;
use Validator;
use App\User;
class attachmentApiController extends Controller
{
    public function index(Request $request,$id)
    {
        $api_token = $request->header('api_token');
        $user = User::where('api_token', $api_token)->first();
        if ($user != null) {
            $user_id= $user->id;
            $permission = Permission::where('user_id', $user_id)->first();
            $enabled = $permission->search_case;
            if ($enabled == 'yes') {
                $attachments = attachment::select('id','img_Description','img_Url')->where('case_id', $id)->paginate(20);
                return sendResponse(200, trans('site_lang.data_dispaly_success'),$attachments);
            } else {
                return sendResponse(401, trans('site_lang.permission_warrning'),null);
            }
        } else {
            return sendResponse(403,  trans('site_lang.loginWarning'), null);
        }
    }


    public function search(Request $request)
    {

        $rules =
            [
                'img_Description' => 'required|string',
                'case_Id' => 'required',
            ];

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        }

        $api_token = $request->header('api_token');
        $user = User::where('api_token', $api_token)->first();
        if ($user && $api_token!= null) {
            $user_id= $user->id;
            $permission = Permission::where('user_id', $user_id)->first();
            $enabled = $permission->search_case;
            if ($enabled == 'yes') {
                $attachments = attachment::select('id','img_Description','img_Url')
                    ->where('img_Description','like','%'.$request->img_Description.'%')
                    ->where('case_id', $request->case_Id)
                    ->paginate(20);
                return sendResponse(200, trans('site_lang.data_dispaly_success'),$attachments);
            } else {
                return sendResponse(401, trans('site_lang.permission_warrning'),null);
            }
        } else {
            return sendResponse(403,  trans('site_lang.loginWarning'), null);
        }
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $api_token = $request->header('api_token');
        $user = User::where('api_token', $api_token)->first();
        if ($user != null) {
            $validate = makeValidate($input,
                [
                    'img_Description' => 'required',
                    'img_Url' => 'required',
                    'case_Id' => 'required|exists:cases,id',
                ]);
            if ($user->type == 'User') {
                $input['parent_id'] = $user->parent_id;
            } else {
                $input['parent_id'] = $user->id;
            }
            if (!is_array($validate)) {

                if($input['img_Url'] != null)
                {
                    // This is Image Information ...
                    $file	 = $request->file('img_Url');
                    $ext 	 = $file->getClientOriginalExtension();
                    // Move Image To Folder ..
                    $fileNewName = 'img_'.time().'.'.$ext;
                    $file->move(public_path('uploads/attachments'), $fileNewName);

                    $data = $request->all();
                    $input['img_Url'] = $fileNewName;
                }
                $attachment = attachment::create($input);
                return sendResponse(200, trans('site_lang.add_success'), $attachment);
            } else {
                return sendResponse(403, $validate[0], null);
            }
        } else {
            return sendResponse(403, trans('site_lang.loginWarning'), null);
        }
    }
    public function update(Request $request,$id)
    {
        $input = $request->all();
        $api_token = $request->header('api_token');
        $user = User::where('api_token', $api_token)->first();
        if ($user != null) {
            $validate = makeValidate($input,
                [
                    'img_Description' => 'required',
                    'img_Url' => '',
                ]);
//            dd($request->img_Url);
            if (!is_array($validate)) {
                if($request->img_Url != null)
                {

                    // This is Image Information ...
                    $file	 = $request->file('img_Url');
                    $ext 	 = $file->getClientOriginalExtension();
                    // Move Image To Folder ..
                    $fileNewName = 'img_'.time().'.'.$ext;
                    $file->move(public_path('uploads/attachments'), $fileNewName);

                    $data = $request->all();
                    $input['img_Url'] = $fileNewName;
                }
                attachment::where('id',$id)->update($input);
                $data = attachment::whereId($id)->first();
                return sendResponse(200, trans('site_lang.updatSuccess'), $data);
            } else {
                return sendResponse(401, $validate[0], null);
            }
        } else {
            return sendResponse(403, trans('site_lang.loginWarning'), null);
        }
    }

    public function destroy(Request $request,$id)
    {
        $api_token = $request->header('api_token');
        $user = User::where('api_token', $api_token)->first();
        if ($user != null) {
                $attachment = attachment::where('id',$id)->delete();
                return sendResponse(200, trans('site_lang.deleted') , $attachment);
        } else {
            return sendResponse(403, trans('site_lang.loginWarning'), null);
        }
    }
}
