<?php

namespace App\Http\Controllers\API;

use App\ClientAttachment;
use App\Clients;
use App\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CientAttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {

        $api_token = $request->header('api_token');
        $user = check_api_token($api_token);
        if ($user) {
            $permission = Permission::where('user_id', $user->id)->first();
            $enabled = $permission->users;
            if ($enabled == 'yes') {

                $client_attachment = ClientAttachment::where('client_id', $id)->with('client')->get();
                return msgdata($request, success(), 'success', $client_attachment);

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
        $api_token = $request->header('api_token');
        $user = check_api_token($api_token);
        if ($user) {
            $rules =
                [
                    'img_Description' => 'required',
                    'img_Url' => 'required',
                    'client_id'=>'required|exists:clients,id'
                ];

            $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
             return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        }


            if ($request['img_Url'] != null) {
                // This is Image Information ...
                $file = $request->file('img_Url');
                $name = $file->getClientOriginalName();
                $ext = $file->getClientOriginalExtension();
                $size = $file->getSize();
                $path = $file->getRealPath();
                $mime = $file->getMimeType();

                // Move Image To Folder ..
                $fileNewName = 'img_' . time() . '.' . $ext;
                $file->move(public_path('uploads/client/attachments'), $fileNewName);

                $data = $request->all();
                $data['img_Url'] = $fileNewName;
            }


            $data['client_Id'] = $request->client_id;
            if ($user->parent_id != null) {
                $data['parent_id'] = $user->parent_id;
            } else {
                $data['parent_id'] = $user->id;
            }

            $attachment = ClientAttachment::create($data);
//         base url asset('/uploads/client/attachments/');
            return msgdata($request, success(), 'success', $attachment);


        } else {
            return response()->json(msg($request, not_authoize(), 'invalid_data'));
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
        $api_token = $request->header('api_token');
        $user = check_api_token($api_token);
        if ($user) {
            $rules =
                [
                    'img_Description' => 'required',
                    'img_Url' => 'sometimes|nullable',
                    'id'=>'required'
                ];

            $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
             return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        }


            if ($request['img_Url'] != null) {
                // This is Image Information ...
                $file = $request->file('img_Url');
                $name = $file->getClientOriginalName();
                $ext = $file->getClientOriginalExtension();
                $size = $file->getSize();
                $path = $file->getRealPath();
                $mime = $file->getMimeType();

                // Move Image To Folder ..
                $fileNewName = 'img_' . time() . '.' . $ext;
                $file->move(public_path('uploads/client/attachments'), $fileNewName);

                $data = $request->all();
                $data['img_Url'] = $fileNewName;
            }


            if ($user->parent_id != null) {
                $data['parent_id'] = $user->parent_id;
            } else {
                $data['parent_id'] = $user->id;
            }
            $data['img_Description'] = $request->img_Description;
            ClientAttachment::whereId($request->id)->update($data);
            $attachment = ClientAttachment::whereId($request->id)->with('client')->get();
//         base url asset('/uploads/client/attachments/');
            return msgdata($request, success(), 'success', $attachment);


        } else {
            return response()->json(msg($request, not_authoize(), 'invalid_data'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $api_token = $request->header('api_token');
        $user = check_api_token($api_token);
        if ($user) {
            if($user->type !='admin'){
                return response()->json(msg($request, not_acceptable(), 'permission_warrning'));

            }
            ClientAttachment::whereId($id)->delete();
            return msg($request, success(), 'success');


        } else {
            return response()->json(msg($request, not_authoize(), 'invalid_data'));

        }
    }
}
