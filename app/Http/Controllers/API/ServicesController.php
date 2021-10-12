<?php

namespace App\Http\Controllers\API;

use App\Jobs\ServiceNotificationJob;
use App\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ServicesController extends Controller
{
    public function index(Request $request)
    {
        $api_token = $request->header('api_token');
        $user = check_api_token($api_token);
        if (!$user) {
            return response()->json(msg($request, not_authoize(), 'not_authoize'));
        }

        $service = Service::orderBy('time', 'desc')->whereDate('time', ' >= ', Carbon::now())->paginate(10);

        return msgdata($request, success(), 'success', $service);

    }

    public function store(Request $request)
    {
        $api_token = $request->header('api_token');
        $auth_user = check_api_token($api_token);
        if (empty($auth_user)) {
            return response()->json(msg($request, not_authoize(), 'not_authoize'));
        }
        $rules =
            [
                'title' => 'required',
                'price' => 'required|numeric',
                'phone' => 'required',
                'whatsapp' => 'required',
                'desc' => 'nullable',
                'image' => 'nullable',
                'time' => 'required|date_format:Y-m-d H:i|after:1 hours',

            ];

        $validator = Validator::make($request->all(), $rules);
        dd($validator)
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        }

        $service = new Service();
        $service->user_id = $auth_user->id;
        $service->title = $request->title;
        $service->price = $request->price;
        $service->phone = $request->phone;
        $service->whatsapp = $request->whatsapp;
        if ($request->desc) {
            $service->desc = $request->desc;
        }
        if ($request->image) {
            $service->image = $request->image;
        }
        $service->time = $request->time;
        $service->save();
//        dispatch job here
        $service = Service::whereId($service->id)->first();
        ServiceNotificationJob::dispatch($service);


        return msgdata($request, success(), 'success', $service);

    }

    public function update(Request $request, $id)
    {
        $api_token = $request->header('api_token');
        $auth_user = check_api_token($api_token);
        if (empty($auth_user)) {
            return response()->json(msg($request, not_authoize(), 'not_authoize'));
        }
        $rules =
            [
                'title' => 'required',
                'price' => 'required|numeric',
                'phone' => 'required',
                'whatsapp' => 'required',
                'desc' => 'nullable',
                'image' => 'nullable',
                'time' => 'required|date_format:Y-m-d H:i',

            ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        }


        $service = Service::whereId($id)->first();

        if ($service) {
            $service->user_id = $auth_user->id;
            $service->title = $request->title;
            $service->price = $request->price;
            $service->phone = $request->phone;
            $service->whatsapp = $request->whatsapp;
            if ($request->desc) {
                $service->desc = $request->desc;
            }
            if ($request->image) {
                $service->image = $request->image;
            }
            $service->time = $request->time;
            $service->save();

            $service = Service::whereId($service->id)->first();
            return msgdata($request, success(), 'success', $service);
        } else {
            return response()->json(msg($request, not_found(), 'service_not_found'));
        }
    }

    public function delete(Request $request, $id)
    {
        $api_token = $request->header('api_token');
        $auth_user = check_api_token($api_token);
        if (empty($auth_user)) {
            return response()->json(msg($request, not_authoize(), 'not_authoize'));
        }


        $service = Service::whereId($id)->first();

        if ($service) {
            if ($service->user_id == $auth_user->id) {

                $service->delete();
                return msg($request, success(), 'success');
            } else {
                return response()->json(msg($request, failed(), 'service_not_found'));

            }
        } else {
            return response()->json(msg($request, not_found(), 'service_not_found'));
        }
    }

    public function myServices(Request $request)
    {
        $api_token = $request->header('api_token');
        $user = check_api_token($api_token);
        if (!$user) {
            return response()->json(msg($request, not_authoize(), 'not_authoize'));
        }

        $service = Service::where('user_id', $user->id)->orderBy('time', 'desc')->paginate(10);

        return msgdata($request, success(), 'success', $service);

    }


}
