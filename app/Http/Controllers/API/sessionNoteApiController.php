<?php

namespace App\Http\Controllers\API;

use App\Permission;
use App\Session_Notes;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Validator;
use PDF;


class sessionNoteApiController extends Controller
{
    public function index(Request $request, $id)
    {

        $api_token = $request->header('api_token');
        $user = User::where('api_token', $api_token)->first();
        if ($user != null) {
            $user_id = $user->id;
            $permission = Permission::where('user_id', $user_id)->first();
            $enabled = $permission->search_case;
            if ($enabled == 'yes') {
                $session_Notes = Session_Notes::with('user')->select('id', 'note', 'status','parent_id','updated_by')
                    ->where("session_id", $id)->paginate(20);
                return msgdata($request, success(), 'success', $session_Notes);
            } else {
                return sendResponse(401, trans('site_lang.permission_warrning'), null);
            }
        } else {
            return sendResponse(403, trans('site_lang.loginWarning'), null);
        }

    }

    public function print_session_notes(Request $request, $id)
    {
        $api_token = $request->api_token;
        $user = User::where('api_token', $api_token)->first();
        if ($user != null) {
            $notes = DB::table('session__notes')->where('session_Id', '=', $id)->orderBy('id', 'desc')->get();
            $pdf = PDF::loadView('exports.session_notes_export', compact('notes'));
            return $pdf->stream('document.pdf');
        } else {
            return sendResponse(403, trans('site_lang.loginWarning'), null);
        }
    }

    public function search(Request $request)
    {
        $rules =
            [
                'note' => 'required|string',
                'session_id' => 'required',
            ];

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        }

        $api_token = $request->header('api_token');
        $user = User::where('api_token', $api_token)->first();
        if ($user != null) {
            $user_id = $user->id;
            $permission = Permission::where('user_id', $user_id)->first();
            $enabled = $permission->search_case;
            if ($enabled == 'yes') {
                $session_Notes = Session_Notes::with('user')
                    ->select('id', 'note', 'status','parent_id')
                    ->where("note",'like', '%'.$request->note.'%')
                    ->paginate(20);
                return msgdata($request, success(), 'success', $session_Notes);
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
            $validate = makeValidate($input,
                [
                    'note' => 'required',
                    'session_Id' => 'required|exists:sessions,id',
                ]);
            if ($user->type == 'User') {
                $input['parent_id'] = $user->parent_id;
            } else {
                $input['parent_id'] = $user->id;
            }

            if (!is_array($validate)) {
                $input['updated_by'] = $user->id;
                $session_Notes = Session_Notes::create($input);

                $data = Session_Notes::where('id',$session_Notes->id)->select('id','note','parent_id','status','updated_by')->with('user')->first();

                return msgdata($request, success(), 'success', $data);
            } else {
                return sendResponse(401, $validate[0], null);
            }
        } else {
            return sendResponse(403, trans('site_lang.loginWarning'), null);
        }
    }

    public function changeNoteStatus(Request $request, $id)
    {
        $api_token = $request->header('api_token');
        $user = User::where('api_token', $api_token)->first();
        if ($user != null) {
            $status = false;
            $session_Notes = Session_Notes::find($id);
            if ($session_Notes->status == trans('site_lang.public_no_text')) {
                $session_Notes->status = "Yes";
                $status = true;
            } else {
                $session_Notes->status = "No";
                $status = false;
            }
            $session_Notes->update();
            $data = Session_Notes::select('status')->find($id)->status;
            return msgdata($request, success(), 'status_updated_s', $data);
        } else {
            return sendResponse(403, trans('site_lang.loginWarning'), null);
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
                    'id' => 'required|exists:session__notes,id',
                    'note' => 'required',
                ]);
            if ($user->type == 'User') {
                $input['parent_id'] = $user->parent_id;
            } else {

                $input['parent_id'] = $user->id;
            }
            if (!is_array($validate)) {
                $data['note'] = $request->note;
                Session_Notes::where('id',$request->id)->update($data);
                $data = Session_Notes::with('user')->select('id','note','parent_id','status')->whereId($request->id)->first()->makeHidden('parent_id');
                return msgdata($request, success(), 'updated_s', $data);
            } else {
                return sendResponse(401, $validate[0], null);
            }
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
                $session_Note = Session_Notes::find(intval($id))->delete();
                return sendResponse(200, 'تم حذف ملاحظة الجلسة بنجاح', $session_Note);
            } else {
                return sendResponse(401, trans('site_lang.permission_warrning'), null);
            }
        } else {
            return sendResponse(403, trans('site_lang.loginWarning'), null);
        }
    }
}
