<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BusinessSetting;

class BusinessSettingController extends Controller
{
    public function index()
    {
        return json_decode(BusinessSetting::all());
    }
}
