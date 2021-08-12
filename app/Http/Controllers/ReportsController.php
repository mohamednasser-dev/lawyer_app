<?php

namespace App\Http\Controllers;

use App\Cases;
use App\Permission;
use Illuminate\Http\Request;
use App\Sessions;
use App\category;
use Illuminate\Support\Facades\DB;
use PDF;

// use Dompdf\Dompdf;


class ReportsController extends Controller
{
    public $objectName;
    public $folderView;
    public $flash;


    public function __construct(Sessions $model)
    {
        // $this->middleware('auth');
        $this->objectName = $model;
        $this->folderView = 'Reports.';
        $this->flash = 'Product Data Has Been ';

    }

    public function index()
    {
        $user_id = auth()->user()->id;
        $permission = Permission::where('user_id', $user_id)->first();
        $enabled = $permission->daily_report;
        $categories = category::select('id', 'name')->where('parent_id', getQuery())->get();

        if ($enabled == 'yes') {
            return view('Reports.CasesDailyReport', compact('categories'));
        } else {
            return redirect(url('home'));
        }
    }

    public function monthlyPage()
    {
        $user_id = auth()->user()->id;
        $permission = Permission::where('user_id', $user_id)->first();
        $categories = category::select('id', 'name')->where('parent_id', getQuery())->get();
        $enabled = $permission->monthly_report;
        if ($enabled == 'yes') {
            return view('Reports.CasesMonthlyReport', compact('categories'));

        } else {
            return redirect(url('home'));
        }
    }


    public function create()
    {
        //
    }

    public function search(Request $request)
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }


    public function edit($searchDate, $type)
    {
        $sessions_table = array();
        $khesm = null;
        $clients = null;
        $results = null;

        if ($type == 'all') {
            $results = Sessions::with('cases', 'Printnotes')
                ->where('session_date', '=', $searchDate)
                ->where('parent_id', getQuery())
                ->get();
        } else {
            $results = Sessions::with('cases', 'Printnotes')
                ->where('session_date', '=', $searchDate)
                ->where('parent_id', getQuery())
                ->whereHas('cases', function ($q) use ($type) {
                    $q->where('to_whome', '=', $type);
                })
                ->get();
        }

        foreach ($results as $result) {
            $case = Cases::findOrFail($result->case_Id);
            $clients = $case->clients;
            foreach ($clients as $key => $client) {
                if ($client->type == trans('site_lang.clients_client_type_khesm')) {
                    $khesm = $client;
                } else {
                    $clients = $client;
                }
            }

            $sessions_table [] = view('Reports.reports_daily_item', compact('result', 'clients', 'khesm'))->render();
        }
        return response(['status' => true, 'result' => $sessions_table]);
    }

    public function searchMonthly($month, $year, $type)
    {
        $sessions_table = array();

//        if ($type == 'all') {
//            $results = Sessions::with('cases', 'Printnotes')
//                ->where('month', '=', $month)
//                ->where('year', '=', $year)
//                ->where('parent_id',getQuery())
//                ->get();
//        } else {
//            $results = Sessions::with('cases', 'Printnotes')
//                ->where('month', '=', $month)
//                ->where('year', '=', $year)
//                ->where('parent_id',getQuery())
//                ->whereHas('cases', function ($q) use ($type) {
//                    $q->where('to_whome', '=', $type);
//                })
//                ->get();
//        }
//
//
//        foreach ($results as $result) {
//            $case = Cases::findOrFail($result->case_Id);
//            $clients = $case->clients;
//
//            foreach ($clients as $key => $client) {
//                if ($client->type == trans('site_lang.clients_client_type_khesm')) {
//                    $khesm = $client;
//                } else {
//                    $clients = $client;
//                }
//            }
        $data = Sessions::with('cases', 'Printnotes', 'clients')
            ->where('month', '=', $month)
            ->where('year', '=', $year)
            ->where('parent_id', getQuery())
            ->whereHas('cases', function ($q) use ($type) {
                if ($type != 0) // for get reports with some category if equal 0 will get all categories reports
                    $q->where('to_whome', '=', $type);
            })->get()
            ->map(function ($data) {
                $new_string = "";
                $new_khesm = "";
                foreach ($data as $report) {
                    foreach ($report->clients as $result) {
                        if ($result->client_type == trans("site_lang.clients_client_type_khesm")) {
                            $new_khesm = $new_khesm . $result->client_Name . ' , ';
                        } else
                            $new_string = $new_string . $result->client_Name . ' , ';
                    }

                    $data->client = rtrim($new_string, ", ");
                    $data->khesm = rtrim($new_khesm, ", ");
                    unset($data->clients);
                    $sessions_table [] = view('Reports.reports_daily_item', compact('report'))->render();
                }
//                return $data;
            });

//        }
        return response(['status' => true, 'result' => $sessions_table]);
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function pdfexport($id, $type)
    {
        $khesm = null;
        $clients = null;
        if ($type == 'all') {
            $data = Sessions::with('cases', 'Printnotes')
                ->where('session_date', $id)
                ->where('parent_id', getQuery())
                ->get();
        } else {
            $data = Sessions::with('cases', 'Printnotes')
                ->where('session_date', '=', $id)
                ->where('parent_id', getQuery())
                ->whereHas('cases', function ($q) use ($type) {
                    $q->where('to_whome', '=', $type);
                })
                ->get();
        }

        if ($data->count() > 0) {
            foreach ($data as $result) {
                $case = Cases::findOrFail($result->case_Id);
                $clients = $case->clients;

                foreach ($clients as $key => $client) {
                    if ($client->type == trans('site_lang.clients_client_type_khesm')) {
                        $khesm = $client;
                    } else {
                        $clients = $client;
                    }
                }
            }

            return view('Reports.DailyPDF', compact('data', 'khesm', 'clients', 'id'));
        } else {

            return view('Reports.DailyPDF', compact('data', 'khesm', 'clients', 'id'));
        }
    }

    public function pdfMonthexport($month, $year, $type)
    {

        if ($type == 'all') {
            $data = Sessions::with('cases', 'Printnotes')
                ->where('month', '=', $month)
                ->where('year', '=', $year)
                ->where('parent_id', getQuery())
                ->get();
        } else {
            $data = Sessions::with('cases', 'Printnotes')
                ->where('month', '=', $month)
                ->where('year', '=', $year)
                ->where('parent_id', getQuery())
                ->whereHas('cases', function ($q) use ($type) {
                    $q->where('to_whome', '=', $type);
                })
                ->get();
        }
        $khesm = null;
        $case_client = null;

        $khesm_arr[] = null;
        $client_arr[] = null;
//    if($data->count() > 0){

        foreach ($data as $result) {
            $case = Cases::findOrFail($result->case_Id);
            $clients = $case->clients;

            foreach ($clients as $key => $client) {
                if ($client->type == trans('site_lang.clients_client_type_khesm')) {
                    $khesm = $client->client_Name;
                } else {
                    $case_client = $client->client_Name;
                }
            }
            $khesm_arr[] = $khesm;
            $client_arr[] = $case_client;
        }

        $pdf = PDF::loadView('Reports.MonthlyPDF', ['data' => $data, 'month' => $month, 'year' => $year, 'khesm' => $khesm_arr, 'clients' => $client_arr]);//    }else{
        return $pdf->stream('Monthly report' . $month . '/' . $year . '.pdf');

//        return view('Reports.MonthlyPDF',compact('data' , 'month', 'year', 'khesm' , 'clients'));
//    }
    }
}
