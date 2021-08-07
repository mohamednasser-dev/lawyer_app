<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Session_Notes;
use App\Case_client;
use App\attachment;
use App\Permission;
use App\Sessions;
use App\category;
use App\Clients;
use App\Cases;
use Validator;
use App\User;

class casesApiController extends Controller
{
    //Cases Functions
    public function index(Request $request)
    {
        $user = check_api_token($request->header('api_token'));

        if ($user != null) {
            $permission = Permission::where('user_id', $user->id)->first();
            $enabled = $permission->search_case;
            if ($enabled == 'yes') {
                if ($user->parent_id == null) {
                    $cases = Cases::select('id', 'invetation_num', 'court', 'to_whome', 'parent_id')
                        ->where('parent_id', $user->id)
                        ->paginate(20);
                } else {
                    $cases = Cases::select('id', 'invetation_num', 'court', 'to_whome', 'parent_id')
                        ->where('to_whome', $user->cat_id)
                        ->where('parent_id', $user->parent_id)
                        ->paginate(20);
                }
                $cases->setCollection(
                    $cases->getCollection()
                        ->map(function ($data) {
                            $new_string = "";
                            $new_khesm = "";
                            foreach ($data->Clients_only as $row) {
                                $new_string = $new_string . $row->client_Name . ' , ';
                            }
                            foreach ($data->khesm_only as $row) {
                                $new_khesm = $new_khesm . $row->client_Name . ' , ';
                            }

                            $data->clients = rtrim($new_string, ", ");
                            $data->khesms = rtrim($new_khesm, ", ");
                            return $data;
                        })

                );
//                        ->map(function ($data) {
//                            $new_string = "";
//                            foreach ($data->Clients_only as $row) {
//                                $new_string = $new_string . $row->client_Name . ' , ';
//                            }
//
//                            $new_khesm = "";
//                            foreach ($data->khesm_only as $row) {
//                                $new_khesm = $new_khesm . $row->client_Name . ' , ';
//                            }
//                            $data->clients = $new_string;
//                            $data->khesms = $new_khesm;
//                            return $data;
//                        });
//                } else {
//                    $cases = Cases::select('id', 'invetation_num', 'court', 'parent_id')->with('Clients_only')->with('khesm_only')
//                        ->where('parent_id', '=', $user->id)
//                        ->paginate(20);
//                    $cases->setCollection(
//                        $cases->getCollection()
//                            ->map(function ($data) {
//                                $new_string = "";
//                                $new_khesm = "";
//                                foreach ($data->Clients_only as $row) {
//                                    $new_string = $new_string . $row->client_Name . ' , ';
//                                }
//                                foreach ($data->khesm_only as $row) {
//                                    $new_khesm = $new_khesm . $row->client_Name . ' , ';
//                                }
//
//                                $data->clients = rtrim($new_string, ", ");
//                                $data->khesms = rtrim($new_khesm, ", ");
//                                return $data;
//                            })
//
//                    );

//                    for ($i = 0; $i < count($cases); $i++) {
//                        $cases[$i]['clients'] =
//
//                        $new_string = "";
//                        foreach ($cases[$i]['Clients_only'] as $row) {
//                            $new_string = $new_string . $row->client_Name . ' , ';
//                        }
//                        $new_khesm = "";
//                        foreach ($cases[$i]['khesm_only'] as $row) {
//                            $new_khesm = $new_khesm . $row->client_Name . ' , ';
//                        }
//                        $cases[$i]['clients'] = $new_string;
//                        $cases[$i]['khesms'] = $new_khesm;
//
//                    }
//            }
                return sendResponse(200, trans('site_lang.data_dispaly_success'), $cases);
            } else {
                return sendResponse(401, trans('site_lang.permission_warrning'), null);
            }
        } else {
            return sendResponse(403, trans('site_lang.loginWarning'), null);
        }
    }

