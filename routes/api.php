<?php

use App\Http\Controllers\BusinessSettingController;
use App\Http\Controllers\HomepageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
 */

Route::get('homepage-content', [HomepageController::class, 'index']);
Route::get('business-settings', [BusinessSettingController::class, 'index']);
Route::post('text-to-image',[MediaController::class,'textToImage']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
