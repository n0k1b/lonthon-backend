<?php

use Illuminate\Support\Facades\Route;
use App\http\controllers\admin\CategoryController;
use App\Http\Controllers\admin\ContentController;
use App\Http\Controllers\admin\GenreController;
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

    Route::get('/',function () { return view("admin.dashboard"); });


    // contents
    Route::get('/content',[ContentController::class,"show"]);
    Route::get('/create-cont',[ContentController::class,"create"]);
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
    Route::get('/category-for-content',[CategoryController::class, "contentCat"]);
    Route::get('/categories', [CategoryController::class, "show"]);
    Route::get('/create-cat', [CategoryController::class, "create"]);
    Route::prefix('/category')->group(function () {
        Route::post('/insert', [CategoryController::class, "insert"])->name("category-inserting");
        Route::get('/delete/{id}', [CategoryController::class, "delete"])->name("category-deleting");
        Route::get('/edit/{id}', [CategoryController::class, "edit"])->name("category-editing");
        Route::post('/update/{id}', [CategoryController::class, "update"])->name("category-updating");
        // Route::get('/trash', [CategoryController::class, "trash"]);
        // Route::get('/restore/{id}', [CategoryController::class, "restore"])->name("category-restore");
        // Route::get('/forced/{id}', [CategoryController::class, "forced"])->name("category-forced");
    });

    // subcategory
    Route::get('/subcategory-for-content',[SubcategoryController::class, "contentSubcat"]);
    Route::get('/subcategory', [SubcategoryController::class, "show"]);
    Route::get('/create-sub', [SubcategoryController::class, "create"]);
    Route::prefix('/subcategory')->group(function () {
        Route::post('/insert', [SubcategoryController::class, "insert"])->name("subcategory-inserting");
        Route::get('/delete/{id}', [SubcategoryController::class, "delete"])->name("subcategory-deleting");
        Route::get('/edit/{id}', [SubcategoryController::class, "edit"])->name("subcategory-editing");
        Route::post('/update/{id}', [SubcategoryController::class, "update"])->name("subcategory-updating");
        // Route::get('/trash', [SubcategoryController::class, "trash"]);
        // Route::get('/restore/{id}', [SubcategoryController::class, "restore"])->name("subcategory-restore");
        // Route::get('/forced/{id}', [SubcategoryController::class, "forced"])->name("subcategory-forced");
    });

    // genre
    Route::get('/genre-for-content',[GenreController::class, "contentGen"]);
    Route::get('/genre', [GenreController::class, "show"]);
    Route::get('/create-gen', [GenreController::class, "create"]);
    Route::prefix('/genres')->group(function () {
        Route::post('/insert', [GenreController::class, "insert"])->name("genre-inserting");
        Route::get('/delete/{id}', [GenreController::class, "delete"])->name("genre-deleting");
        Route::get('/edit/{id}', [GenreController::class, "edit"])->name("genre-editing");
        Route::post('/update/{id}', [GenreController::class, "update"])->name("genre-updating");
        // Route::get('/trash', [GenreController::class, "trash"]);
        // Route::get('/restore/{id}', [GenreController::class, "restore"])->name("genres-restore");
        // Route::get('/forced/{id}', [GenreController::class, "forced"])->name("genres-forced");
    });
