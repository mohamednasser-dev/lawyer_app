<?php

namespace App\Http\Controllers\Landing;

use App\category;
use App\Package;
use App\Permission;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        app()->setLocale('ar');
        $data = $this->validate(request(), [
            'name' => 'required',
            'email' =>'required|unique:users,email|regex:/(.+)@(.+)\.(.+)/i',
            'password' => 'required',
            'phone' => 'required|unique:users,phone',
            'address' => 'required',
            'cat_name' => 'required',
//            'package_id' => 'required',

        ]);

        $Cat_data['name'] = $request->cat_name;
        $category = category::create($Cat_data);
        $data['password'] = bcrypt(request('password'));
        $data['cat_id'] = $category->id;
        $data['status'] = 'Demo';
        $data['type'] = 'admin';
        $package = Package::where('name','demo')->first();
        $data['package_id'] = $package->id;
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

        return response()->json(['success' => "تم بنجاح"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
