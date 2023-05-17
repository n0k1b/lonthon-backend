<?php

use App\Http\Controllers\ContentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::get('homepage-content', [HomepageController::class, 'index']);
Route::get('business-settings', [BusinessSettingController::class, 'index']);
Route::post('content-upload', [ContentController::class, 'store']);
Route::get('content/{id}', [ContentController::class, 'show']);
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
