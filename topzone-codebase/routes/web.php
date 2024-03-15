<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController; // Đảm bảo import namespace đúng

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
Route::get('/posts/search', [PostController::class, 'search'])->name('posts.search');

Route::get('/post/create', [PostController::class, 'create']); // Sử dụng cú pháp mới của Laravel 8.x
Route::post('/post/submit', [PostController::class, 'store']); // Sử dụng cú pháp mới của Laravel 8.x

Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');

Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');


// Route::get('/', function () {
//     return view('welcome');
// });
