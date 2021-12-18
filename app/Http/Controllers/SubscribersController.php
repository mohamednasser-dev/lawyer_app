<?php

namespace App\Http\Controllers;

use App\Permission;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use App\category;
use App\Package;
use Illuminate\Support\Facades\Hash;

class SubscribersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_type = auth()->user()->type;
        if ($user_type == 'manager') {
            $data = User::where('parent_id', null)->where('package_id', '!=', null)
                ->where('type', '!=', 'manager')->orderBy('created_at','desc')
                ->get();
//                    ->addColumn('status', function ($data) {
//                                 if ($data->status == trans('site_lang.statusDeactive')) {
//                            $html = '<p class="btn btn-sm" data-user-id="' . $data->id . '" id="change-user-status">
//                            <span class="btn btn-danger text-bold"> ' . $data->status . '</span></p>';
//                        } else if ($data->status == trans('site_lang.statusDemo')) {
//                            $html = '<p class="btn btn-sm" data-user-Id="' . $data->id . '" id="change-user-status">
//                            <span class="btn btn-warning text-bold"> ' . $data->status . '</span></p>';
//                        } else {
//                            $html = '<p class="btn btn-sm" data-user-Id="' . $data->id . '" id="change-user-status">
//                            <span class="btn btn-success text-bold"> ' . $data->status . '</span></p>';
//                        }
//
//                        return $html;
//                    })
//                    ->addColumn('action', function ($data) {
//                        $button = '<button data-client-id="' . $data->id . '" id="editClient" class="btn btn-xs btn-outline-success" ><i
//                                    class="fa fa-edit"></i>&nbsp;&nbsp;' . trans('site_lang.public_edit_btn_text') . '</button>';
//                        $button .= '&nbsp;&nbsp;';
//                        $button .= '<button data-client-id="' . $data->id . '" id="deleteClient"  class="btn btn-xs btn-outline-danger"" ><i
//                                    class="fa fa-times fa fa-white"></i>&nbsp;&nbsp;' . trans('site_lang.public_delete_text') . '</button>';
//                        return $button;
//                    })
//                    ->rawColumns(['status', 'action'])
//                    ->make(true);

            $packages = Package::all();
            $selected_package = 0;
            return view('manager.Subscribers.subscribers', compact('packages', 'data', 'selected_package'));
        } else {
            return redirect(url('home'));

        }
    }

    public function search_new(Request $request)
    {
        $selected_package = $request->cmb_package_id;
        $user_type = auth()->user()->type;
        if ($user_type == 'manager') {
            if ($request->cmb_package_id != null) {
                $data = User::where('parent_id', null)->where('package_id', $request->cmb_package_id)->where('type', '!=', 'manager')
                    ->get();
            } else {
                $data = User::where('parent_id', null)->where('package_id', '!=', null)->where('type', '!=', 'manager')
                    ->get();
            }
            $packages = Package::all();
            return view('manager.Subscribers.subscribers', compact('packages', 'data', 'selected_package'));
        } else {
            return redirect(url('home'));
        }
    }

    public function search()
    {
        $user_type = auth()->user()->type;
        if ($user_type == 'manager') {
            if (request()->ajax()) {

                return datatables()->of(User::where('parent_id', null)
                    ->where('type', '!=', 'manager')
                    ->with('package_id')
                    ->get())
                    ->addColumn('status', function ($data) {
                        if ($data->status == trans('site_lang.statusDeactive')) {
                            $html = '<p class="btn btn-sm" data-user-id="' . $data->id . '" id="change-user-status">
                            <span class="label label-danger text-bold"> ' . $data->status . '</span></p>';
                        } else if ($data->status == trans('site_lang.statusDemo')) {
                            $html = '<p class="btn btn-sm" data-user-Id="' . $data->id . '" id="change-user-status">
                            <span class="label label-warning text-bold"> ' . $data->status . '</span></p>';
                        } else {
                            $html = '<p class="btn btn-sm" data-user-Id="' . $data->id . '" id="change-user-status">
                            <span class="label label-success text-bold"> ' . $data->status . '</span></p>';
                        }

                        return $html;
                    })
                    ->addColumn('action', function ($data) {
                        $button = '<button data-client-id="' . $data->id . '" id="editClient" class="btn btn-xs btn-blue tooltips" ><i
                                    class="fa fa-edit"></i>&nbsp;&nbsp;' . trans('site_lang.public_edit_btn_text') . '</button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button data-client-id="' . $data->id . '" id="deleteClient"  class="btn btn-xs btn-red tooltips" ><i
                                    class="fa fa-times fa fa-white"></i>&nbsp;&nbsp;' . trans('site_lang.public_delete_text') . '</button>';
                        return $button;
                    })
                    ->rawColumns(['status', 'action'])
                    ->make(true);
            }
            $packages = Package::all();
            return view('manager.Subscribers.subscribers', compact('packages'));
        } else {
            return redirect(url('home'));

        }
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

    // update session status from waiting to done
    public function updateStatus($type, $id)
    {

        $status = false;
        $user = User::find($id);

        if ($type == 'active') {
            $user->status = "Active";
            $user->created_at = Carbon::now();
        } else if ($type == 'deactive') {
            $user->status = "Deactive";
            $user->created_at = Carbon::now();
        } else {
            $user->status = "Active";
            $status = false;
        }
        $user->update();

        return back();
//        return response(['msg' => trans('site_lang.public_success_text'), 'status' => $status]);

    }

    public function updateStatusActive($id)
    {
        $user = User::find($id);
        $user->status = "Deactive";
        $user->update();
        return back();
    }

    public function store(Request $request)
    {
        $data = $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|unique:users,email|regex:/(.+)@(.+)\.(.+)/i',
            'password' => 'required',
            'phone' => 'required|unique:users,phone',
            'address' => 'required',
            'cat_name' => 'required',
            'package_id' => 'required',
            'image' => 'required',
            'card_image' => 'required',
        ]);
        $Cat_data['name'] = $request->cat_name;
        $category = category::create($Cat_data);
        $data['password'] = bcrypt(request('password'));
        $data['cat_id'] = $category->id;
        $data['status'] = 'Active';
        $data['type'] = 'admin';
        $six_digit_random_number = mt_rand(1000, 9999);
        $exists_user_code = User::where('user_code', $six_digit_random_number)->first();
        if ($exists_user_code) {
            $new_six_digit_random_number = mt_rand(1000, 9999);
            $data['user_code'] = $new_six_digit_random_number;
        } else {
            $data['user_code'] = $six_digit_random_number;
        }
        $package = Package::find($request->package_id);
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
        if ($request['card_image'] != null) {
            $file = $request->file('card_image');
            $ext = $file->getClientOriginalExtension();
            $fileNewName = 'img_' . time() . '.' . $ext;
            $file->move(public_path('uploads/register'), $fileNewName);
            $data['card_image'] = $fileNewName;
        }
        if ($request['image'] != null) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $fileNewName = 'img_' . time() . '.' . $ext;
            $file->move(public_path('uploads/userprofile'), $fileNewName);
            $data['image'] = $fileNewName;
        }
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
        session()->flash('success', trans('site_lang.add_success'));
        $per->save();
        return back();
    }

    public function updateData(Request $request)
    {

        $data = $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$request->id,
            'password' => 'nullable',
            'phone' => 'required|unique:users,phone,'.$request->id,
            'address' => 'required',


        ]);
        if ($request->password){
            $data['password'] = Hash::make($request->password);
        }
        if ($request['card_image'] != null) {
            $file = $request->file('card_image');
            $ext = $file->getClientOriginalExtension();
            $fileNewName = 'img_' . time() . '.' . $ext;
            $file->move(public_path('uploads/register'), $fileNewName);
            $data['card_image'] = $fileNewName;
        }else{
            unset($data['card_image']);
        }
        if ($request['image'] != null) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $fileNewName = 'img_' . time() . '.' . $ext;
            $file->move(public_path('uploads/userprofile'), $fileNewName);
            $data['image'] = $fileNewName;
        }else{
            unset($data['image']);
        }
        User::whereId($request->id)->update($data);
        session()->flash('success', 'تم التعديل بنجاح');
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
        $user = User::where('id', $request->id)->first();
        $package = Package::find($request->package_id);
        $mytime = Carbon::now();
        $today = Carbon::parse($mytime->toDateTimeString())->format('Y-m-d H:i');
        $final_today = Carbon::createFromFormat('Y-m-d H:i', $today);
        $warning_final_today = Carbon::createFromFormat('Y-m-d H:i', $today);
        //to generate expiry date ...
        $expire_date = $final_today->addMonths($package->duration);
        $user->expiry_date = $expire_date;
        //for generate warning date ...
        $for_warning_date = $warning_final_today->addMonths($package->duration);
        $warning_date = $for_warning_date->subDays(10);
        $user->warning_date = $warning_date;
        $user->package_id = $request->package_id;
        $user->status = "Active";
        $user->save();
        $data['package_id'] = $request->package_id;
        User::where('parent_id', $request->id)->update($data);
        return back();
    }

    public function destroy($id)
    {
        $data = User::findOrFail($id);
        $data->delete();
        return back();
    }
}
