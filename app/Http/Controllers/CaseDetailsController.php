<?php

namespace App\Http\Controllers;

use App\attachment;
use App\Case_client;
use App\Cases;
use App\category;
use App\Clients;
use App\Sessions;
use App\Session_Notes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PDF;
use App\Permission;


class CaseDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user_id = auth()->user()->id;
        $permission = Permission::where('user_id', $user_id)->first();
        $enabled = $permission->search_case;
        if ($enabled == 'yes') {
            if (request()->ajax()) {
                $user_type = auth()->user()->type;
                $case = '';
                if ($user_type == 'User') {
                    $case = Cases::query()
                        ->where('to_whome', '=', auth()->user()->cat_id)
                        ->where('parent_id', '=', getQuery())
                        ->with('clients')
                        ->get();
                } else {  //
                    $case = Cases::query()->with('clients')
                        ->where('parent_id', '=', getQuery())
                        ->get();
                }
                return datatables()->of($case)
                    ->addColumn('client_Name', function ($data) {
                        $button = '';
                        foreach ($data->Clients_only as $client) {
                            if ($button == '') {
                                $button = $client->client_Name;
                            } else
                                $button = $button . '  , ' . $client->client_Name;
                        }
                        return $button;
                    }) ->addColumn('khesm_Name', function ($data) {
                        $button = '';
                        foreach ($data->khesm_only as $client) {
                            if ($button == '') {
                                $button = $client->client_Name;
                            } else
                                $button = $button . '  , ' . $client->client_Name;
                        }
                        return $button;
                    })
                    ->addColumn('action', function ($data) {
                        $var = url('openCaseDetails/' . $data->id . '/show');
                        $button = '<a data-case-id="' . $data->id . '" id="showCaseData" class="btn btn-xs btn-primary" target="_blank"  href="' . $var . '"><i
                                    class="fa fa-eye-slash" ></i>&nbsp;&nbsp;' . trans('site_lang.home_see_more') . '</a>';
                        $button .= '&nbsp;&nbsp;';
                        if (auth()->user()->type == 'admin') {
                            $button .= '<a  data-case-id="' . $data->id . '" id="deletecase" class="btn btn-xs btn-danger" ><i
                                    class="fa fa-trash"></i>&nbsp;&nbsp;' . trans('site_lang.delete') . '</a>';
                        }
                        return $button;
                    })
                    ->rawColumns(['client_Name', 'action'])
                    ->make(true);
            }
            return view('cases.search_case');
        } else {
            return redirect(url('home'));
        }
    }

    public function getSearchResult($search)
    {
        $cases_table = array();
        if (!empty($search)) {
            $results = Cases::join('case_clients', 'case_clients.case_id', 'cases.id')
                ->join('clients', 'clients.id', 'case_clients.client_id')
                ->where('cases.to_whome', '=', auth()->user()->cat_id)
                ->where('cases.circle_num', 'LIKE', "%{$search}%")
                ->orWhere('clients.client_Name', 'LIKE', "%{$search}%")
                ->orWhere('cases.invetation_num', 'LIKE', "%{$search}%")
                ->select('cases.id', 'clients.client_Name', 'cases.invetation_num', 'cases.court')
                ->get();
            foreach ($results as $key => $result) {
                $cases_table[] = view('cases.session_result_case_item', compact('result'))->render();
            }
            return response(['status' => true, 'result' => array_unique($cases_table)]);
        }
    }

    // update session status from waiting to done
    public function updateStatus($id)
    {

        $status = false;
        $session = Sessions::find($id);
        if ($session->status == trans('site_lang.public_no_text')) {
            $session->status = "Yes";
            $status = true;
        } else {
            $session->status = "No";
            $status = false;
        }
        $session->update();

        return response(['msg' => trans('site_lang.public_success_text'), 'status' => $status]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        if ($request->ajax()) {

            $data = $this->validate(request(), [
                'session_Date' => 'required',
            ]);
            $session = new Sessions();
            $session->month = date('m', strtotime($request->session_Date));
            $session->year = date('Y', strtotime($request->session_Date));
            $session->case_Id = $request->case_Id;
            $session->parent_id = getQuery();
            $session->session_date = $request->session_Date;
            $session->save();
            return response(['status' => true, 'msg' => trans('site_lang.public_success_text')]);
        }
    }


    public function show($id)
    {
    }


    public function showSessionData($id)
    {
        if (request()->ajax()) {
            $data = Sessions::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function edit($id)
    {
        if (request()->ajax()) {
            $res = [];
            $case = Cases::findOrFail($id);
            $clients = $case->clients;
            $clients_array = [];
            $khesm_array = [];
            foreach ($clients as $key => $client) {
                if ($client->type == trans('site_lang.clients_client_type_khesm')) {
                    $khesm_array[] = view('cases.mokel_item', compact('client'))->render();
                } else {
                    $clients_array[] = view('cases.mokel_item', compact('client'))->render();
                }
            }
            $session = Sessions::select('id')->where('case_Id', $id)->get();
             $res = [
                "case" => $case,
                "to_whom" => $case->category->name,
                "clients" => $clients_array,
                "khesm" => $khesm_array,
                "client_count" => count($clients_array),
                "khesm_count" => count($khesm_array),
                "attachments_counts" => attachment::where('case_Id', $id)->count(),
                "sessions_counts" => $session->count(),
                "notes_count" => Session_Notes::whereIn('session_Id', $session->toArray())->get()->count(),
            ];
            return response()->json(['result' => $res]);
        }
    }

    public function openCaseDetails($id)
    {
        $categories = category::select('id', 'name')->where('parent_id', auth()->user()->id)->get();

        return view('cases.case_details', compact("id", "categories"));
    }


    public function update(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->validate(request(), [
                'session_Date' => 'required'
            ]);
            $session = Sessions::find($request->sessionId);
            $month = date('m', strtotime($request->session_date));
            $year = date('Y', strtotime($request->session_date));
            $session->month = $month;
            $session->year = $year;
            $session->session_date = $request->input('session_Date');
            $session->update();
            return response(['msg' => trans('site_lang.public_success_text')]);
        }
    }

    public function destroy($id)
    {
        $data = Sessions::findOrFail($id);
        $data->delete();
    }

    public function deleteClient($case_id, $client_id)
    {


        $data = Case_client::where("case_id", "=", $case_id)
            ->where("client_id", "=", $client_id)->first();
        $data->delete();
    }

    //sessions notes operations
    // get sessions notes for one session
    public function getSessionNotes($id)
    {

        return datatables()->of(Session_Notes::query()->where('session_Id', '=', $id)->orderBy('id', 'desc')->get())
            ->addColumn('status', function ($data) {
                if ($data->status == trans('site_lang.public_no_text')) {
                    $html = '<button class="btn btn-xs btn-danger" data-notes-Id="' . $data->id . '" id="change-note-status">
                             ' . $data->status . '</button>';
                } else {
                    $html = '<p class="btn btn-xs btn-success" data-notes-Id="' . $data->id . '" id="change-note-status">
                             ' . $data->status . '</p>';
                }

                return $html;
            })
            ->addColumn('action', function ($data) {
                $user_type = auth()->user()->type;
                if ($user_type == 'admin') {
                    $button = '<button data-notes-Id="' . $data->id . '" id="editNote" class="btn btn-xs btn-outline-primary" ><i
                                    class="fa fa-edit"></i>&nbsp;' . trans('site_lang.public_edit_btn_text') . '</button>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button data-notes-Id="' . $data->id . '" id="deleteNote"  class="btn btn-xs btn-danger" ><i
                                    class="fa fa-times fa fa-white"></i>&nbsp;' . trans('site_lang.public_delete_text') . '</button>';

                    return $button;
                }
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function getSessions($id)
    {
        return datatables()->of(Sessions::query()->where('case_Id', '=', $id)->orderBy('id', 'desc')->get())
            ->addColumn('status', function ($data) {
                if ($data->status == trans('site_lang.public_no_text')) {
                    $html = '<p class="btn btn-xs btn-danger text-bold" data-session-Id="' . $data->id . '" id="change-session-status">
                           ' . $data->status . '</p>';
                } else {
                    $html = '<p class="btn btn-xs btn-success text-bold" data-session-Id="' . $data->id . '" id="change-session-status">
                            ' . $data->status . '</p>';
                }

                return $html;
            })
            ->addColumn('action', function ($data) {
                $user_type = auth()->user()->type;
                if ($user_type == 'admin') {
                    $button = '<button data-session-Id="' . $data->id . '" id="editSession" class="btn btn-xs btn-outline-primary" ><i
                                    class="fa fa-edit"></i>&nbsp;' . trans('site_lang.public_edit_btn_text') . '</button>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button data-session-Id="' . $data->id . '" id="deleteSession"  class="btn btn-xs btn-outline-danger" ><i
                                    class="fa fa-times fa fa-white"></i>&nbsp;' . trans('site_lang.public_delete_text') . '</button>';
                    $button .= '&nbsp;&nbsp;';

                    $button .= '<button data-session-Id="' . $data->id . '" id="showSessionNotes"  class="btn btn-xs btn-outline-info" ><i
                                    class="fa fa-eye-slash"></i>&nbsp;' . trans('site_lang.mohdar_notes') . '</button>';
                } else {
                    $button = '<button data-session-Id="' . $data->id . '" id="showSessionNotes"  class="btn btn-xs btn-outline-info" ><i
                                    class="fa fa-eye-slash"></i>&nbsp;' . trans('site_lang.mohdar_notes') . '</button>';
                }
                return $button;
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function getClientByType($type, $caseId)
    {
        $exists_clients_ids = Case_client::select('client_id')->where("case_id", "=", $caseId)->get();
        $clients = Clients::query()->orWhereNotIn('id', $exists_clients_ids)
            ->where("type", "=", $type)->where('parent_id', '=', getQuery())->get();
        $clientsArr = array();
        foreach ($clients as $key => $client) {
            $id = $client['id'];
            $name = $client['client_Name'];
            $clientsArr[] = '<option value=' . $id . '>' . $name . '</option>';
        }
        return response()->json(['result' => $clientsArr]);
    }

    public function updateCase(Request $request)
    {

        $data = $this->validate(request(), [
            'invetation_num' => 'required',
            'circle_num' => 'required',
            'court' => 'required',
            'inventation_type' => 'required',
        ]);
        Cases::where('id', $request->caseId)->update($data);
        return response(['status' => true, 'msg' => trans('site_lang.public_success_text')]);
    }

    public function addNewClient(Request $request)
    {
        if ($request->ajax()) {

            $data = $this->validate(request(), [
                'mokel_name' => 'required',
            ]);
            $res = array_merge($request->mokel_name);
            $clients = array();
            foreach ($res as $item) {
                Case_client::create(['case_id' => $request->caseId, 'client_id' => $item]);
                $client = Clients::select('id', 'client_Name', 'type')->where('id', '=', $item)->first();
                $clients[] = view('cases.mokel_item', compact('client'))->render();
            }
            return response(['status' => true, 'msg' => trans('site_lang.public_success_text'), 'result' => $clients]);
        }
        return redirect()->route('cases.add_case')->with('success', 'Case Added successfully');
    }

    public function printSessionNotes($id)
    {

        $session_notes = Session_Notes::with('Session')
            ->where('session_Id', '=', $id)
            ->orderBy('id', 'desc')
            ->get();


        $pdf = PDF::loadView('Reports.SessionNotesPDF', ['data' => $session_notes]);

        return $pdf->stream('ملاحظات.' . 'pdf');
    }

    public function printCase($id)
    {
        $cases = Cases::query()->where("id", "=", $id)->get();

        $case = Cases::findOrFail($id);
        $clients = array();
        $khesm = array();
        foreach ($case->clients as $key => $client) {
            if ($client->type == trans('site_lang.clients_client_type_khesm')) {
                $khesm[] = $client;
            } else {
                $clients[] = $client;
            }
        }

        $Sessions = Sessions::with('notes')
            ->where('case_Id', '=', $id)
            ->get();

        $pdf = PDF::loadView('Reports.CasePDF', ['data' => $cases, 'clients' => $clients, 'khesm' => $khesm, 'Sessions' => $Sessions]);

        return $pdf->stream('My PDF' . 'pdf');
    }

    public function delete($id)
    {
        $caseclient = Case_client::where('case_id', $id)->get();

        foreach ($caseclient as $caseclient) {
            $caseclient->delete();
        }
        $caseAttachments = attachment::where('case_Id', $id)->get();

        foreach ($caseAttachments as $caseAttachment) {
            $caseAttachment->delete();
        }
        $caseSessions = Sessions::where('case_id', $id)->get();

        foreach ($caseSessions as $caseSessions) {
            $session_id = $caseSessions->id;

            $session_note = Session_Notes::where('session_Id', $session_id)->get();

            foreach ($session_note as $session_note) {
                $session_note->delete();
            }
            $caseSessions->delete();
        }

        Cases::where('id', $id)->delete();

        return response(['status' => true, 'msg' => trans('site_lang.public_success_text')]);
    }
}
