<?php

namespace App\Http\Controllers\API;

use App\category;
use App\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        $api_token = $request->header('api_token');
        $user = check_api_token($api_token);
        if ($user) {
            $permission = Permission::where('user_id', $user->id)->first();
            $enabled = $permission->category;
            if ($enabled == 'yes') {
                if ($user->parent_id != null) {
                    $categories = category::where('parent_id', $user->parent_id)->paginate(20);
                } else {
                    $categories = category::where('parent_id', $user->id)->paginate(20);
                }
                return msgdata($request, success(), 'success', $categories);
            } else {
                return response()->json(msg($request, not_acceptable(), 'permission_warrning'));
            }
        } else {
            return response()->json(msg($request, not_authoize(), 'invalid_data'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $api_token = $request->header('api_token');
        $auth_user = check_api_token($api_token);
        if (empty($auth_user)) {
            return response()->json(msg($request, not_authoize(), 'invalid_data'));
        }

        $rules =
            [
                'name' => 'required',
            ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
             return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        } else {
            if ($auth_user->parent_id != null) {
                $input['parent_id'] = $auth_user->parent_id;
            } else {
                $input['parent_id'] = $auth_user->id;
            }
            $category = category::create($input);
            $category = $category::latest()->first();
            return msgdata($request, success(), 'success', $category);
        }
    }

    public function category_by_id(Request $request, $id)
    {

        $api_token = $request->header('api_token');
        $user = check_api_token($api_token);
        if (!$user) {
            return response()->json(msg($request, not_authoize(), 'invalid_data'));
        } else {
            $cat_data = category::whereId($id)->first();
            return msgdata($request, success(), 'success', $cat_data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
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
                    'name' => 'required',
                ];
                $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
             return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        }
                $input_data['name'] = $request->name;
            $category = category::find(intval($request->id))->update($input_data);
            $category = category::latest()->first();

            return msgdata($request, success(), 'success', $category);
        } else {
            return response()->json(msg($request, not_acceptable(), 'permission_warrning'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $api_token = $request->header('api_token');
        $auth_user = check_api_token($api_token);

        if (empty($auth_user)) {
            return response()->json(msg($request, not_authoize(), 'invalid_data'));
        }
        if ($auth_user->type == 'admin') {
            try{
                $mohdr = category::findOrFail(intval($id))->delete();
                return msg($request, success(), 'success');
            } catch (\Illuminate\Database\QueryException $e) {
                if ($e->getCode() == 23000) {
                    return msg($request, failed(), 'not_allow_delete_cat');
                }
            }
        } else {
            return response()->json(msg($request, not_acceptable(), 'permission_warrning'));

        }
    }
}
