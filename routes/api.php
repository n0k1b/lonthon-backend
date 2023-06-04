<?php

use App\Http\Controllers\BusinessSettingController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\HomepageController;
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
Route::get('category', [HomepageController::class, 'getCategory']);
Route::get('category/{id}', [HomepageController::class, 'getSubCategory']);
Route::get('sub-category/{id}', [HomepageController::class, 'getGenre']);
Route::get('business-settings', [BusinessSettingController::class, 'index']);
Route::post('content-upload', [ContentController::class, 'store']);
Route::get('content-by-category', [ContentController::class, 'contentByCategory']);
Route::apiResource('content', ContentController::class);
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
