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

class GovernmentsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
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
        Government::where('id', $id)->delete();
        return back();
    }

    public function storeLocations(Request $request)
    {

        $governments = Government::all();
        global $next_page_token;
        global $json;
        $headers = array
        (
            'accept: application/json',
            'Content-Type: application/json',
        );
        foreach ($governments as $government) {
            $gov_name = urldecode($government->name);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://maps.googleapis.com/maps/api/place/textsearch/json?query=%D8%A7%D9%82%D8%B3%D8%A7%D9%85%20%D8%A7%D9%84%D8%B4%D8%B1%D8%B7%D8%A9+" . "$gov_name" . "&language=ar&pagetoken=&key=AIzaSyCnXtbPyAEiGsv0YBnR5eLE53ssWy4kiWk");
            curl_setopt($ch, CURLOPT_POST, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $json = curl_exec($ch);
            $json = json_decode($json);

            if (isset($json->next_page_token)) {
                $next_page_token = $json->next_page_token;
            } else {
                $next_page_token = null;
            }

            if (isset($json->results) && count($json->results) > 0) {

                foreach ($json->results as $result) {

                    $location = new Location();
                    $location->name = $result->name;
                    $location->address = $result->formatted_address;
                    $location->lat = $result->geometry->location->lat;
                    $location->long = $result->geometry->location->lng;
                    $location->type = "Police_station";
                    $location->government_id = $government->id;
                    $location->save();
                }
            }


            for ($i = 0; $i <= 5; $i++) {

                if ($next_page_token != null || $next_page_token != "") {

                    $ch = curl_init();
                    if ($i==0){

                    curl_setopt($ch, CURLOPT_URL, "https://maps.googleapis.com/maps/api/place/textsearch/json?query=%D8%A7%D9%82%D8%B3%D8%A7%D9%85%20%D8%A7%D9%84%D8%B4%D8%B1%D8%B7%D8%A9+" . "$gov_name" . "&language=ar&pagetoken=" . "$next_page_token" . "&key=AIzaSyAIcQUxj9rT_a3_5GhMp-i6xVqMrtasqws");
                    }elseif ($i==1){

                    }elseif ($i==2){

                    }else{

                    }
                    curl_setopt($ch, CURLOPT_POST, false);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    $res = curl_exec($ch);
                    $json = json_decode($res);

                    if (isset($json->results) && count($json->results) > 0) {
                        foreach ($json->results as $result) {
                            $location = new Location();
                            $location->name = $result->name;
                            $location->address = $result->formatted_address;
                            $location->lat = $result->geometry->location->lat;
                            $location->long = $result->geometry->location->lng;
                            $location->type = "Police_station";
                            $location->government_id = $government->id;
                            $location->save();

                        }
                    }

                    if (isset($json->next_page_token)) {
                        $next_page_token = $json->next_page_token;
                    } else {
                        $next_page_token = null;

                    }
                }


            }

        }


        $locations = Location::all();
        return sendResponse(200, trans('site_lang.data_dispaly_success'), $locations);


    }
}
