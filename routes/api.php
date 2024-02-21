<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BusinessSettingController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\WithdrawController;
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
Route::post('/content-update/{id}', [ContentController::class, 'update']);

Route::get('content-by-category', [ContentController::class, 'contentByCategory']);
Route::apiResource('content', ContentController::class);
Route::get('fetchContentFromCategory/{id}', [ContentController::class, 'fetchContentFromCategory']);
Route::get('fetchContentFromSubCategory/{id}', [ContentController::class, 'fetchContentFromSubCategory']);
Route::get('fetchContentFromGenre/{id}', [ContentController::class, 'fetchContentFromGenre']);
Route::post('signup', [AuthController::class, 'signup']);
Route::post('login', [AuthController::class, 'login']);
Route::post('verifyOtp', [AuthController::class, 'verifyOtp']);
Route::get('thumbnailImageGallery', [BusinessSettingController::class, 'thumbnailImageGallery']);
Route::get('bannerImageGallery', [BusinessSettingController::class, 'bannerImageGallery']);
Route::post('initiate-payment', [PaymentController::class, 'initiatePayment']);
Route::get('withdraw-dashboard', [WithdrawController::class, 'withdrawDashboard']);
Route::post('withdraw-request', [WithdrawController::class, 'withdrawRequest']);

Route::group(['middleware' => ['auth:api']], function () {

    Route::get('dashboard', [DashboardController::class, 'index']);

});
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
