<?php

namespace App\Http\Controllers;

use App\Government;
use App\Point;
use App\User;
use App\Cases;
use App\mohdr;
use App\Sessions;
use Carbon\Carbon;
use App\Session_Notes;
use App\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GovernmentsController extends Controller
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
        $data = Government::orderBy('created_at', 'desc')->get();
        return view('governments.index', compact('data'));
    }

    function store(Request $request)
    {
        $data = $this->validate(request(), [
            'name' => 'required'
        ]);
        Government::create($data);
        return back();
    }
    public function destroy($id)
    {
        Government::where('id',$id)->delete();
        return back();
    }
}
