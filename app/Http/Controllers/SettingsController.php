<?php

namespace App\Http\Controllers;

use App\Point;
use App\Setting;
use App\User;
use App\Cases;
use App\mohdr;
use App\Sessions;
use Carbon\Carbon;
use App\Session_Notes;
use App\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = Setting::where('id', 1)->first();
        return view('manager.settings', compact('data'));
    }
    public function show($id)
    {

    }

    function update(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);
        Setting::where('id', 1)->update($data);
        session()->flash('success', 'تم التعديل بنجاح');
        return back();
    }
}
