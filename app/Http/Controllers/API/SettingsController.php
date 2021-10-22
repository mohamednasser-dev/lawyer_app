<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Package;
use App\Point;
use App\Setting;
use App\Suggestion;
use App\Verification;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Permission;
use App\category;
use Illuminate\Support\Facades\Validator;
use App\User;
use PDOException;

class SettingsController extends Controller
{
    public function get_data(Request $request, $type)
    {
        $auth_user = check_api_token($request->header('api_token'));
        if (empty($auth_user)) {
            return response()->json(msg($request, not_authoize(), 'not_authoize'));
        }
        if($type == 'about_us'){
            $data = Setting::where('id', 1)->first()->about_us;
        }elseif($type == 'privacy'){
            $data = Setting::where('id', 1)->first()->privacy;
        }else{
            $data = Setting::where('id', 1)->first()->terms;
        }
        return msgdata($request, success(), 'data_shown', $data);

    }
}
