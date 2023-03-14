<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
// use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function contentCat()
    {
        return json_encode(Category::orderByDesc('id')->get());
    }

    public function insert(CategoryRequest $request)
    {
        Category::create($request->all());
        return redirect('/categories');
    }

    public function create()
    {
        return view('admin.category.insert');
    }

    public function show()
    {
        return view('admin.category.show')->with("categories", Category::orderByDesc('id')->paginate(5));
    }

    public function trash()
    {
        return view('admin.category.trash')->with("categories", Category::onlyTrashed()->paginate(5));
    }

    public function restore($id)
    {
        // to restore soft delete
        Category::withTrashed()->find($id)->restore();
        return back();
    }

    public function forced($id)
    {
        // to delete forever
        Category::withTrashed()->find($id)->forceDelete();
        return back();
    }

    public function delete($id)
    {
        Category::find($id)->delete();
        return back();
    }

    public function edit($id)
    {
        return view("admin.category.edit",["category"=>Category::find($id)]);
    }

    public function update(CategoryRequest $req, $id)
    {
        $cat = Category::find($id);
        $cat->name = $req->name;
        $cat->description = $req->description;
        $cat->update();
        return redirect('categories');
    }
}
