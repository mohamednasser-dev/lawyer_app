<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Session_Notes;
use Carbon\Carbon;
use App\Sessions;
use App\Package;
use App\Cases;
use App\mohdr;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        //to expired user package if its time come ....
        $expired = User::where('expiry_package', 'n')->whereDate('expiry_date', '<', Carbon::now())->get();
        foreach ($expired as $row) {
            $product = User::find($row->id);
            $product->expiry_package = 'y';
            $product->save();
        }

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (\auth()->user()->type == "manager" || \auth()->user()->type == "employer" ) {

            return redirect('manager/home');
        }

        $package_id = auth()->user()->package_id;
        $user_package = Package::where('id', $package_id)->first();
        $id = getQuery();
        $admin = User::findOrFail($id);

        if ($admin->status == 'Deactive') {
            Auth::logout();
            return redirect()->back()->with('danger_deactive', '   أنت غير مفعل .... يجب التواصل مع خدمه العملاء للتفعيل');

        }


        $users = User::where('parent_id', getQuery())->get();
        $cases = Cases::where('parent_id', getQuery())->get();
        $sessions = Sessions::where('parent_id', getQuery())->get();
        $mohdreen = mohdr::where('parent_id', getQuery())->get();
        $today = Carbon::today();
        $date = Carbon::today()->addDays(10);


        $session = Sessions::whereBetween('session_date', array($today, $date))->where('parent_id', getQuery())->where('status', 'No')->get();
        $sessionNo = Sessions::where('session_date', '<=', $today)->where('status', 'No')->where('parent_id', getQuery())->get();
        $datee = Carbon::today()->addDays(15);
        $mohder = mohdr::whereBetween('session_date', array($today, $datee))->where('status', 'No')->where('parent_id', getQuery())->get();

        return view('home', compact(['users', 'cases', 'mohdreen', 'session', 'mohder', 'sessionNo', 'sessions']));
    }

    public function my_package()
    {
        return view('userprofile.my_package');
    }

    public function manager_home()
    {
        $student_month_count =[];
        $package_users_count =[];
        $year = Carbon::now()->year;

        $students_by_month = User::where('verified', '1')->where('type','admin')->whereYear('created_at', $year)
            ->select(DB::raw('count(id) as `data`'), DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"), DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
            ->groupby('year', 'month')
            ->get();


        $student_arr[0] = "";
        $student_arr[1] = "";
        $student_arr[2] = "";
        $student_arr[3] = "";
        $student_arr[4] = "";
        $student_arr[5] = "";
        $student_arr[6] = "";
        $student_arr[7] = "";
        $student_arr[8] = "";
        $student_arr[9] = "";
        $student_arr[10] = "";
        $student_arr[11] = "";
        $student_arr[12] = "";

        foreach ($students_by_month as $key => $row) {

            $student_month_count[$key] = $row->data;
//                    $months[$key] = date('F', strtotime($row->month)) ;
            $months[$key] = $row->month;
            $years[$key] = $row->year;
            $new_month = $row->month - 1;

            $student_arr[$new_month] = $row->data;

        }

        $users_month_count = json_encode($student_arr);

        //second chart ....
        $packages = Package::select('name')->where('type','!=','manager')->orderBy('created_at','desc')->get()->pluck('name')->toArray();
        $packages = json_encode($packages);
        $all_packages = Package::where('type','!=','manager')->orderBy('created_at','desc')->get();
        foreach ($all_packages as $key => $row){
            $users_count = User::where('package_id',$row->id)->where('type','admin')->get()->count();
            $package_users_count[$key] = $users_count ;
        }
        $package_users_count = json_encode($package_users_count);

        $users_active_count = User::where('status','!=','Deactive')->where('type','admin')->where('verified','1')->get()->count();
        $users_ended_count = User::where('status','!=','Deactive')->where('type','admin')->where('verified','1')->where('expiry_package','y')->get()->count();
        $users_current_count = User::where('status','!=','Deactive')->where('type','admin')->where('verified','1')->where('expiry_package','n')->get()->count();

        return view('manager_home',compact('users_month_count','packages','package_users_count','users_current_count','users_active_count','users_ended_count'));
    }


    public function showMohData($id)
    {
        if (request()->ajax()) {
            $data = mohdr::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function change_them($theme)
    {
        if (session()->has('theme')) {
            session()->forget('theme');
        }
        if ($theme == 'light') {
            session()->put('theme', 'light');
            $them_data['them'] = 'light' ;
        } else {
            session()->put('theme', 'dark');
            $them_data['them'] = 'dark' ;
        }
        User::where('id',auth()->user()->id)->update($them_data);
        return back();
    }

    public function showSessionNotes($id)
    {
        $session_notes = Session_Notes::where('session_Id', $id)->orderBy('id', 'desc')->get();
        $note_table = array();

        foreach ($session_notes as $note) {
            $note_table[] = view('cases.session_note_home_item', compact('note'))->render();
        }
        return response()->json(['result' => $note_table]);
    }
}
