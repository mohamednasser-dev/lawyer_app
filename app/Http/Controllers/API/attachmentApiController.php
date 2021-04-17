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
    public function index(Request $request)
    {
        $rules = [
            'api_token'=>'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            return sendResponse(401, 'يرجى تسجيل الدخول ',null);
        }else{
            $api_token = $request->input('api_token');
            $user = User::where('api_token',$api_token)->first();
            if($user != null){
                $user_id= $user->id;
                $permission = Permission::where('user_id', $user_id)->first();
                $enabled = $permission->search_case;
                if ($enabled == 'yes') {
                    $attachments = attachment::query()->where('case_id', $request->case_id)->get();
                    return sendResponse(200, ' ',array('attachments'=>$attachments));
                } else {
                    return sendResponse(401, trans('site_lang.permission_warrning'),null);
                }
            }else{
                return sendResponse(403, 'يرجى تسجيل الدخول ',null);
            }
        }
    }
}
