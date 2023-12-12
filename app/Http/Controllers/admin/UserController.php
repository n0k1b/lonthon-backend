<?php

namespace App\Http\Controllers\admin;
use App\Models\UserModel;
use App\Http\Controllers\Controller;
use App\Models\admin\UserModel as AdminUserModel;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
       return view('admin.user.show')->with("users",User::orderByDesc('id')->get());;

        }
}
