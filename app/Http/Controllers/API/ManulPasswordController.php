<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Manual_pass_reset;
use Validator;
use App\User;
use Mail;
class ManulPasswordController extends Controller
{
    public function forgot(Request $request,$email) {
        $manual_pass ="";
        $input = $request->all();
        $validate = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);
        if (!is_array($validate)) {
        	//make token of 4 degits random...
            $six_digit_random_number = mt_rand(1000, 9999);
            $pass_reset = Manual_pass_reset::where('email',$email)->first();
                // dd($pass_reset);
            if($pass_reset == null){
                $data['token'] = $six_digit_random_number;
                $data['email'] =$email;
                $manual_pass = Manual_pass_reset::create($data);
                //send email to user contain token of 4 degits ...
                Mail::to('test@test.com')->send(new \App\Mail\resetPassMail($manual_pass->token));
                return sendResponse(200,'Reset password link sent on your email.',null);
            }else{
                $data['token'] = $six_digit_random_number;
                $manual_pass =Manual_pass_reset::where('email',$email)->update($data);
                return sendResponse(200,'Reset password link sent on your email.',null);
            }
        }else {
            return sendResponse(403, $validate[0], null);
        }
    }
    public function reset(Request $request) {
        $input = $request->all();
        $validate = makeValidate($input,[
            'email' => 'required|email|exists:Manual_pass_resets,email',
            'token' => 'required|string|exists:Manual_pass_resets,token',
            'password' => 'required|string|confirmed'
            ]);
        if (!is_array($validate)) {
            $restet_user = Manual_pass_reset::where('token',$input['token'])->where('email',$input['email'])->get();
            if(count($restet_user) == 1){
                User::where('email',$input['email'])->update(['password' => Hash::make($input['password'])]);
                return sendResponse(200,'password changed successfuly ...',null);
            }
        }else {
            return sendResponse(403, $validate[0], null);
        }
    }
}
