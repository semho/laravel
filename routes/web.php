<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\PushServiceController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TidingsController;
use App\Http\Controllers\StatisticsController;

Route::get('/', [ArticlesController::class, 'index']);

Route::get('/articles/tags/{tag}', [TagsController::class, 'index']);
Route::get('/tidings/tags/{tag}', [TagsController::class, 'tidings']);

Route::resource('/articles', ArticlesController::class);

Route::get('/contacts', [ContactsController::class, 'index']);
Route::post('/contacts', [ContactsController::class, 'store']);

Route::get('/admin', [AdminController::class, 'index']);
Route::get('/admin/feedback', [AdminController::class, 'feedback']);
Route::get('/admin/articles', [AdminController::class, 'articles']);
Route::get('/admin/tidings', [AdminController::class, 'tidings']);
Route::get('/admin/reports', [AdminController::class, 'reports']);
Route::get('/admin/reports_total', [AdminController::class, 'total']);
Route::post('/admin/reports_total', [AdminController::class, 'totalSend']);

Route::get('/about', function () {
    return view('about.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('service', [PushServiceController::class, 'form']);
Route::post('service', [PushServiceController::class, 'send']);

Route::post('/articles/{slug}', [CommentController::class, 'storeArticle']);
Route::post('/tidings/{slug}', [CommentController::class, 'storeTiding']);

Route::resource('/tidings', TidingsController::class);

Route::get('/statistics', [StatisticsController::class, 'index']);

require __DIR__.'/auth.php';

