<?php

use Illuminate\Support\Facades\Route;
use App\http\controllers\admin\CategoryController;
use App\Http\Controllers\admin\SubcategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::prefix('/category')->group(function () {
        Route::get('/all', [CategoryController::class, "show"]);
        Route::get('/create', [CategoryController::class, "create"]);
        Route::post('/insert', [CategoryController::class, "insert"])->name("category-inserting");
        Route::get('/delete/{id}', [CategoryController::class, "delete"])->name("category-deleting");
        Route::get('/edit/{id}', [CategoryController::class, "edit"])->name("category-editing");
        Route::post('/update/{id}', [CategoryController::class, "update"])->name("category-updating");
        Route::get('/trash', [CategoryController::class, "trash"]);
        Route::get('/restore/{id}', [CategoryController::class, "restore"])->name("category-restore");
        Route::get('/forced/{id}', [CategoryController::class, "forced"])->name("category-forced");
    });
    Route::prefix('/subcategory')->group(function () {
        Route::get('/all', [SubcategoryController::class, "show"]);
        Route::get('/create', [SubcategoryController::class, "create"]);
        Route::post('/insert', [SubcategoryController::class, "insert"])->name("subcategory-inserting");
        Route::get('/delete/{id}', [SubcategoryController::class, "delete"])->name("subcategory-deleting");
        Route::get('/edit/{id}', [SubcategoryController::class, "edit"])->name("subcategory-editing");
        Route::post('/update/{id}', [SubcategoryController::class, "update"])->name("subcategory-updating");
        Route::get('/trash', [SubcategoryController::class, "trash"]);
        Route::get('/restore/{id}', [SubcategoryController::class, "restore"])->name("subcategory-restore");
        Route::get('/forced/{id}', [SubcategoryController::class, "forced"])->name("subcategory-forced");
    });
});
