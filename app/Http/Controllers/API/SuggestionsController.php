<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Package;
use App\Point;
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

class SuggestionsController extends Controller
{
    public function store(Request $request)
    {
        $input = $request->all();
        $rules =
            [
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'message' => 'required'
            ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        } else {
            $auth_user = check_api_token($request->header('api_token'));
            if (empty($auth_user)) {
                return response()->json(msg($request, not_authoize(), 'not_authoize'));
            }
            $input['user_id'] = $auth_user->id;
            Suggestion::create($input);
            return msgdata($request, success(), 'Suggestion_Send', null);
        }
    }
}
