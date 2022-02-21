<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use Illuminate\Routing\RouteGroup;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
// });


// posts routes
Route::GET('/', [PostController::class, 'index'])->name('posts.index');
Route::GET('/posts', [PostController::class, 'index'])->name('posts.index');

Route::middleware(['auth'])->group(function () {
    Route::GET('/posts/archive', [PostController::class, 'archive'])->name('posts.archive');
    Route::POST('/posts/{post}', [PostController::class, 'restore'])->name('posts.restore');

    Route::GET('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::POST('/posts', [PostController::class, 'store'])->name('posts.store');

    Route::GET('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

    Route::GET('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::PUT('/posts/{post}', [PostController::class, 'update'])->name('posts.update');

    Route::DELETE('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
});









Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
