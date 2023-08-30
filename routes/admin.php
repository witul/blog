<?php

use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\UserController;
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


/*
 * Predefined /admin prefix
*/


Route::GET('/', [AdminPostController::class, 'index'])->middleware('admin')->name('home')->can('access-admin');

Route::middleware(['can:manage-posts'])
    ->name('post.')
    ->prefix('/posts')
    ->group(function () {
        Route::GET('/', [AdminPostController::class, 'index'])->name('index');
        Route::GET('/create', [AdminPostController::class, 'create'])->name('create');
        Route::GET('/{id}/edit', [AdminPostController::class, 'edit'])->name('edit');
        Route::GET('/{id}', [AdminPostController::class, 'show'])->name('show');

        Route::POST('/', [AdminPostController::class, 'store'])->name('store');

        Route::PUT('/{id}', [AdminPostController::class, 'update'])->name('update');

        Route::DELETE('/', [AdminPostController::class, 'destroy'])->name('destroy');
    });

Route::middleware(['can:manage-users'])
    ->name('user.')
    ->prefix('/users')
    ->group(function () {
        Route::GET('/', [UserController::class, 'index'])->name('index');
        Route::GET('/create', [UserController::class, 'create'])->name('create');
        Route::GET('/{id}/reset', [UserController::class, 'resetPassword'])->name('reset');
        Route::GET('/{id}/verify', [UserController::class, 'verify'])->name('verify');

        Route::POST('/', [UserController::class, 'store'])->name('store');
        Route::GET('/{id}', [UserController::class, 'show'])->name('show');
        Route::GET('/{id}/edit', [UserController::class, 'edit'])->name('edit');
        Route::PUT('/{id}', [UserController::class, 'update'])->name('update');
        Route::DELETE('/', [UserController::class, 'destroy'])->name('destroy');
    });

