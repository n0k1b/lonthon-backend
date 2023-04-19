<?php

use App\http\controllers\admin\CategoryController;
use App\Http\Controllers\admin\ContentController;
use App\Http\Controllers\admin\GenreController;
use App\Http\Controllers\admin\SubcategoryController;
use App\Http\Controllers\BusinessSettingController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {return view("admin.dashboard");});

// business settings
Route::prefix('settings')->group(function () {
    Route::prefix('text')->group(function () {
        Route::get('/', [BusinessSettingController::class, "textEdit"]);
        Route::post('/update', [BusinessSettingController::class, "textUpdate"]);
    });
    Route::prefix('media')->group(function () {
        Route::get('/', [BusinessSettingController::class, "mediaEdit"]);
        Route::post('/update', [BusinessSettingController::class, "mediaUpdate"]);
    });
});

// contents
Route::get('/content', [ContentController::class, "show"]);
Route::get('/create-cont', [ContentController::class, "create"]);
Route::prefix('/content')->group(function () {
    Route::post('/insert', [ContentController::class, "insert"])->name("content-inserting");
    Route::get('/delete/{id}', [ContentController::class, "delete"])->name("content-deleting");
    Route::get('/edit/{id}', [ContentController::class, "edit"])->name("content-editing");
    Route::post('/update/{id}', [ContentController::class, "update"])->name("content-updating");
    // Route::get('/trash', [ContentController::class, "trash"]);
    // Route::get('/restore/{id}', [ContentController::class, "restore"])->name("content-restore");
    // Route::get('/forced/{id}', [ContentController::class, "forced"])->name("content-forced");
});

// category
Route::get('/categories', [CategoryController::class, "show"]);
Route::get('/create-cat', [CategoryController::class, "create"]);
Route::get('/edit/{id}/category', [CategoryController::class, "edit"])->name("category-editing");
Route::prefix('/category')->group(function () {
    Route::post('/insert', [CategoryController::class, "insert"])->name("category-inserting");
    Route::get('/delete/{id}', [CategoryController::class, "delete"])->name("category-deleting");
    Route::post('/update/{id}', [CategoryController::class, "update"])->name("category-updating");
    // Route::get('/trash', [CategoryController::class, "trash"]);
    // Route::get('/restore/{id}', [CategoryController::class, "restore"])->name("category-restore");
    // Route::get('/forced/{id}', [CategoryController::class, "forced"])->name("category-forced");
});

// subcategory
Route::get('/create-sub', [SubcategoryController::class, "create"]);
Route::get('/edit/{id}/category-sub', [SubcategoryController::class, "edit"])->name("subcategory-editing");
Route::prefix('/subcategory')->group(function () {
    Route::get('/', [SubcategoryController::class, "index"]);
    Route::post('/insert', [SubcategoryController::class, "insert"])->name("subcategory-inserting");
    Route::get('/delete/{id}', [SubcategoryController::class, "delete"])->name("subcategory-deleting");
    Route::post('/update/{id}', [SubcategoryController::class, "update"])->name("subcategory-updating");
    // Route::get('/trash', [SubcategoryController::class, "trash"]);
    // Route::get('/restore/{id}', [SubcategoryController::class, "restore"])->name("subcategory-restore");
    // Route::get('/forced/{id}', [SubcategoryController::class, "forced"])->name("subcategory-forced");
});

// genre
Route::get('/create-gen', [GenreController::class, "create"]);
Route::get('/edit/{id}/genre', [GenreController::class, "edit"])->name("genre-editing");
Route::prefix('/genres')->group(function () {
    Route::get('/', [GenreController::class, "index"]);
    Route::post('/insert', [GenreController::class, "insert"])->name("genre-inserting");
    Route::get('/delete/{id}', [GenreController::class, "delete"])->name("genre-deleting");
    Route::post('/update/{id}', [GenreController::class, "update"])->name("genre-updating");
    // Route::get('/trash', [GenreController::class, "trash"]);
    // Route::get('/restore/{id}', [GenreController::class, "restore"])->name("genres-restore");
    // Route::get('/forced/{id}', [GenreController::class, "forced"])->name("genres-forced");
});
