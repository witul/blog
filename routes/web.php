<?php

use App\Http\Controllers\Blog\AccountController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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


/** Routes for email verification */

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (\Illuminate\Http\Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


//handling registration form
Route::get('/create-account', [AccountController::class, 'registration'])
    ->middleware('guest')
    ->name('blog.account.registration');

//handling creating account
Route::post('/account', [AccountController::class, 'store'])
    ->middleware('guest')
    ->name('account.create');

//login form
Route::get('/login', [AccountController::class, 'login'])
    ->middleware('guest')
    ->name('login');

//handle login process
Route::post('/login', [AccountController::class, 'authenticate'])
    ->middleware('guest')
    ->name('authenticate');

//logout
Route::get('/logout', [AccountController::class, 'logout'])
    //->middleware('guest')
    ->name('logout');


Route::get('/password-forgot', [AccountController::class, 'forgotPassword'])->middleware('guest')->name('password.request');

Route::post('/password-forgot', [AccountController::class, 'sendResetPasswordLink'])
    ->middleware('guest')
    ->name('password.send-reset-link');


/*
Route::get('/account/create', [AccountController::class, 'registrationForm'])
    ->middleware('guest')
    ->name('account.create');
*/

Route::post('/account/create', [AccountController::class, 'store'])
    ->middleware('guest')
    ->name('account.store');


/** Forgot password - creating form and handling email from user */


Route::get('/forgot-password', function () {
    return view('blog.account.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', [AccountController::class, 'forgotPassword'])
    ->middleware('guest')->name('password.email');

/* Forgot password ops */
Route::get('/reset-password/{token}', function (string $token) {
    return view('blog.account.reset-password', ['token' => $token, 'email' => request()->get('email')]);
})->middleware('guest')->name('password.reset');


Route::fallback(function () {
    return redirect('/');
    //return 'Hm, why did you land here somehow?';
});
