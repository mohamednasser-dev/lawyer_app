<?php

namespace App\Http\Controllers\API;

use App\category;
use App\Clients;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Permission;
use App\User;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $api_token = $request->header('api_token');
        $user = check_api_token($api_token);
        if ($user) {
            $user_id = $user->id;
            $user_type = $user->type;
            $permission = Permission::where('user_id', $user_id)->first();
            $enabled = $permission->clients;
            if ($enabled == 'yes') {
                if ($user->parent_id != null) {
                    if ($user_type == 'admin') {
                        $clients = Clients::select('id', 'client_Name', 'client_Unit', 'client_Address', 'notes', 'type', 'parent_id', 'cat_id')->where('parent_id', $user->parent_id)
                            ->with('category')->paginate(20);
                    } else {
                        //type = user ->get all client with same cat_id of this user
                        $clients = Clients::select('id', 'client_Name', 'client_Unit', 'client_Address', 'notes', 'type', 'parent_id', 'cat_id')->where('cat_id', $user->cat_id)
                            ->with('category')->paginate(20);
                    }
                } else {
                    $clients = Clients::select('id', 'client_Name', 'client_Unit', 'client_Address', 'notes', 'type', 'parent_id', 'cat_id')->where('parent_id', $user_id)
                        ->with('category')
                        ->paginate(20);
                }
                return msgdata($request, success(), 'success', $clients);
            } else {
                return response()->json(msg($request, not_acceptable(), 'permission_warrning'));
            }
        } else {
            return response()->json(msg($request, not_authoize(), 'not_authoize'));
        }
    }

    public function search(Request $request)
    {

        $rules =
            [
                'name' => 'required|string',
                'case_id' => 'nullable|exists:cases,id'
            ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        }

        $api_token = $request->header('api_token');
        $user = check_api_token($api_token);
        if ($user && $api_token != null) {
            $user_id = $user->id;
            $user_type = $user->type;
            $permission = Permission::where('user_id', $user_id)->first();
            $enabled = $permission->clients;
            if ($enabled == 'yes') {
                if ($request->case_id != null) {
                    if ($user->parent_id != null) {
                        if ($user_type == 'admin') {
                            $clients = Clients::
                            select('id', 'client_Name', 'client_Unit', 'client_Address', 'notes', 'type', 'parent_id', 'cat_id')
                                ->where('parent_id', $user->parent_id)
                                ->where('client_Name', 'like', '%' . $request->name . '%')
                                ->whereHas('cases',function ($q) use ($request){
                                    $q->where('cases.id',$request->case_id);
                                })
                                ->with('category')
                                ->paginate(20);
                        } else {
                            //type = user ->get all client with same cat_id of this user
                            $clients = Clients::select('id', 'client_Name', 'client_Unit', 'client_Address', 'notes', 'type', 'parent_id', 'cat_id')
                                ->where('cat_id', $user->cat_id)
                                ->where('client_Name', 'like', '%' . $request->name . '%')
                                ->whereHas('cases',function ($q) use ($request){
                                    $q->where('cases.id',$request->case_id);
                                })
                                ->with('category')
                                ->paginate(20);
                        }
                    } else {
                        $clients = Clients::select('id', 'client_Name', 'client_Unit', 'client_Address', 'notes', 'type', 'parent_id', 'cat_id')
                            ->where('parent_id', $user_id)
                            ->where('client_Name', 'like', '%' . $request->name . '%')
                            ->whereHas('cases',function ($q) use ($request){
                                $q->where('cases.id',$request->case_id);
                            })
                            ->with('category')
                            ->paginate(20);
                    }
                } else {
                    if ($user->parent_id != null) {
                        if ($user_type == 'admin') {
                            $clients = Clients::select('id', 'client_Name', 'client_Unit', 'client_Address', 'notes', 'type', 'parent_id', 'cat_id')
                                ->where('parent_id', $user->parent_id)
                                ->where('client_Name', 'like', '%' . $request->name . '%')
                                ->with('category')
                                ->paginate(20);
                        } else {
                            //type = user ->get all client with same cat_id of this user
                            $clients = Clients::select('id', 'client_Name', 'client_Unit', 'client_Address', 'notes', 'type', 'parent_id', 'cat_id')
                                ->where('cat_id', $user->cat_id)
                                ->where('client_Name', 'like', '%' . $request->name . '%')
                                ->with('category')
                                ->paginate(20);
                        }
                    } else {
                        $clients = Clients::select('id', 'client_Name', 'client_Unit', 'client_Address', 'notes', 'type', 'parent_id', 'cat_id')
                            ->where('parent_id', $user_id)
                            ->where('client_Name', 'like', '%' . $request->name . '%')
                            ->with('category')
                            ->paginate(20);
                    }
                }
                return msgdata($request, success(), 'success', $clients);
            } else {
                return response()->json(msg($request, not_acceptable(), 'permission_warrning'));
            }
        } else {
            return response()->json(msg($request, not_authoize(), 'not_authoize'));
        }
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $rules = null;
        $api_token = $request->header('api_token');
        $auth_user = check_api_token($api_token);
        if (empty($auth_user)) {
            return response()->json(msg($request, not_authoize(), 'not_authoize'));
        } else {
            if ($auth_user->type == 'User') {
                $rules = [
                    'client_Name' => 'required',
                    'client_Unit' => 'required',
                    'client_Address' => 'required',
                    'notes' => 'required',
                    'type' => 'required|in:client,khesm'
                ];

                $input['cat_id'] = $auth_user->cat_id;
            } else {
                $rules = [
                    'client_Name' => 'required',
                    'client_Unit' => 'required',
                    'client_Address' => 'required',
                    'notes' => 'required',
                    'type' => 'required|in:client,khesm',
                    'cat_id' => 'required|exists:categories,id'
                ];
            }
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
            } else {
                if ($auth_user->parent_id != null) {
                    $parent_id = $auth_user->parent_id;
                } else {
                    $parent_id = $auth_user->id;
                }


                $input['parent_id'] = $parent_id;
                $data = Clients::create($input);
                $data = Clients::where('id', $data->id)->with('category')->first();
                return msgdata($request, success(), 'success', $data);
            }
        }
    }

    public function show(Request $request, $id)
    {
        $api_token = $request->header('api_token');
        $user = check_api_token($api_token);

        if ($user != null) {
            $client_data = Clients::select('id', 'client_Name', 'client_Unit', 'client_Address', 'notes', 'type', 'cat_id')->with('category')->find($id);
            if ($client_data != null) {
                return msgdata($request, success(), 'success', $client_data);
            } else {
                return response()->json(msg($request, failed(), 'data_invalid'));

            }
        } else {
            return response()->json(msg($request, not_authoize(), 'not_authoize'));
        }
    }

    public function update(Request $request)
    {
        $input = $request->all();
        $api_token = $request->header('api_token');
        $auth_user = check_api_token($api_token);
        $id = $request->input('client_id');
        $rules =
            [
                'client_id' => 'required|exists:clients,id',
                'client_Name' => 'required',
                'client_Unit' => 'required',
                'client_Address' => 'required',
                'notes' => 'required',
                'type' => 'required|in:client,khesm',
                'cat_id' => 'required|exists:categories,id'
            ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        }
        if (empty($auth_user)) {
            return response()->json(msg($request, not_authoize(), 'not_authoize'));
        }

        $user = Clients::find(intval($id))->update($input);
        $user = Clients::whereId(intval($id))->with('category')->first();
        return msgdata($request, success(), 'success', $user);

    }

    public function destroy(Request $request, $id)
    {
        $api_token = $request->header('api_token');
        $auth_user = check_api_token($api_token);
        if (empty($auth_user)) {
            return response()->json(msg($request, not_authoize(), 'not_authoize'));
        }
        $user = Clients::find(intval($id))->delete();
        return msg($request, success(), 'success');
    }
}
