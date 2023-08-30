<?php

use App\Http\Controllers\Blog\PostController;
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


Route::GET('/', [PostController::class, 'index'])->middleware('web')->name('blog.home');

Route::GET('/post/{id}', [PostController::class, 'get'])->name('blog.post.show');

