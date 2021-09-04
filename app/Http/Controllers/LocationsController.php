<?php

namespace App\Http\Controllers;

use App\Government;
use App\Location;
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

class LocationsController extends Controller
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
    public function show($id)
    {
        $gov_data = Government::find($id);
        $data = Location::where('government_id',$id)->orderBy('created_at', 'desc')->get();
        return view('governments.locations.index', compact('data','gov_data'));
    }
    public function change_status($id)
    {
        $location_data = Location::find($id);
        $data = Location::where('id',$id)->first();
        if($location_data->status == 'show'){
            $data->status = 'hidden';
        }else{
            $data->status = 'show';
        }
        $data->save();
        return back();
    }

    function store(Request $request)
    {

        $data = $this->validate(request(), [
            'name' => 'required',
            'address' => 'required',
            'type' => 'required',
            'lat' => 'required',
            'long' => 'required',
            'government_id' => 'required',
        ]);
        Location::create($data);
        return back();
    }
    public function destroy($id)
    {
        Location::where('id',$id)->delete();
        return back();
    }
}
