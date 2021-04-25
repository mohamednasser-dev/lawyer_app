<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Sessions;
use App\Cases;
use App\mohdr;
use Validator;

class HomePageController extends Controller
{
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
                $users = User::where('parent_id', $user->parent_id)->get();
                $cases = Cases::where('parent_id', $user->parent_id)->get();
                $sessions = Sessions::where('parent_id', $user->parent_id)->get();
                $mohdreen = mohdr::where('parent_id', $user->parent_id)->get();

                $coming_session = Sessions::select('id','session_date','month','year','case_Id')
                                            ->whereBetween('session_date', array($today, $date))
                                            ->where('parent_id', $user->parent_id)
                                            ->get()
                                            ->map(function($sessions){
                                                $case = Cases::findOrFail($sessions->case_Id);
                                                $sessions->invetation_num = $case->invetation_num ;
                                                return $sessions ;
                                            });
                $previous_session = Sessions::select('id','session_date','month','year','case_Id','status')
                                            ->where('session_date', '<=', $today)
                                            ->where('status', 'No')
                                            ->where('parent_id', $user->parent_id)
                                            ->get()
                                            ->map(function($sessions){
                                                $case = Cases::findOrFail($sessions->case_Id);
                                                $sessions->invetation_num = $case->invetation_num ;
                                                $sessions->month = date('F', strtotime($sessions->session_date));
                                                return $sessions ;
                                            });
                $mohder = mohdr::select('moh_Id','court_mohdareen','paper_type','session_Date')->whereBetween('session_date', array($today, $datee))->where('parent_id', $user->parent_id)->get();
            } else {
                $users = User::where('parent_id', $user->id)->get();
                $cases = Cases::where('parent_id', $user->id)->get();
                $sessions = Sessions::select('id','session_date','month','year')->where('parent_id', $user->id)->get();
                $mohdreen = mohdr::where('parent_id', $user->id)->get();

                $coming_session = Sessions::select('id','session_date','month','year','case_Id')
                                            ->whereBetween('session_date', array($today, $date))
                                            ->where('parent_id', $user->id)
                                            ->get()
                                            ->map(function($sessions){
                                                $case = Cases::findOrFail($sessions->case_Id);
                                                $sessions->invetation_num = $case->invetation_num ;
                                                return $sessions ;
                                            });
                $previous_session = Sessions::select('id','session_date','month','year','case_Id','status')
                                            ->where('session_date', '<=', $today)
                                            ->where('status', 'No')
                                            ->where('parent_id', $user->id)
                                            ->get()
                                            ->map(function($sessions){
                                                $case = Cases::findOrFail($sessions->case_Id);
                                                $sessions->invetation_num = $case->invetation_num ;
                                                $sessions->month = date('F', strtotime($sessions->session_date));

                                                return $sessions ;
                                            });
                $mohder = mohdr::select('moh_Id','court_mohdareen','paper_type','session_Date')->whereBetween('session_date', array($today, $datee))->where('parent_id', $user->id)->get();
            }
            $count_data['users'] = count($users);
            $count_data['cases'] = count($cases);
            $count_data['sessions'] = count($sessions);
            $count_data['mohdreen'] = count($mohdreen);

            return msgdata($request, success(), 'success', array('count_data' => $count_data, 'coming_session' => $coming_session, 'previous_session' => $previous_session, 'mohder' => $mohder));

        } else {
            return response()->json(msg($request, not_authoize(), 'invalid_data'));
        }
    }
}
