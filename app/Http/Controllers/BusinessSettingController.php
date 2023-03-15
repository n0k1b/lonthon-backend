<?php

namespace App\Http\Controllers;

use App\Models\BusinessSetting;

class BusinessSettingController extends Controller
{
    public function index()
    {
        try {
            $data = BusinessSetting::all();
            if ($data) {
                return $this->successJsonResponse("Business settings data found", $data);
            } else {
                return $this->errorJsonResponse("Business settings data not found");
            }
        } catch (\Throwable$th) {
            return $this->exceptionJsonResponse($th);
        }
    }
}
