<?php

namespace App\Http\Controllers\API;

use App\Case_client;
use App\Cases;
use App\Client_Note;
use App\Clients;
use App\Permission;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ClientProfileController extends Controller
{
    public function client_cases(Request $request, $id)
    {
        $api_token = $request->header('api_token');
        $user = check_api_token($api_token);
        if ($user) {
            $user_id = $user->id;
            $permission = Permission::where('user_id', $user_id)->first();
            $enabled = $permission->clients;
            if ($enabled == 'yes') {
                $data['client_note'] = Client_Note::select(['id','notes as note','user_id','client_id'])->where('client_id', $id)->paginate(20);
                $cases_selected = Case_client::where('client_id',$id)->select('case_id')->get()->toArray();
                $data['cases'] = Cases::with('category')->whereIn('id', $cases_selected)
                    ->select('cases.id','invetation_num','inventation_type','circle_num','court','first_session_date','to_whome')
                    ->paginate(20);
                return msgdata($request, success(), 'success', $data);
            } else {
                return response()->json(msg($request, not_acceptable(), 'permission_warrning'));
            }
        } else {
            return response()->json(msg($request, not_authoize(), 'not_authoize'));
        }
    }

    public function client_notes_pagination(Request $request, $id)
    {
        $api_token = $request->header('api_token');
        $user = check_api_token($api_token);
        if ($user) {
            $user_id = $user->id;
            $permission = Permission::where('user_id', $user_id)->first();
            $enabled = $permission->clients;
            if ($enabled == 'yes') {
                $client_profile = Client_Note::select(['id','notes as note','user_id','client_id'])->where('client_id', $id)->paginate(20);
                return msgdata($request, success(), 'success', $client_profile);
            } else {
                return response()->json(msg($request, not_acceptable(), 'permission_warrning'));
            }
        } else {
            return response()->json(msg($request, not_authoize(), 'not_authoize'));
        }
    }
    public function client_cases_pagination(Request $request, $id)
    {
        $api_token = $request->header('api_token');
        $user = check_api_token($api_token);
        if ($user) {
            $user_id = $user->id;
            $permission = Permission::where('user_id', $user_id)->first();
            $enabled = $permission->clients;
            if ($enabled == 'yes') {
                $cases_selected = Case_client::where('client_id',$id)->select('case_id')->get()->toArray();
                $client_profile = Cases::with('category')->whereIn('id', $cases_selected)
                    ->select('cases.id','invetation_num','inventation_type','circle_num','court','first_session_date','to_whome')
                    ->paginate(20);
                return msgdata($request, success(), 'success', $client_profile);
            } else {
                return response()->json(msg($request, not_acceptable(), 'permission_warrning'));
            }
        } else {
            return response()->json(msg($request, not_authoize(), 'not_authoize'));
        }
    }

    public function store(Request $request)
    {
//        $input = $request->all();
        $rules =
            [
                'note' => 'required',
                'client_id' => 'required|exists:clients,id',
            ];
         $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
             return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        } else {
            $api_token = $request->header('api_token');
            $auth_user = check_api_token($api_token);
            if (empty($auth_user)) {
                return response()->json(msg($request, not_authoize(), 'not_authoize'));
            }
            $input['notes'] = $request->note ;
            $input['user_id'] = $auth_user->id;
            $input['client_id'] = $request->client_id;
            if ($auth_user->parent_id != null) {
                $input['parent_id'] = $auth_user->parent_id;
            } else {
                $input['parent_id'] = $auth_user->id;
            }
            $data = Client_Note::create($input);
            $data = Client_Note::with('user')->select('id','notes as note','user_id','client_id')->whereId($data->id)->first();
            return msgdata($request, success(), 'success', $data);
        }
    }

    public function Edit_Note(Request $request)
    {
//        $input = $request->all();
        $rules =
            [
                'note' => 'required',
                'id'=>'required'
            ];
         $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
             return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        } else {
            $api_token = $request->header('api_token');
            $auth_user = check_api_token($api_token);
            if (empty($auth_user)) {
                return response()->json(msg($request, not_authoize(), 'not_authoize'));
            }
            if ($auth_user->type == 'admin') {
                $input['notes'] = $request->note;
                $data = Client_Note::find($request->id)->update($input);
                $data = Client_Note::with('user')->select('id','notes as note','user_id','client_id')->whereId($request->id)->first();
                return msgdata($request, success(), 'success', $data);
            } else {
                return response()->json(msg($request, not_acceptable(), 'permission_warrning'));
            }
        }
    }

    public function delte_Note(Request $request, $id)
    {
        $input = $request->all();
        $api_token = $request->header('api_token');
        $auth_user = check_api_token($api_token);
        if (empty($auth_user)) {
            return response()->json(msg($request, not_authoize(), 'not_authoize'));
        }
        if ($auth_user->type == 'admin') {
            Client_Note::findOrFail(intval($id))->delete();
            return msg($request, success(), 'success');
        } else {
            return response()->json(msg($request, not_acceptable(), 'permission_warrning'));
        }
    }
}
