<?php

namespace App\Http\Controllers\API;

use App\Cases;
use App\Permission;
use App\Sessions;
use App\User;
use PDF;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportsApiController extends Controller
{

    public function printSearchMonthly(Request $request, $month, $year, $type)
    {
        $user = check_api_token($request->header('api_token'));
        if ($user != null) {
            if ($user->type == "User")
                $type = $user->cat_id; // just put user cat_id to request
            $data = Sessions::with('cases', 'Printnotes', 'clients')
                ->where('month', '=', $month)
                ->where('year', '=', $year)
                ->where('parent_id', $user->parent_id != null ? $user->parent_id : $user->id)
                ->whereHas('cases', function ($q) use ($type, $user) {
                    if ($type != 0) // for get reports with some category if equal 0 will get all categories reports
                        $q->where('to_whome', '=', $type);
                })->get()
                ->map(function ($data) {
                    $new_string = "";
                    $new_khesm = "";
                    foreach ($data->clients as $row) {
                        if ($row->client_type == trans("site_lang.clients_client_type_khesm")) {
                            $new_khesm = $new_khesm . $row->client_Name . ' , ';
                        } else
                            $new_string = $new_string . $row->client_Name . ' , ';
                    }
                    $data->client = rtrim($new_string, ", ");
                    $data->khesm = rtrim($new_khesm, ", ");
                    unset($data->clients);
                    return $data;
                });
            $pdf = PDF::loadView('Reports.MonthlyPDF', ['data' => $data, 'month' => $month, 'year' => $year]);//    }else{
            return $pdf->stream('Monthly report' . $month . '/' . $year . '.pdf');
        } else {
            return sendResponse(403, trans('site_lang.loginWarning'), null);
        }
    }

    public function searchMonthly(Request $request)
    {
        $user = check_api_token($request->header('api_token'));
        $rules =
            [
                'category_id' => 'required',
                'year' => 'required',
                'month' => 'required',
            ];
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        }

        if ($user != null) {
            $permission = Permission::where('user_id', $user->id)->first();
            $enabled = $permission->monthly_report;
            if ($enabled == 'yes') {
                if ($user->type == "User")
                    $request->category_id = $user->cat_id; // just put user cat_id to request

                $cases = Sessions::with('cases', 'Printnotes', 'clients')
                    ->where('month', '=', $request->month)
                    ->where('year', '=', $request->year)
                    ->where('parent_id', $user->parent_id != null ? $user->parent_id : $user->id)
                    ->whereHas('cases', function ($q) use ($request, $user) {
                        if ($request->category_id != 0) // for get reports with some category if equal 0 will get all categories reports
                            $q->where('to_whome', '=', $request->category_id);
                    })->paginate(20);
                $cases->setCollection(
                    $cases->getCollection()
                        ->map(function ($data) {
                            $new_string = "";
                            $new_khesm = "";
                            foreach ($data->clients as $row) {
                                if ($row->client_type == trans("site_lang.clients_client_type_khesm")) {
                                    $new_khesm = $new_khesm . $row->client_Name . ' , ';
                                } else
                                    $new_string = $new_string . $row->client_Name . ' , ';
                            }
                            $data->client = rtrim($new_string, ", ");
                            $data->khesm = rtrim($new_khesm, ", ");
                            unset($data->clients);
                            return $data;
                        })

                );

                return sendResponse(200, trans('site_lang.data_dispaly_success'), $cases);
            } else {
                return sendResponse(401, trans('site_lang.permission_warrning'), null);
            }
        } else {
            return sendResponse(403, trans('site_lang.loginWarning'), null);
        }
    }

    public function printSearchDaily(Request $request, $date, $type)
    {
        $user = check_api_token($request->header('api_token'));
        if ($user != null) {
            $data = Sessions::with('cases', 'Printnotes', 'clients')
                ->where('session_date', $date)
                ->where('parent_id', $user->parent_id != null ? $user->parent_id : $user->id)
                ->whereHas('cases', function ($q) use ($type, $user) {
                    if ($type != 0) // for get reports with some category if equal 0 will get all categories reports
                        $q->where('to_whome', '=', $type);
                })->get()
                ->map(function ($data) {
                    $new_string = "";
                    $new_khesm = "";
                    foreach ($data->clients as $row) {
                        if ($row->client_type == trans("site_lang.clients_client_type_khesm")) {
                            $new_khesm = $new_khesm . $row->client_Name . ' , ';
                        } else
                            $new_string = $new_string . $row->client_Name . ' , ';
                    }
                    $data->client = rtrim($new_string, ", ");
                    $data->khesm = rtrim($new_khesm, ", ");
                    unset($data->clients);
                    return $data;
                });
            $pdf = PDF::loadView('Reports.Daily_api_pdf', ['data' => $data, 'id' => $date]);
            return $pdf->stream('Daily report' . $date . '.pdf');
        } else {
            return sendResponse(403, trans('site_lang.loginWarning'), null);
        }
    }



    public function searchDaily(Request $request)
    {
        $user = check_api_token($request->header('api_token'));
        $rules =
            [
                'category_id' => 'required',
                'session_date' => 'required',
            ];
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        }

        if ($user != null) {
            $permission = Permission::where('user_id', $user->id)->first();
            $enabled = $permission->monthly_report;
            if ($enabled == 'yes') {
                if ($user->type == "User")
                    $request->category_id = $user->cat_id; // just put user cat_id to request
                $cases = Sessions::with('cases', 'Printnotes', 'clients')
                    ->where('session_date', $request->session_date)
                    ->where('parent_id', $user->parent_id != null ? $user->parent_id : $user->id)
                    ->whereHas('cases', function ($q) use ($request, $user) {
                        if ($request->category_id != 0) {
                            // for get reports with some category if not equal 0 will get all categories reports
                            $q->where('to_whome', '=', $request->category_id);
                        }
                    })->paginate(20);
                $cases->setCollection(
                    $cases->getCollection()
                        ->map(function ($data) {
                            $new_string = "";
                            $new_khesm = "";
                            foreach ($data->clients as $row) {
                                if ($row->client_type == trans("site_lang.clients_client_type_khesm")) {
                                    $new_khesm = $new_khesm . $row->client_Name . ' , ';
                                } else
                                    $new_string = $new_string . $row->client_Name . ' , ';
                            }
                            $data->client = rtrim($new_string, ", ");
                            $data->khesm = rtrim($new_khesm, ", ");
                            unset($data->clients);
                            return $data;
                        })

                );

                return sendResponse(200, trans('site_lang.data_dispaly_success'), $cases);
            } else {
                return sendResponse(401, trans('site_lang.permission_warrning'), null);
            }
        } else {
            return sendResponse(403, trans('site_lang.loginWarning'), null);
        }
    }
}
