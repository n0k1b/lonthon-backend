<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenreRequest;
use App\Models\CategorySubcategoryGenreMap;
use App\Models\Genre;

class GenreController extends Controller
{
    public function index()
    {
        $genres = CategorySubcategoryGenreMap::with(['subCategory', 'category', 'genre'])->whereNotNull('genre_id')->get();
        return view('admin.genre.show', compact('genres'));

    }
    public function insert(GenreRequest $request)
    {
        $gen = Genre::create($request->except('_token','category', 'subcategory'));
        CategorySubcategoryGenreMap::create(['category_id' => $request->category, 'subcategory_id' => $request->subcategory, 'genre_id' => $gen->id]);
        return redirect('genres');
    }

    public function create()
    {
        return view('admin.genre.insert')->with("categories",\App\Models\Category::with(['maps' => function ($query)
        {
            $query->select('subcategory_id','category_id');
            $query->distinct('subcategory_id');
            $query->with('subCategory');
        }])->get());
    }

    // public function show()
    // {
    //     return view('admin.genre.show')->with("genres", Genre::orderByDesc('id')->with('subcategory')->get());
    // }

    public function trash()
    {
        return view('admin.genre.trash')->with("genres", Genre::onlyTrashed()->get());
    }

    public function restore($id)
    {
        // to restore soft delete
        Genre::withTrashed()->find($id)->restore();
        return back();
    }

    public function forced($id)
    {
        // to delete forever
        Genre::withTrashed()->find($id)->forceDelete();
        return back();
    }

    public function delete($id)
    {
        Genre::find($id)->delete();
        return back();
    }

    public function edit($id)
    {
        return view("admin.genre.edit", ["map" => CategorySubcategoryGenreMap::where('genre_id',$id)->with('category','subcategory','genre')->first()]);
    }

    public function update(GenreRequest $req, $id)
    {
        $cat = Genre::find($id);
        $cat->name = $req->name;
        $cat->description = $req->description;
        $cat->update();
        return redirect('genres');
    }
}
