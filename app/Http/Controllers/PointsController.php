<?php

namespace App\Http\Controllers;

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

class PointsController extends Controller
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
        $data = Point::where('deleted', '0')->orderBy('created_at', 'desc')->get();
        return view('manager.points.points', compact('data'));
    }

    function store(Request $request)
    {
            $data = $this->validate(request(), [
                'name' => 'required',
                'points_num' => 'required',
                'type' => 'required'
            ]);
            Point::create($data);
            return back();
    }
    public function destroy($id)
    {
        $data['deleted'] = '1';
        Point::where('id',$id)->update($data);
        return back();
    }
}
