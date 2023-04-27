<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function textToImage(Request $request)
    {
        return $request->all();
    }
}
