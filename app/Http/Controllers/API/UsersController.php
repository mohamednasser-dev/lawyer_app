<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Permission;
use App\category;
use Illuminate\Support\Facades\Validator;
use App\User;
use PDOException;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $api_token = $request->header('api_token');
        $user = check_api_token($api_token);
        if ($user) {
            $user_id = $user->id;
            $permission = Permission::where('user_id', $user_id)->first();
            $enabled = $permission->users;
            if ($enabled == 'yes') {
                $users = null;
                if ($user->parent_id != null) {
                    $users = User::select('id', 'phone', 'address', 'name', 'email', 'type', 'parent_id', 'cat_id')
                        ->where('parent_id', $user->parent_id)->where('id', '!=', $user_id)->with('category')->paginate(10);
                } else {
                    $users = User::select('id', 'phone', 'address', 'name', 'email', 'type', 'parent_id', 'cat_id')
                        ->where('parent_id', $user_id)->where('id', '!=', $user_id)->with('category')->paginate(10);
                }
                return msgdata($request, success(), 'success', $users);

            } else {
                return response()->json(msg($request, not_acceptable(), 'permission_warrning'));

            }
        } else {
            return response()->json(msg($request, not_authoize(), 'invalid_data'));
        }
    }

    public function select_user(Request $request)
    {
        $api_token = $request->header('api_token');
        $user = check_api_token($api_token);
        if ($user) {
            $user_id = $user->id;
            $permission = Permission::where('user_id', $user_id)->first();
            $enabled = $permission->users;
            if ($enabled == 'yes') {
                $users = null;
                $categories = null;
                if ($user->parent_id != null) {
                    $user_data = User::select('name', 'type', 'email', 'phone', 'address', 'image', 'parent_id', 'cat_id')->where('parent_id', $user->parent_id)->with('category')->first();
                    $categories = category::where('parent_id', $user->parent_id)->select('id', 'name')->get();
                } else {
                    $user_data = User::select('id', 'name', 'type', 'email', 'phone', 'address', 'image', 'parent_id', 'cat_id')->where('parent_id', $user_id)->orWhere('id', $user_id)->with('category')->first();
                    $categories = category::where('parent_id', $user_id)->select('id', 'name')->get();
                }
                return msgdata($request, success(), 'success', array('user_data' => $user_data, 'categories' => $categories));

            } else {
                return response()->json(msg($request, not_acceptable(), 'permission_warrning'));
            }
        } else {
            return response()->json(msg($request, not_authoize(), 'invalid_data'));
        }
    }

    public function show(Request $request, $id)
    {
        $api_token = $request->header('api_token');
        $user = check_api_token($api_token);
        if ($user) {
            $user_id = $user->id;
            $permission = Permission::where('user_id', $user_id)->first();
            $enabled = $permission->users;
            if ($enabled == 'yes') {
                $users = null;
                $categories = null;
                if ($user->parent_id != null) {
                    $user_data = User::select('id', 'name', 'type', 'email', 'phone', 'address', 'image', 'cat_id')->with('category')->find($id);
                    $categories = category::where('parent_id', $user->parent_id)->select('id', 'name')->get();
                } else {
                    $user_data = User::select('id', 'name', 'type', 'email', 'phone', 'address', 'image', 'parent_id', 'cat_id')->where('parent_id', $user_id)->orWhere('id', $user_id)->with('category')->first();
                    $categories = category::where('parent_id', $user_id)->select('id', 'name')->get();
                }
                return msgdata($request, success(), 'success', array('user_data' => $user_data, 'categories' => $categories));
            } else {
                return response()->json(msg($request, not_acceptable(), 'permission_warrning'));
            }
        } else {
            return response()->json(msg($request, not_authoize(), 'invalid_data'));
        }
    }

    public function select_user_permission(Request $request, $id)
    {
        $api_token = $request->header('api_token');
        $user = check_api_token($api_token);
        if ($user) {
            $user_permissions = Permission::select('user_id', 'users', 'clients', 'addcases', 'search_case', 'mohdreen', 'category', 'daily_report', 'monthly_report')->where('user_id', $id)->first();
            return msgdata($request, success(), 'success', $user_permissions);

        } else {
            return response()->json(msg($request, not_authoize(), 'invalid_data'));
        }
    }

    public function update_permission(Request $request)
    {
        $rules = [
            'user_id' => 'required|exists:users,id',
            'users' => 'required',
            'clients' => 'required',
            'addcases' => 'required',
            'search_case' => 'required',
            'mohdreen' => 'required',
            'category' => 'required',
            'daily_report' => 'required',
            'monthly_report' => 'required'
        ];


        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        } else {
            $api_token = $request->header('api_token');
            $select_user_id = $request->input('user_id');
            $user = check_api_token($api_token);
            if ($user) {
                $data['users'] = $request->users;
                $data['clients'] = $request->clients;
                $data['addcases'] = $request->addcases;
                $data['search_case'] = $request->search_case;
                $data['mohdreen'] = $request->mohdreen;
                $data['category'] = $request->category;
                $data['daily_report'] = $request->daily_report;
                $data['monthly_report'] = $request->monthly_report;
                try {
                    $permission = Permission::where('user_id', $select_user_id)->update($data);
                } catch (QueryException $e) {
                    return msg($request, not_found(), 'Error');
                } catch (PDOException $e) {
                    return msg($request, not_found(), 'Error');
                }
                return msg($request, success(), 'per_updated');

            } else {
                return response()->json(msg($request, not_authoize(), 'invalid_data'));
            }
        }
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $rules =
            [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'phone' => 'required|numeric|unique:users',
                'address' => 'required',
                'password' => 'required|min:6',
                'type' => 'required|in:admin,User',
                'cat_id' => 'required|exists:categories,id'
            ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        } else {

            $api_token = $request->header('api_token');
            $auth_user = check_api_token($api_token);

            if (empty($auth_user)) {
                return response()->json(msg($request, not_authoize(), 'invalid_data'));
            }
            $input['password'] = bcrypt(request('password'));
            if ($auth_user->parent_id != null) {
                $input['parent_id'] = $auth_user->parent_id;
            } else {
                $input['parent_id'] = $auth_user->id;
            }

            $input['package_id'] = $auth_user->package_id;
            $user = User::create($input);
            $user_id = $user->id;
            $permissions['user_id'] = $user_id;
            $per = Permission::create($permissions);
            $per->save();
            $user = User::where('id', $user->id)->with('category')->first();
            return msgdata($request, success(), 'success', $user);


        }
    }

    public function update(Request $request)
    {
        $input = $request->all();
        $api_token = $request->header('api_token');
        $auth_user = check_api_token($api_token);
        $id = $request->input('user_id');
        $rules =
            [
                'user_id' => 'required|exists:users,id',
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $id,
                'phone' => 'required|numeric|unique:users,phone,' . $id,
                'address' => 'required',
                'type' => 'required|in:admin,User',
                'cat_id' => 'required|exists:categories,id'
            ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        } else {
            if (empty($auth_user)) {
                return response()->json(msg($request, not_authoize(), 'invalid_data'));
            }

            User::find(intval($id))->update($input);
            $user = User::where('id', $id)->with('category')->first();
            return msgdata($request, success(), 'success', $user);


        }
    }
    public function update_profile(Request $request){
        $input = $request->all();
        $api_token = $request->header('api_token');
        $auth_user = check_api_token($api_token);
        $id = $auth_user->id ;
        $rules =
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $id,
                'phone' => 'required|numeric|unique:users,phone,' . $id,
                'pasword' => 'nullable'
            ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        } else {
            if (empty($auth_user)) {
                return response()->json(msg($request, not_authoize(), 'invalid_data'));
            }
            if($request->password != null){
                $input['password'] = bcrypt(request('password'));
            }else{
                unset($input['password']);
            }
            User::find(intval($id))->update($input);
            $user = User::where('id',$id)->with('category')->first();
            $permission = Permission::where('user_id', $user->id)->first();
            return msgdata($request, success(), 'success',  array('user' => $user, 'permission' => $permission));
        }
    }

    public
    function destroy(Request $request, $id)
    {
        $api_token = $request->header('api_token');
        $auth_user = check_api_token($api_token);
        if (empty($auth_user)) {
            return response()->json(msg($request, not_authoize(), 'invalid_data'));
        }
        $permission = Permission::where('user_id', $id)->delete();
        $user = User::find(intval($id))->delete();
        return msg($request, success(), 'success');
    }
}
