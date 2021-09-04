<?php

namespace App\Http\Controllers\API;

use App\Government;
use App\Http\Controllers\Controller;
//use Illuminate\Foundation\Auth\User;
use App\Location;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Sessions;
use App\Cases;
use App\mohdr;
use App\User;
use Validator;

class HomePageController extends Controller
{
    public function __construct()
    {
        //to expired user package if its time come ....
        $expired = User::where('expiry_package', 'n')->whereDate('expiry_date', '<', Carbon::now())->get();
        foreach ($expired as $row) {
            $product = User::find($row->id);
            $product->expiry_package = 'y';
            $product->save();
        }

    }
    public function index(Request $request)
    {
        $api_token = $request->header('api_token');
        $lang = $request->header('lang');
        $user = check_api_token($api_token);
        if ($user != null) {
            $today = Carbon::today();
            $date = Carbon::today()->addDays(10);
            $datee = Carbon::today()->addDays(15);
            if ($user->parent_id != null) {
                $package_data = User::select('package_id','warning_date','expiry_date','expiry_package')->where('id',$user->parent_id)->first();
                $users = User::where('parent_id', $user->parent_id)->get();
                $cases = Cases::where('parent_id', $user->parent_id)->get();
                $sessions = Sessions::where('parent_id', $user->parent_id)->get();
                $mohdreen = mohdr::where('parent_id', $user->parent_id)->get();
                $coming_session = Sessions::select('id', 'session_date', 'month', 'year', 'case_Id', 'status')
                    ->whereBetween('session_date', array($today, $date))
                    ->where('status', 'No')
                    ->where('parent_id', $user->parent_id)
                    ->paginate(20);
                $previous_session = Sessions::select('id', 'session_date', 'month', 'year', 'case_Id', 'status')
                    ->where('session_date', '<=', $today)
                    ->where('status', 'No')
                    ->where('parent_id', $user->parent_id)
                    ->paginate(20);
                $mohder = mohdr::select('mokel_Name','khesm_Name', 'session_Date','moh_Id','paper_Number' , 'status')->where('status', 'No')
                    ->whereBetween('session_date', array($today, $datee))->where('parent_id', $user->parent_id)->paginate(20);
            } else {
                $package_data = User::select('package_id','warning_date','expiry_date','expiry_package')->where('id',$user->id)->first();
                $users = User::where('parent_id', $user->id)->get();
                $cases = Cases::where('parent_id', $user->id)->get();
                $sessions = Sessions::select('id', 'session_date', 'month', 'year')->where('parent_id', $user->id)->get();
                $mohdreen = mohdr::where('parent_id', $user->id)->get();
                $coming_session = Sessions::select('id', 'session_date', 'month', 'year', 'case_Id', 'status')
                    ->whereBetween('session_date', array($today, $date))
                    ->where('status', 'No')
                    ->where('parent_id', $user->id)
                    ->paginate(20);
                $previous_session = Sessions::select('id', 'session_date', 'month', 'year', 'case_Id', 'status')
                    ->where('session_date', '<=', $today)
                    ->where('status', 'No')
                    ->where('parent_id', $user->id)
                    ->paginate(20);
                $mohder = mohdr::select('mokel_Name','khesm_Name', 'session_Date','moh_Id','paper_Number' , 'status')->where('status', 'No')
                    ->whereBetween('session_date', array($today, $datee))->where('parent_id', $user->id)->paginate(20);
            }
            $count_data['users'] = count($users);
            $count_data['cases'] = count($cases);
            $count_data['sessions'] = count($sessions);
            $count_data['mohdreen'] = count($mohdreen);
            return msgdata($request, success(), 'success', array('package_data'=>$package_data,'count_data' => $count_data, 'coming_session' => $coming_session, 'previous_session' => $previous_session, 'mohder' => $mohder));

        } else {
            return response()->json(msg($request, not_authoize(), 'not_authoize'));
        }
    }

