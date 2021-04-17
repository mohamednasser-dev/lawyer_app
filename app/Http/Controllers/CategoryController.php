<?php

namespace App\Http\Controllers;

use App\category;
use App\mohdr;
use App\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
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
         $enabled = $permission->category;
        if ($enabled == 'yes') {
            if (request()->ajax()) {
                return datatables()->of(DB::table('categories')->where('parent_id', getQuery())
                    ->orderBy('id', 'desc')
                    ->get())
                    ->addColumn('action', function ($data) {
                        $button = '<button data-category-id="' . $data->id . '" id="editCategory" class="btn btn-xs btn-outline-primary" ><i
                                    class="fa fa-edit"></i>&nbsp;&nbsp;' . trans('site_lang.public_edit_btn_text') . '</button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button data-category-id="' . $data->id . '" id="deleteCategory"  class="btn btn-xs btn-outline-danger" ><i
                                    class="fa fa-times fa fa-white"></i>&nbsp;&nbsp;' . trans('site_lang.public_delete_text') . '</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('categories/categories');
        } else {
            return redirect(url('home'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public
    function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public
    function store(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->validate(request(), [
                'name' => 'required',
            ]);
            $data['parent_id'] = getQuery();
            category::create($data);
            return response(['msg' => trans('site_lang.public_success_text')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\category $category
     * @return \Illuminate\Http\Response
     */
    public
    function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\category $category
     * @return \Illuminate\Http\Response
     */
    public
    function edit($id)
    {
        if (request()->ajax()) {
            $data = category::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }


    public
    function update(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->validate(request(), [
                'name' => 'required',
            ]);
            $category = category::find($request->id);
            $category->name = $request->input('name');
            $category->update();
            return response(['msg' => trans('site_lang.public_success_text')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\category $category
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        $data = category::findOrFail($id);
        try {
            $data->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                //SQLSTATE[23000]: Integrity constraint violation
                return response(['msg' => trans('site_lang.cannot_delete_parent_category')]);
            }
        }


    }
}
