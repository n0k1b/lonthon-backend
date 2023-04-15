<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenreRequest;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function contentGen()
    {
        return json_encode(Genre::orderByDesc('id')->get());
    }

    public function insert(GenreRequest $request)
    {
        $gen = Genre::create($request->except('_token'));
        CategorySubcategoryGenreMap::create(['category_id'=>$request->category,'subcategory_id'=>$request->subcategory,'genre'=>$gen->id]);
        return redirect('genre');
    }

    public function create()
    {
        return view('admin.genre.insert');
    }

    public function show()
    {
        return view('admin.genre.show')->with("genres", Genre::orderByDesc('id')->with('subcategory')->get());
    }

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
        return view("admin.genre.edit",["genre"=>Genre::find($id)]);
    }

    public function update(GenreRequest $req, $id)
    {
        $cat = Genre::find($id);
        $cat->name = $req->name;
        $cat->description = $req->description;
        $cat->update();
        return redirect('genre');
    }
}