    public function coming_session_pagination (Request $request)
    {
        $api_token = $request->header('api_token');
        $lang = $request->header('lang');
        $user = check_api_token($api_token);
        if ($user != null) {
            $today = Carbon::today();
            $date = Carbon::today()->addDays(10);
            $datee = Carbon::today()->addDays(15);
            if ($user->parent_id != null) {
                $coming_session = Sessions::select('id', 'session_date', 'month', 'year', 'case_Id', 'status')
                    ->whereBetween('session_date', array($today, $date))
                    ->where('status', 'No')
                    ->where('parent_id', $user->parent_id)
                    ->paginate(20);
            } else {
                $coming_session = Sessions::select('id', 'session_date', 'month', 'year', 'case_Id', 'status')
                    ->whereBetween('session_date', array($today, $date))
                    ->where('status', 'No')
                    ->where('parent_id', $user->id)
                    ->paginate(20);
            }

            return msgdata($request, success(), 'success',   $coming_session);

        } else {
            return response()->json(msg($request, not_authoize(), 'not_authoize'));
        }
    }

    public function previous_session_pagination(Request $request)
    {
        $api_token = $request->header('api_token');
        $user = check_api_token($api_token);
        if ($user != null) {
            $today = Carbon::today();
            if ($user->parent_id != null) {
                $previous_session = Sessions::select('id', 'session_date', 'month', 'year', 'case_Id', 'status')
                    ->where('session_date', '<=', $today)
                    ->where('status', 'No')
                    ->where('parent_id', $user->parent_id)
                    ->paginate(20);
            } else {
                $previous_session = Sessions::select('id', 'session_date', 'month', 'year', 'case_Id', 'status')
                    ->where('session_date', '<=', $today)
                    ->where('status', 'No')
                    ->where('parent_id', $user->id)
                    ->paginate(20);
            }
            return msgdata($request, success(), 'success',$previous_session);

        } else {
            return response()->json(msg($request, not_authoize(), 'not_authoize'));
        }
    }

    public function mohder_pagination(Request $request)
    {
        $api_token = $request->header('api_token');
        $lang = $request->header('lang');
        $user = check_api_token($api_token);
        if ($user != null) {
            $today = Carbon::today();
            $datee = Carbon::today()->addDays(15);
            if ($user->parent_id != null) {
                $mohder = mohdr::select('mokel_Name','khesm_Name', 'session_Date','moh_Id','paper_Number' , 'status')->where('status', 'No')
                    ->whereBetween('session_date', array($today, $datee))->where('parent_id', $user->parent_id)->paginate(20);
            } else {
                $mohder = mohdr::select('mokel_Name','khesm_Name', 'session_Date','moh_Id','paper_Number' , 'status')->where('status', 'No')
                    ->whereBetween('session_date', array($today, $datee))->where('parent_id', $user->id)->paginate(20);
            }
            return msgdata($request, success(), 'success', $mohder);
        } else {
            return response()->json(msg($request, not_authoize(), 'not_authoize'));
        }
    }
    //governments locations ...
    public function get_governments(Request $request)
    {
        $api_token = $request->header('api_token');
        $lang = $request->header('lang');
        $user = check_api_token($api_token);
        if ($user != null) {
                $data['governments'] = Government::select('id','name')->paginate(20);
                $data['gov_locations'] = Location::where('government_id',1)->where('status','show')->select('id','name','address','type','lat','long')->paginate(20);
            return msgdata($request, success(), 'success', $data);
        } else {
            return response()->json(msg($request, not_authoize(), 'not_authoize'));
        }
    }
    public function get_locations_by_gov_id(Request $request,$id,$type)
    {
        $api_token = $request->header('api_token');
        $user = check_api_token($api_token);
        if ($user != null) {
                $data = Location::where('government_id',$id)->where('status','show')->where('type',$type)->select('id','name','address','type','lat','long')->paginate(20);
            return msgdata($request, success(), 'success', $data);
        } else {
            return response()->json(msg($request, not_authoize(), 'not_authoize'));
        }
    }
}
