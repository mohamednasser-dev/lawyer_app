<?php

namespace App\Http\Controllers\API;

use App\mohdr;
use App\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class mohdareenApiController extends Controller

{
    public function index(Request $request)
    {

        $api_token = $request->header('api_token');
        $user = check_api_token($api_token);
        if ($user) {
            $user_id = $user->id;
            $permission = Permission::where('user_id', $user_id)->first();
            $enabled = $permission->mohdreen;
            if ($enabled == 'yes') {
                $mohdrs = null;
                if ($user->parent_id != null) {
                    $mohdrs = mohdr::select('moh_Id', 'mokel_Name', 'khesm_Name', 'paper_Number', 'session_Date', 'status')
                        ->where('parent_id', $user->parent_id)->get();
                } else {
                    $mohdrs = mohdr::select('moh_Id', 'mokel_Name', 'khesm_Name', 'paper_Number', 'session_Date', 'status')
                        ->where('parent_id', $user->id)->get();
                }

                return msgdata($request, success(), 'success', $mohdrs);
            } else {
                return response()->json(msg($request, not_acceptable(), 'permission_warrning'));
            }
        } else {
            return response()->json(msg($request, not_authoize(), 'invalid_data'));
        }

    }

    public function store(Request $request)
    {
        $input = $request->all();
        $api_token = $request->header('api_token');
        $auth_user = check_api_token($api_token);
        if (empty($auth_user)) {
            return response()->json(msg($request, not_authoize(), 'invalid_data'));
        }
        if ($auth_user->type == 'User') {
            $rules =
                [
                    'court_mohdareen' => 'required',
                    'paper_type' => 'required',
                    'deliver_data' => 'required',
                    'paper_Number' => 'required',
                    'session_Date' => 'required',
                    'mokel_Name' => 'required|exists:clients,client_name',
                    'khesm_Name' => 'required|exists:clients,client_name',
                    'case_number' => 'required',
                    'notes' => 'required',
                ];
            $input['cat_id'] = $auth_user->cat_id;
        } else {
            $rules =
                [
                    'court_mohdareen' => 'required',
                    'paper_type' => 'required',
                    'deliver_data' => 'required',
                    'paper_Number' => 'required',
                    'session_Date' => 'required',
                    'mokel_Name' => 'required|exists:clients,client_name',
                    'khesm_Name' => 'required|exists:clients,client_name',
                    'case_number' => 'required',
                    'cat_id' => 'required|exists:categories,id',
                    'notes' => 'required',
                ];
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
             return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        } else {
            if ($auth_user->parent_id != null) {
                $input['parent_id'] = $auth_user->parent_id;
            } else {
                $input['parent_id'] = $auth_user->id;
            }
            $mohdr = mohdr::create($input);
            $mohdr = $mohdr->with('category')->latest()->first();
            return msgdata($request, success(), 'success', $mohdr);
        }
    }

    public function mohder_by_id(Request $request, $id)
    {
        $api_token = $request->header('api_token');
        $user = check_api_token($api_token);
        if (!$user) {
            return response()->json(msg($request, not_authoize(), 'invalid_data'));
        } else {
            $mohder_data = mohdr::where('moh_id', $id)->with('category')->first();
            return msgdata($request, success(), 'success', $mohder_data);
        }
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $api_token = $request->header('api_token');
        $auth_user = check_api_token($api_token);
        if (empty($auth_user)) {
            return response()->json(msg($request, not_authoize(), 'invalid_data'));
        }
        if ($auth_user->type == 'admin') {
            $rules =
                [
                    'moh_id' => 'required|exists:mohdrs,moh_id',
                    'court_mohdareen' => 'required',
                    'paper_type' => 'required',
                    'deliver_data' => 'required',
                    'paper_Number' => 'required',
                    'session_Date' => 'required',
                    'mokel_Name' => 'required',
                    'khesm_Name' => 'required',
                    'case_number' => 'required',
                    'cat_id' => 'required',
                    'notes' => 'required',

                ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                 return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
            }
            $mohdrs = mohdr::find(intval($id))->update($input);
            return msg($request, success(), 'success');
        } else {
            return response()->json(msg($request, not_acceptable(), 'permission_warrning'));
        }
    }

    public function destroy(Request $request, $id)
    {
        $api_token = $request->header('api_token');
        $auth_user = check_api_token($api_token);

        if (empty($auth_user)) {
            return response()->json(msg($request, not_authoize(), 'invalid_data'));
        }

        if ($auth_user->type == 'admin') {

            $mohdr = mohdr::findOrFail(intval($id))->delete();

            return msg($request, success(), 'success');
        } else {
            return response()->json(msg($request, not_acceptable(), 'permission_warrning'));

        }
    }


    public function updateStatus(Request $request, $id)
    {

        $api_token = $request->header('api_token');
        $user = check_api_token($api_token);
        if (!$user) {
            return response()->json(msg($request, not_authoize(), 'invalid_data'));
        } else {
            $status = false;
            $mohdar = mohdr::find($id);
            if ($mohdar->status == trans('site_lang.public_no_text')) {
                $mohdar->status = 'Yes';
                $status = true;
            } else {
                $mohdar->status = 'No';
                $status = false;
            }
            $mohdar->update();
            return msgdata($request, success(), 'success', $mohdar->status);

        }
    }
}