    public
    function search(Request $request)
    {

        $rules =
            [
                'search' => 'required|string',

            ];

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        }
        $api_token = $request->header('api_token');
        $user = User::where('api_token', $api_token)->first();
        if ($user && $api_token != null) {
            $user_id = $user->id;
            $permission = Permission::where('user_id', $user_id)->first();
            $enabled = $permission->search_case;
            if ($enabled == 'yes') {
                $cases = null;
                if ($user->parent_id != null) {
                    $cases = Cases::select('id', 'invetation_num', 'court', 'to_whome', 'parent_id')
                        ->where('to_whome', $user->cat_id)
                        ->where('parent_id', $user->parent_id);

                    $cases = $cases->where('court', 'like', '%' . $request->search . '%')
                        ->orWhere('invetation_num', 'like', '%' . $request->search . '%')
                        ->orwhereHas('clients', function ($q) use ($request) {
                            $q->where('client_Name', 'like', '%' . $request->search . '%');
                        });


                    $cases = $cases->paginate(20)->map(function ($data) {
                        $new_string = "";
                        foreach ($data->Clients_only as $row) {
                            $new_string = $new_string . $row->client_Name . ' , ';
                        }

                        $new_khesm = "";
                        foreach ($data->khesm_only as $row) {
                            $new_khesm = $new_khesm . $row->client_Name . ' , ';
                        }
                        $data->clients = $new_string;
                        $data->khesms = $new_khesm;
                        return $data;
                    });
                } else {

                    $cases = Cases::select('id', 'invetation_num', 'court', 'parent_id')
                        ->with('Clients_only')->with('khesm_only')
                        ->where('parent_id', '=', $user->id);

                    $cases = $cases->where('court', 'like', '%' . $request->search . '%')
                        ->orWhere('invetation_num', 'like', '%' . $request->search . '%')
                        ->orwhereHas('clients', function ($q) use ($request) {
                            $q->where('client_Name', 'like', '%' . $request->search . '%');
                        });


                    $cases = $cases->paginate(20);

                    for ($i = 0; $i < count($cases); $i++) {
                        $cases[$i]['clients'] =

                        $new_string = "";
                        foreach ($cases[$i]['Clients_only'] as $row) {
                            $new_string = $new_string . $row->client_Name . ' , ';
                        }
                        $new_khesm = "";
                        foreach ($cases[$i]['khesm_only'] as $row) {
                            $new_khesm = $new_khesm . $row->client_Name . ' , ';
                        }
                        $cases[$i]['clients'] = $new_string;
                        $cases[$i]['khesms'] = $new_khesm;

                    }
                }
                return sendResponse(200, trans('site_lang.data_dispaly_success'), $cases);
            } else {
                return sendResponse(401, trans('site_lang.permission_warrning'), null);
            }
        } else {
            return sendResponse(403, trans('site_lang.loginWarning'), null);
        }
    }

    public
    function store(Request $request)
    {
        $input = $request->all();
        $validate = null;
        $api_token = $request->header('api_token');
        $auth_user = User::where('api_token', $api_token)->first();
        if (empty($auth_user)) {
            return sendResponse(403, trans('site_lang.loginWarning'), null);
        }
        if ($auth_user->type == 'User') {
            $validate = Validator::make($request->all(), [
                'invetation_num' => 'required',
                'circle_num' => 'required',
                'first_session_date' => 'required',
                'inventation_type' => 'required',
                'descion' => 'required',
                'court' => 'required',
                'mokel_Names' => 'exists:clients,id',
                'khesm_Names' => 'exists:clients,id',
            ]);
            $input['to_whome'] = $auth_user->cat_id;
            $input['parent_id'] = $auth_user->parent_id;
        } else {
            $validate = Validator::make($request->all(), [
                'invetation_num' => 'required',
                'circle_num' => 'required',
                'first_session_date' => 'required',
                'inventation_type' => 'required',
                'descion' => 'required',
                'court' => 'required',
                'mokel_Names' => 'exists:clients,id',
                'khesm_Names' => 'exists:clients,id',
            ]);
            $data['to_whome'] = $request->to_whome;
            $input['parent_id'] = $auth_user->id;
        }
        if (!is_array($validate)) {
//                $input['parent_id']= getQuery();
            if ($request->mokel_Names != null && $request->khesm_Names != null) {
                $month = date('m', strtotime($request->first_session_date));
                $year = date('Y', strtotime($request->first_session_date));
//            // saving case data

                $case = Cases::create($input);
                $case['month'] = $month;
                $case['year'] = $year;
                $case->save();
                //saving session data
                $sessions = new Sessions();
                $sessions->session_date = $request->first_session_date;
                $sessions->case_Id = $case->id;
                $sessions->month = $month;
                $sessions->year = $year;

                if ($auth_user->parent_id != null) {
                    $sessions->parent_id = $auth_user->parent_id;
                } else {
                    $sessions->parent_id = $auth_user->id;
                }
                $sessions->save();
                // saving case clients data
                $res = array_merge($request->mokel_Names, $request->khesm_Names);
                foreach ($res as $client) {
                    Case_client::create(['case_id' => $case->id, 'client_id' => $client]);
                }
                return sendResponse(200, trans('site_lang.add_success'), $case);
            } else {
                return sendResponse(401, trans('site_lang.please_empty'), null);
            }

        } else {
            return sendResponse(401, $validate[0], null);
        }
    }

    public
    function update(Request $request)
    {
        $input = $request->all();
        $validate = Validator::make($input, [
            'case_id' => 'required|exists:cases,id',
            'invetation_num' => 'required',
            'circle_num' => 'required',
            'court' => 'required',
            'inventation_type' => 'required',
            'to_whome' => ''
        ]);
        if (!is_array($validate)) {
            $api_token = $request->header('api_token');
            $auth_user = User::where('api_token', $api_token)->first();
            $id = $request->case_id;
            unset($input['case_id']);
            if (empty($auth_user)) {
                $dataOut['status'] = false;
                return sendResponse(403, trans('site_lang.loginWarning'), $dataOut);
            } else {
                $case = Cases::where('id', $id)->update($input);
                $data = Cases::with('category')->where('id', $id)->first();

                if ($case == 1) {
                    return sendResponse(200, trans('site_lang.updatSuccess'), $data);
                } else {
                    return sendResponse(401, trans('site_lang.should_enter_correct'), null);
                }
            }
        } else {
            return sendResponse(401, $validate[0], null);
        }
    }

    public
    function select_data_to_add_case(Request $request)
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
                        $data['clients'] = Clients::select('id', 'client_Name')
                            ->where('type', 'client')
                            ->where('parent_id', $user->parent_id)
                            ->get();
                        $data['khesms'] = Clients::select('id', 'client_Name')
                            ->where('type', 'khesm')
                            ->where('parent_id', $user->parent_id)
                            ->get();
                        $data['categories'] = category::select('id', 'name')->where('parent_id', $user->parent_id)->get();
                    } else {
                        //type = user ->get all client with same cat_id of this user
                        $data['clients'] = Clients::select('id', 'client_Name')
                            ->where('type', 'client')
                            ->where('cat_id', $user->cat_id)
                            ->get();
                        $data['khesms'] = Clients::select('id', 'client_Name')
                            ->where('type', 'khesm')
                            ->where('cat_id', $user->cat_id)
                            ->get();
                        $data['categories'] = category::select('id', 'name')->where('parent_id', $user->cat_id)->get();
                    }
                } else {
                    $data['clients'] = Clients::select('id', 'client_Name')
                        ->where('type', 'client')
                        ->where('parent_id', $user_id)
                        ->get();
                    $data['khesms'] = Clients::select('id', 'client_Name')
                        ->where('type', 'khesm')
                        ->where('parent_id', $user_id)
                        ->get();
                    $data['categories'] = category::select('id', 'name')->where('parent_id', $user_id)->get();
                }
                return msgdata($request, success(), 'success', $data);
            } else {
                return response()->json(msg($request, not_acceptable(), 'permission_warrning'));
            }
        } else {
            return response()->json(msg($request, not_authoize(), 'not_authoize'));
        }
    }

    public
    function select_clients_to_add_new_client(Request $request, $case_id)
    {
        $api_token = $request->header('api_token');
        $user = check_api_token($api_token);
        if ($user) {
            $user_id = $user->id;
            $user_type = $user->type;
            $permission = Permission::where('user_id', $user_id)->first();
            $enabled = $permission->clients;
            if ($enabled == 'yes') {
                $clients = Case_client::where('case_id', $case_id)->select('client_id')->get()->toArray();
                if ($user->parent_id != null) {
                    if ($user_type == 'admin') {

                        $data['clients'] = Clients::select('id', 'client_Name')->whereNotIn('id', $clients)
                            ->where('type', 'client')
                            ->where('parent_id', $user->parent_id)
                            ->get();
                        $data['khesms'] = Clients::select('id', 'client_Name')->whereNotIn('id', $clients)
                            ->where('type', 'khesm')
                            ->where('parent_id', $user->parent_id)
                            ->get();
                    } else {
                        //type = user ->get all client with same cat_id of this user
                        $data['clients'] = Clients::select('id', 'client_Name')->whereNotIn('id', $clients)
                            ->where('type', 'client')
                            ->where('cat_id', $user->cat_id)
                            ->get();
                        $data['khesms'] = Clients::select('id', 'client_Name')->whereNotIn('id', $clients)
                            ->where('type', 'khesm')
                            ->where('parent_id', $user->cat_id)
                            ->get();
                    }
                } else {
                    $data['clients'] = Clients::select('id', 'client_Name')->whereNotIn('id', $clients)
                        ->where('type', 'client')
                        ->where('parent_id', $user_id)
                        ->get();
                    $data['khesms'] = Clients::select('id', 'client_Name')->whereNotIn('id', $clients)
                        ->where('type', 'khesm')
                        ->where('parent_id', $user_id)
                        ->get();
                }
                return msgdata($request, success(), 'success', $data);
            } else {
                return response()->json(msg($request, not_acceptable(), 'permission_warrning'));
            }
        } else {
            return response()->json(msg($request, not_authoize(), 'not_authoize'));
        }
    }

    public
    function caseData(Request $request, $id)
    {
        $api_token = $request->header('api_token');
        $user = User::where('api_token', $api_token)->first();
        if ($user != null) {
            $case_data = Cases::with('category')->select('id', 'invetation_num', 'inventation_type', 'circle_num', 'court', 'first_session_date', 'to_whome')->where('id', $id)
                ->first();
            $numbers['sessions_number'] = Sessions::where('case_Id', $id)->get()->count();
            $numbers['attachments_number'] = attachment::where('case_Id', $id)->get()->count();

            $ids = Sessions::where('case_Id', $id)->select('id')->get()->toArray();
            $numbers['notes_number'] = Session_Notes::whereIn('session_Id', $ids)->get()->count();
            $numbers['clients'] = Case_client::where('case_id', $id)->with('client_data')->whereHas('client_data', function ($query) {
                $query->where('type', 'client');
            })->get()->count();
            $numbers['khesm'] = Case_client::where('case_id', $id)->with('client_data')->whereHas('client_data', function ($query) {
                $query->where('type', 'khesm');
            })->get()->count();
            if ($case_data != null) {
                return sendResponse(200, trans('site_lang.data_dispaly_success'), array('case_data' => $case_data, 'numbers' => $numbers
                ));
            } else {
                return sendResponse(401, trans('site_lang.should_choose_case_models'), null);
            }
        } else {
            return sendResponse(403, trans('site_lang.loginWarning'), null);
        }
    }

    public
    function caseClientDataByID(Request $request, $id, $type)
    {

        $api_token = $request->header('api_token');
        $user = User::where('api_token', $api_token)->first();
        if ($user != null) {
            $client_data = [];
            $clients = Case_client::where('case_id', $id)->with('client_data')->whereHas('client_data', function ($query) use ($type) {
                $query->where('type', $type);
            })->get();
            foreach ($clients as $key => $row) {
                $client_data[$key]['id'] = $row->client_data->id;
                $client_data[$key]['client_Name'] = $row->client_data->client_Name;
                $client_data[$key]['client_Unit'] = $row->client_data->client_Unit;
                $client_data[$key]['client_Address'] = $row->client_data->client_Address;
                $client_data[$key]['notes'] = $row->client_data->notes;
                $client_data[$key]['type'] = $row->client_data->type;
                $client_data[$key]['parent_id'] = $row->client_data->parent_id;
                $client_data[$key]['cat_id'] = $row->client_data->cat_id;
            }

            return sendResponse(200, trans('site_lang.data_dispaly_success'), $client_data);
        } else {
            return sendResponse(403, trans('site_lang.loginWarning'), null);
        }
    }

    public
    function getSessionNotes(Request $request, $id)
    {
        $api_token = $request->header('api_token');
        $user = User::where('api_token', $api_token)->first();
        if ($user != null) {
            $session_Notes = Session_Notes::query()->where('session_Id', $id)->orderBy('id', 'desc')->get();
            if ($session_Notes != null) {
                return sendResponse(200, trans('site_lang.data_dispaly_success'), $session_Notes);
            } else {
                return sendResponse(401, trans('site_lang.should_choose_case'), null);
            }
        } else {
            return sendResponse(403, trans('site_lang.loginWarning'), null);
        }
    }

    public
    function destroy(Request $request, $id)
    {
        $api_token = $request->header('api_token');
        $user = User::where('api_token', $api_token)->first();
        if ($user != null) {
            $permission = Permission::where('user_id', $user->id)->first();
            $enabled = $permission->search_case;
            if ($enabled == 'yes') {
                Case_client::where('case_id', $id)->delete();
                $caseSessions = Sessions::where('case_id', $id)->get();
                foreach ($caseSessions as $caseSessions) {
                    $session_note = Session_Notes::where('session_Id', $caseSessions->id)->delete();
                    $caseSessions->delete();
                }
                Cases::where('id', $id)->delete();
                return sendResponse(200, trans('site_lang.case_deleted'), null);
            } else {
                return sendResponse(401, trans('site_lang.permission_warrning'), null);
            }
        } else {
            return sendResponse(403, trans('site_lang.loginWarning'), null);
        }
    }

