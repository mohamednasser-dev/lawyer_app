<?php

namespace App\Http\Controllers;

use App\category;
use App\Package;
use App\Permission;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $permission = Permission::where('user_id', $user_id)->first();
        $enabled = $permission->users;
        if ($enabled == 'yes') {
            $users = null;
            if (auth()->user()->parent_id != null) {
                $users = User::query()->where('parent_id', getQuery())->Where('id','!=', auth()->user()->id)->get();
            } else {
//                ->orWhere('id', getQuery())
                $users = User::query()->where('parent_id', getQuery())->get();
            }
            $categories = category::where('parent_id', getQuery())->select('id', 'name')->get();
            return view('users/users', compact('users', 'categories'));
        } else {
            session()->flash('danger', trans('site_lang.not_authorized_to_enter'));
            return redirect(url('home'));
        }
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {

        if ($request->ajax()) {
            $data = $this->validate(request(), [
                'name' => 'required|unique:users,name',
                'email' => 'required|unique:users,email|regex:/(.+)@(.+)\.(.+)/i',
                'phone' => 'required|unique:users,phone',
                'address' => 'required',
                'password' => 'required',
                'type' => 'required',
                'cat_id' => 'required'
            ]);

            $data['password'] = bcrypt(request('password'));
            $data['parent_id'] = getParentId();
            $data['package_id'] = auth()->user()->package_id;
//
            $user = User::create($data);
            $user_id = $user->id;
            $permissions['user_id'] = $user_id;
            $per = Permission::create($permissions);
            $per->save();


            $html = view('users.users_item', compact('user'))->render();
            return response(['status' => true, 'result' => $html, 'msg' => trans('site_lang.public_success_text')]);
        }
        return redirect()->route('users.users')->with('success', trans('site_lang.public_success_text'));
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
