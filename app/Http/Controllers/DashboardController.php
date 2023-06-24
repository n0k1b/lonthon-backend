<?php

namespace App\Http\Controllers;

use App\Models\Content;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $user = auth('api')->user();
        $total_content = 4000;
        $total_visitors = 5000;
        $total_order = 6000;
        $balance = 7000;
        $contents = Content::with('media')->where('user_id', $user->id)->get();

        $data = [
            'user' => $user,
            'total_contents' => $total_content,
            'total_visitors' => $total_visitors,
            'total_order' => $total_order,
            'balance' => $balance,
            'contents' => $contents,
        ];
        return $this->successJsonResponse('Dashboard data found', $data);
        //Log::info($user_id);
    }
}
