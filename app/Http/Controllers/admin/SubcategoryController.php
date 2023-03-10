<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubcategoryRequest;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function insert(SubcategoryRequest $request)
    {
        Subcategory::create($request->all());
        return redirect('/admin/subcategory/all');
    }

    public function create()
    {
        return view('admin.subcategory.insert');
    }

    public function show()
    {
        return view('admin.subcategory.show')->with("subcategories", Subcategory::paginate(5));
    }

    public function trash()
    {
        return view('admin.subcategory.trash')->with("subcategories", Subcategory::withTrashed()->paginate(5));
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

    public function update(SubcategoryRequest $req, $id)
    {
        $cat = Subcategory::find($id);
        $cat->name = $req->name;
        $cat->description = $req->description;
        $cat->update();
        return redirect('/admin/subcategory/all');
    }
}
