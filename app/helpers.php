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


function msg($request, $status, $key)
{
    $msg['status'] = $status;
    $msg['msg'] = Config::get('response.' . $key . '.' . $request->header('lang'));

    return $msg;
}

function send($tokens, $title = "رسالة جديدة", $msg = "رسالة جديدة فى البريد", $type = 'service', $chat = null)
{
    $key = 'AAAA3G2KNCA:APA91bFXw37Kvqy-_NRSEsOrTBviHY4hSSwvuAvGDT7qbY6MNxwvU66hYc6ZWythp1I7KzWlc6ogx4vUMmgx1qwVYiyDAetd4EXIddNFeeqpjlF-owNE_aEkE_6Y9gdlwN5i6_jUlBMg';

    $fields = array
    (
        "registration_ids" => (array)$tokens,  //array of user token whom notification sent two
        "priority" => 10,
        'data' => [
            'title' => $title,
            'body' => $msg,
            'service_id' => $chat,
            'type' => $type,
            'icon' => 'myIcon',
            'sound' => 'mySound',
        ],
        'notification' => [
            'title' => $title,
            'body' => $msg,
            'service_id' => $chat,
            'type' => $type,
            'icon' => 'myIcon',
            'sound' => 'mySound',
        ],
        'vibrate' => 1,
        'sound' => 1
    );


    $headers = array
    (
        'accept: application/json',
        'Content-Type: application/json',
        'Authorization: key=' . $key
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);

    dd($fields);
    if ($result === FALSE) {
        die('Curl failed: ' . curl_error($ch));
    }

    curl_close($ch);
    return $result;
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


function upload($file, $dir)
{
    $image = time() . uniqid() . '.' . $file->getClientOriginalExtension();
    $file->move('uploads' . '/' . $dir, $image);
    return $image;
}