//Case Clients Functions
    public
    function caseClientsData(Request $request)
    {
        $rules = [
            'api_token' => 'required',
            'case_id' => 'required|exists:cases,id',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return sendResponse(401, 'يرجى تسجيل الدخول ', null);
        } else {
            $api_token = $request->input('api_token');
            $user = User::where('api_token', $api_token)->first();
            if ($user != null) {
                $user_id = $user->id;

                $permission = Permission::where('user_id', $user_id)->first();

                $enabled = $permission->search_case;
                if ($enabled == 'yes') {
                    $case = Cases::findOrFail($request->case_id);
                    $clients = $case->clients;

                    return sendResponse(200, trans('site_lang.data_dispaly_success'), array('clients' => $clients));
                } else {
                    return sendResponse(401, trans('site_lang.permission_warrning'), null);
                }
            } else {
                return sendResponse(403, trans('site_lang.loginWarning'), null);
            }
        }
    }

    public
    function storeCaseClient(Request $request)
    {
        $input = $request->all();
        $rules = null;
        $api_token = $request->header('api_token');
        $auth_user = check_api_token($api_token);
        if (empty($auth_user)) {
            return response()->json(msg($request, not_authoize(), 'not_authoize'));
        } else {
            $rules = [
                'client_id' => 'required',
                'case_id' => 'required'
            ];
            $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
            } else {

                $input_new['case_id'] = $request->case_id;
                foreach ($request->client_id as $key => $row) {
                    $input_new['client_id'] = $row;
                    Case_client::create($input_new);
                }
                return msgdata($request, success(), 'success', null);
            }
        }
    }

    public
    function destroyCaseClient(Request $request)
    {
        $input = $request->all();
        $rules = null;
        $api_token = $request->header('api_token');
        $auth_user = check_api_token($api_token);
        if (empty($auth_user)) {
            return response()->json(msg($request, not_authoize(), 'not_authoize'));
        } else {
            $rules = [
                'client_id' => 'required|exists:clients,id',
                'case_id' => 'required|exists:cases,id'
            ];
            $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
            } else {
                Case_client::where('client_id', $request->client_id)->where('case_id', $request->case_id)->delete();
                return msg($request, success(), 'deleted_s');
            }
        }
    }

}
