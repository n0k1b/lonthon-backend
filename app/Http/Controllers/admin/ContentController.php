<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContentRequest;
use App\Models\Category;
use App\Models\Content;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function insert(ContentRequest $request)
    {
        Content::create($request->all());
        return redirect('/contents');
    }

    public function create()
    {
        // working on it
        // return view('admin.content.insert')->with(["categories"=>Category::with('subcategories')->with('genres')]);
    }

    public function show()
    {
        return view('admin.content.show')->with("contents", Content::with('map')->orderByDesc('id')->paginate(5));
    }

    public function trash()
    {
        return view('admin.content.trash')->with("contents", Content::onlyTrashed()->paginate(5));
    }

    public function restore($id)
    {
        // to restore soft delete
        Content::withTrashed()->find($id)->restore();
        return back();
    }

    public function forced($id)
    {
        // to delete forever
        Content::withTrashed()->find($id)->forceDelete();
        return back();
    }

    public function delete($id)
    {
        Content::find($id)->delete();
        return back();
    }

    public function edit($id)
    {
        return view("admin.content.edit",["content"=>Content::find($id)]);
    }

    public function update(ContentRequest $req, $id)
    {
        $cat = Content::find($id);
        $cat->name = $req->name;
        $cat->description = $req->description;
        $cat->update();
        return redirect('contents');
    }
}
