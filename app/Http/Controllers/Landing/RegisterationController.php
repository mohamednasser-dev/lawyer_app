<?php

namespace App\Http\Controllers\Landing;

use App\category;
use App\Notifications\ContactUsNotification;
use App\Notifications\UserVerifyEmailNotification;
use App\Package;
use App\Permission;
use App\User;
use App\Verification;
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
            'card_image'=>'required|image',
            'image'=>'required|image'
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
        if ($request['card_image'] != null) {

            // This is Image Information ...
            $file = $request->file('card_image');
            $name = $file->getClientOriginalName();
            $ext = $file->getClientOriginalExtension();
            // Move Image To Folder ..
            $fileNewName = 'img_' . time() . '.' . $ext;
            $file->move(public_path('uploads/register'), $fileNewName);

            $data['card_image'] = $fileNewName;
        }
        if ($request['image'] != null) {

            // This is Image Information ...
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $ext = $file->getClientOriginalExtension();
            // Move Image To Folder ..
            $fileNewName = 'img_' . time() . '.' . $ext;
            $file->move(public_path('uploads/userprofile'), $fileNewName);

            $data['image'] = $fileNewName;
        }
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
        $six_digit_random_number = mt_rand(1000, 9999);
        $exists_user_code = User::where('user_code',$six_digit_random_number)->first();
        if($exists_user_code){
            $new_six_digit_random_number = mt_rand(100000, 999999);
            $data['user_code'] = $new_six_digit_random_number;
        }else{
            $data['user_code'] = $six_digit_random_number;
        }
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
                'device_token' => 'required',
                'invite_code' => '',
                'cat_name' => 'required',
                'card_image'=>'required|image',
                'image'=>'required|image',
            ];

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        }

        if($request->invite_code){
            $user_parent_code =  User::where('user_code',$request->invite_code)->first();
            if($user_parent_code == null){
                return msg($request, failed(), 'invite_code_didt_exist');
            }
        }


        $Cat_data['name'] = $request->cat_name;
        $category = category::create($Cat_data);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        $data['cat_name'] = $request->cat_name;
        $data['device_token'] = $request->device_token;
        if ($request['card_image'] != null) {

            // This is Image Information ...
            $file = $request->file('card_image');
            $name = $file->getClientOriginalName();
            $ext = $file->getClientOriginalExtension();
            // Move Image To Folder ..
            $fileNewName = 'img_' . time() . '.' . $ext;
            $file->move(public_path('uploads/register'), $fileNewName);

            $data['card_image'] = $fileNewName;
        }
        if ($request['image'] != null) {

            // This is Image Information ...
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $ext = $file->getClientOriginalExtension();
            // Move Image To Folder ..
            $fileNewName = 'img_' . time() . '.' . $ext;
            $file->move(public_path('uploads/userprofile'), $fileNewName);

            $data['image'] = $fileNewName;
        }
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
        $six_digit_random_number = mt_rand(100000, 999999);
        $exists_user_code = User::where('user_code',$six_digit_random_number)->first();
        if($exists_user_code){
            $new_six_digit_random_number = mt_rand(100000, 999999);
            $data['user_code'] = $new_six_digit_random_number;
        }else{
            $data['user_code'] = $six_digit_random_number;
        }
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
        $data['verified'] = '0';

        $user_result = User::create($data);
        if($user_result){
            $exists_email = Verification::where('email',$request->email)->first();
            if($exists_email){
                $new_code  = mt_rand(1000, 9999);
                Verification::where('email',$request->email)->update(['code'=>$new_code]);
                $user_result->notify(new UserVerifyEmailNotification($new_code));
            }else{
                $code = mt_rand(1000, 9999);
                $verify_Data['email'] = $request->email ;
                $verify_Data['code'] = $code;
                $verify_Data['invite_code'] = $request->invite_code ;
                Verification::create($verify_Data);

                $user_result->notify(new UserVerifyEmailNotification($code));
            }
        }

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
