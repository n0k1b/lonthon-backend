<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubcategoryRequest;
use App\Models\Subcategory;
use App\Models\CategorySubcategoryGenreMap;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function contentSubcat()
    {
        return json_encode(Subcategory::orderByDesc('id')->get());
    }
    public function insert(SubcategoryRequest $request)
    {
        $sub = Subcategory::create($request->except('_token','category'));
        CategorySubcategoryGenreMap::create(['category_id'=>$request->category,'subcategory_id'=>$sub->id]);
        return redirect('/subcategory');
    }

    public function create()
    {
        return view('admin.subcategory.insert');
    }

    public function show()
    {
        return view('admin.subcategory.show')->with("subcategories", Subcategory::orderByDesc('id')->with("category")->get());
    }

    public function trash()
    {
        return view('admin.subcategory.trash')->with("subcategories", Subcategory::onlyTrashed()->get());
    }

    public function restore($id)
    {
        // to restore soft delete
        Subcategory::withTrashed()->find($id)->restore();
        return back();
    }

    public function forced($id)
    {
        // to delete forever
        Subcategory::withTrashed()->find($id)->forceDelete();
        return back();
    }

    public function delete($id)
    {
        Subcategory::find($id)->delete();
        return back();
    }

    public function edit($id)
    {
        return view("admin.subcategory.edit",["subcategory"=>Subcategory::find($id)]);
    }

    public function update(Request $req, $id)
    {
        $cat = Subcategory::find($id);
        $cat->name = $req->name;
        $cat->description = $req->description;
        $cat->update();
        return redirect('subcategory');
    }
}
