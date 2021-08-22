<?php

namespace App\Http\Controllers\API;

use App\mohdr;
use App\Package;
use App\Permission;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class packagesApiController extends Controller

{
    public function packages(Request $request)
    {
        $data = Package::select('id', 'name', 'cost', 'duration', 'description', 'renew_points')->where('type', 'users')->get();
        return msgdata($request, success(), 'success', $data);

    }

    public function store(Request $request, $package_id)
    {
        $api_token = $request->header('api_token');
        $user = check_api_token($api_token);
        if ($user) {
            $user_id = $user->id;
            if ($user->type == 'admin') {
                $selected_user = User::find($user_id);
                $old_date = $selected_user->created_at;
                $new_duration = Package::select('duration')->where('id', $package_id)->first();
                $new_date = $old_date->addMonths($new_duration->duration);
                $selected_user->created_at = $new_date;
                $selected_user->package_id = $package_id;
                $selected_user->save();
                return msg($request, success(), 'success');
            } else {
                return response()->json(msg($request, failed(), 'you_not_admin'));
            }
        } else {
            return response()->json(msg($request, not_authoize(), 'not_authoize'));
        }

    }
}
