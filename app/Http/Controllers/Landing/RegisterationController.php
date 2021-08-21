<?php

namespace App\Http\Controllers\Landing;

use App\category;
use App\Notifications\ContactUsNotification;
use App\Notifications\UserResetPasswordNotification;
use App\Package;
use App\Permission;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;


class RegisterationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        app()->setLocale('ar');
        $data = $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|unique:users,email|regex:/(.+)@(.+)\.(.+)/i',
            'password' => 'required',
            'phone' => 'required|unique:users,phone',
            'address' => 'required',
            'cat_name' => 'required',
//            'package_id' => 'required',

        ]);
        $Cat_data['name'] = $request->cat_name;
        $category = category::create($Cat_data);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        $data['cat_name'] = $request->cat_name;

        $data['password'] = bcrypt(request('password'));
        $data['cat_id'] = $category->id;
        $data['status'] = 'Demo';
        $data['type'] = 'admin';
//        $package = Package::where('name','demo')->first();
//        if($package){
//            $data['package_id'] = $package->id;
//        }else{
//            $package =  Package::create(
//                ["name"=>'Demo','cost'=>0,"duration"=>14]
//            );
//
//            $data['package_id'] = $package->id;
//        }

        $package = Package::find(5);
        $mytime = Carbon::now();
        $today = Carbon::parse($mytime->toDateTimeString())->format('Y-m-d H:i');
        $final_today = Carbon::createFromFormat('Y-m-d H:i', $today);
        $warning_final_today = Carbon::createFromFormat('Y-m-d H:i', $today);

        //to generate expiry date ...
        $expire_date = $final_today->addMonths($package->duration);
        $data['expiry_date'] = $expire_date;

        //for generate warning date ...
        $for_warning_date = $warning_final_today->addMonths($package->duration);
        $warning_date = $for_warning_date->subDays(10);
        $data['warning_date'] = $warning_date;
        $data['package_id'] = 5;

        $user_result = User::create($data);

        $category->parent_id = $user_result->id;
        $category->update();

        $permissions['user_id'] = $user_result->id;
        $permissions['users'] = 'yes';
        $permissions['clients'] = 'yes';
        $permissions['addcases'] = 'yes';
        $permissions['search_case'] = 'yes';
        $permissions['mohdreen'] = 'yes';
        $permissions['daily_report'] = 'yes';
        $permissions['monthly_report'] = 'yes';
        $permissions['category'] = 'yes';

        $per = Permission::create($permissions);
        $per->save();

        return response(
            [
                'success' => "تم بنجاح"

            ]
        );
        return response()->json(['success' => "تم بنجاح"]);
    }

    public function storeApi(Request $request)
    {
        app()->setLocale('ar');
        $rules =
            [
                'name' => 'required',
                'email' => 'required|unique:users,email|regex:/(.+)@(.+)\.(.+)/i',
                'password' => 'required',
                'phone' => 'required|unique:users,phone',
                'address' => 'required',
                'cat_name' => 'required'
            ];

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->all()]);
        }


        $Cat_data['name'] = $request->cat_name;
        $category = category::create($Cat_data);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        $data['cat_name'] = $request->cat_name;

        $data['password'] = bcrypt(request('password'));
        $data['cat_id'] = $category->id;
        $data['status'] = 'Demo';
        $data['type'] = 'admin';
//        $package = Package::where('name','demo')->first();
//        if($package){
//            $data['package_id'] = $package->id;
//        }else{
//            $package =  Package::create(
//                ["name"=>'Demo','cost'=>0,"duration"=>14]
//            );
//
//            $data['package_id'] = $package->id;
//        }

        $package = Package::find(5);

        $mytime = Carbon::now();
        $today = Carbon::parse($mytime->toDateTimeString())->format('Y-m-d H:i');
        $final_today = Carbon::createFromFormat('Y-m-d H:i', $today);
        $warning_final_today = Carbon::createFromFormat('Y-m-d H:i', $today);

        //to generate expiry date ...
        $expire_date = $final_today->addMonths($package->duration);
        $data['expiry_date'] = $expire_date;

        //for generate warning date ...
        $for_warning_date = $warning_final_today->addMonths($package->duration);
        $warning_date = $for_warning_date->subDays(10);
        $data['warning_date'] = $warning_date;
        $data['package_id'] = 5;
        $user_result = User::create($data);

        $category->parent_id = $user_result->id;
        $category->update();

        $permissions['user_id'] = $user_result->id;
        $permissions['users'] = 'yes';
        $permissions['clients'] = 'yes';
        $permissions['addcases'] = 'yes';
        $permissions['search_case'] = 'yes';
        $permissions['mohdreen'] = 'yes';
        $permissions['daily_report'] = 'yes';
        $permissions['monthly_report'] = 'yes';
        $permissions['category'] = 'yes';

        $per = Permission::create($permissions);
        $per->save();

        return msgdata($request, success(), 'success', $user_result);

    }


    public function Contact(Request $request)
    {


        app()->setLocale('ar');

        $rules =
            [
                'name' => 'required',
                'email' => 'required|email',
                'subject' => 'required',
                'phone' => 'required',
                'message' => 'required',
            ];

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->all()]);
        }


        $data = $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required',

        ]);

        $user = User::where('type', 'manager')->first();
        if ($user) {
            try {
//                Mail::raw('رمز استعاده كلمه المرور الخاصة بك: ' . $code, function ($message) use ($user) {
//                    $message->subject('تطبيق المحاماه');
//                    $message->from('taheelpost@gmail.com', 'taheelpost');
//                    $message->to($user->email);
//                });
                $user->notify(new ContactUsNotification($data));
            } catch (\Swift_TransportException $e) {

            }
        } else {
            $user = User::make(['email' => "mostafaelebzary@gmail.com"]);
            $user->notify(new ContactUsNotification($data));
        }

        return msg($request, success(), 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
