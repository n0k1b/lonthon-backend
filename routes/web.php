<?php

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

require __DIR__.'/auth.php';
