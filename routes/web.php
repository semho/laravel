<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\AdminController;

Route::get('/', [ArticlesController::class, 'index']);
//Route::get('/articles/create', [ArticlesController::class, 'create']);
//Route::post('/articles', [ArticlesController::class, 'store']);
//
//Route::get('/articles/{slug}', [ArticlesController::class, 'show']);

Route::resource('/articles', ArticlesController::class);

Route::get('/contacts', [ContactsController::class, 'index']);
Route::post('/contacts', [ContactsController::class, 'store']);

Route::get('/admin/feedback', [AdminController::class, 'feedback']);

Route::get('/about', function() {
    return view('about.index');
});
