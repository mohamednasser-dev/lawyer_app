<?php

use App\User;
use Illuminate\Support\Facades\Validator;

    function getParentId()
    {
        if (auth()->user()->parent_id != null) {
            return auth()->user()->parent_id;
        } else {
            return auth()->user()->id;
        }
    }

if (!function_exists('getQuery')) {
    function getQuery()
    {
        if (auth()->user()->parent_id != null) {
            return auth()->user()->parent_id;
        } else {
            return auth()->user()->id;
        }
    }
}
if (!function_exists('sendResponse')) {
    function sendResponse($status = null, $msg = null, $data = null)
    {
        return response(
            [
                'status' => $status,
                'msg' => $msg,
                'data' => $data
            ]
        );
    }
}
if (!function_exists('validationErrorsToString')) {
    function validationErrorsToString($errArray)
    {
        $valArr = array();
        foreach ($errArray->toArray() as $key => $value) {
            $errStr = $value[0];
            array_push($valArr, $errStr);
        }
        return $valArr;
    }
}
if (!function_exists('makeValidate')) {
    function makeValidate($inputs, $rules)
    {
        $validator = Validator::make($inputs, $rules);
        if ($validator->fails()) {
            return validationErrorsToString($validator->messages());
        } else {
            return true;
        }
    }
}


function checkLang()
{
    if (!isset(getallheaders()['lang'])) {
        return response()->json(['status' => 401, 'msg' => 'The language is Required']);
    }
}


function check_api_token($api_token)
{
    return
        User::where("api_token", $api_token)->first();
}


function msgdata($request, $status, $key, $data)
{
    $msg['status'] = $status;
    $msg['msg'] = Config::get('response.' . $key . '.' . $request->header('lang'));
    $msg['data'] = $data;

    return $msg;
}


function msg($request,$status,$key)
{
    $msg['status'] = $status;
    $msg['msg'] = Config::get('response.'.$key.'.'.$request->header('lang'));

    return $msg;
}



function success()
{
    return 200;
}

function failed()
{
    return 401;
}

function not_authoize()
{
    return 403;
}
function not_acceptable()
{
    return 406;
}

function not_found()
{
    return 404;
}

function not_active()
{
    return 405;
}

