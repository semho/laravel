<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TagsController;

Route::get('/', [ArticlesController::class, 'index']);
Route::get('/articles/tags/{tag}', [TagsController::class, 'index']);

Route::resource('/articles', ArticlesController::class);

Route::get('/contacts', [ContactsController::class, 'index']);
Route::post('/contacts', [ContactsController::class, 'store']);

Route::get('/admin/feedback', [AdminController::class, 'feedback']);

Route::get('/about', function() {
    return view('about.index');
});

