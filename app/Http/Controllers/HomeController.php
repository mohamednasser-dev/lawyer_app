<?php

namespace App\Http\Controllers;
use App\User;
use App\Cases;
use App\mohdr;
use App\Sessions;
use Carbon\Carbon;
use App\Session_Notes;
use App\Package;
use Illuminate\Support\Facades\Auth;

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
        if (\auth()->user()->type == "manager") {

            return redirect('subscribers');
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
