<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubcategoryRequest;
use App\Models\CategorySubcategoryGenreMap;
use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = CategorySubcategoryGenreMap::with(['subCategory', 'category'])->select('subcategory_id', 'category_id')->distinct('subcategory_id')->get();
        return view('admin.subcategory.show')->with('subcategories',$subcategories);

    }

    public function insert(SubcategoryRequest $request)
    {
        $sub = Subcategory::create($request->except('_token', 'category'));
        CategorySubcategoryGenreMap::create(['category_id' => $request->category, 'subcategory_id' => $sub->id]);
        return redirect('/subcategory');
    }

    public function create()
    {
        return view('admin.subcategory.insert')->with("categories",Category::all());
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
        $subcats = CategorySubcategoryGenreMap::where('subcategory_id',$id)->whereNotNull('genre_id')->get();
        if(count($subcats)){
            return back()->with("error","It contains genres");
        }else{
            // CategorySubcategoryGenreMap::find($subcats->id)->delete();
            Subcategory::find($id)->delete();
            return back();
        }
    }

    public function edit($id)
    {
        return view("admin.subcategory.edit", ["subcategory" => CategorySubcategoryGenreMap::where('subcategory_id',$id)->whereNull('genre_id')->with('category','subcategory')->first()]);
    }

    public function update(SubcategoryRequest $req, $id)
    {
        $cat = Subcategory::find($id);
        $cat->name = $req->name;
        $cat->description = $req->description;
        $cat->update();
        return redirect('subcategory');
    }
}
