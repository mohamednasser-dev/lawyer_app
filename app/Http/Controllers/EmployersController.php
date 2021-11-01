<?php

namespace App\Http\Controllers;

use App\category;
use App\Package;
use App\Permission;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class EmployersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::where('type', 'employer')->orderBy('created_at', 'desc')->get();
        return view('manager.employers.index', compact('data'));
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $data = $this->validate(request(), [
            'name' => 'required|unique:users,name',
            'email' => 'required|unique:users,email|regex:/(.+)@(.+)\.(.+)/i',
            'phone' => 'required|unique:users,phone',
            'address' => 'required',
            'password' => 'required',
            'image' => 'required',
        ]);
        $data['password'] = bcrypt(request('password'));
        $data['package_id'] = auth()->user()->package_id;
        $data['type'] = 'employer';
        if ($request['image'] != null) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $fileNewName = 'img_' . time() . '.' . $ext;
            $file->move(public_path('uploads/userprofile'), $fileNewName);
            $data['image'] = $fileNewName;
        }
        $user = User::create($data);
        $user_id = $user->id;
        $permissions['user_id'] = $user_id;
        Permission::create($permissions);
        session()->flash('success', trans('site_lang.add_success'));
        return back();
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
        if (request()->ajax()) {
            $data = User::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }


    public function update(Request $request)
    {

        if ($request->ajax()) {
            $data = $this->validate(request(), [
                'name' => 'required',
                'email' => 'required|unique:users,email,' . $request->id,
                'phone' => 'required||unique:users,phone,' . $request->id,
                'address' => 'required',
                'type' => 'required',
                'cat_id' => 'required'

            ]);
            $users = User::where('id', $request->id)->update($data);
            return response(['msg' => trans('site_lang.public_success_text'), 'result' => User::where('id', $request->id)->first()]);
        }
    }

    public function destroy($id)
    {
        $user = User::where('id', $id)->first();
        if ($user->parent_id == null) {
            return response(['status' => false, 'msg' => trans('site_lang.deleteUserAdminError')]);
        } else {
            $data = User::findOrFail($id);
            $data->delete();
            return response(['status' => true, 'data' => $data]);
        }
    }

    public function renew_package()
    {
        $data = Package::where('type', 'users')->get();
        return view('userprofile.renew_user_package', compact('data'));
    }
}
