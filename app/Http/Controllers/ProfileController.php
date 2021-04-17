<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;


class ProfileController extends Controller
{
    public function edit()
    {


        return view('userprofile.profile');
    }

    public function submit(Request $request)
    {
        $id =Auth::user()->id;
 

         $data = $this->validate(\request(),
            [
                'name' => 'required|unique:users,name,' . $id,
                'image' => 'sometimes|nullable|image|mimes:jpg,jpeg,png,gif,bmp',
                'phone' => 'numeric|required|unique:users,phone,' . $id,
                'address' => 'required',
                'email' => 'required|unique:users,email,' . $id,
                'password' => 'sometimes|nullable|confirmed|min:6',
            ]
        );
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

        if($request['password'] != null  && $request['password_confirmation'] != null ){


            $pass= Hash::make(request('password'));
            $data['password'] = $pass;


        }else
        {
            unset($data['password']);
            unset($data['password_confirmation']);
        }

         $user =User::where('id', $id)->update($data);


        return redirect()->back()->with('success',trans('site_lang.updatSuccess'));
    }
}
