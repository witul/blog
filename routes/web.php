<?php

use App\Http\Controllers\Blog\PostController as FrontPostController;
use App\Http\Controllers\Blog\AccountController;

use App\Http\Controllers\Admin\PostController as AdminPostController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

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


Route::get('/create-account', [AccountController::class, 'registration'])
    ->middleware('guest')
    ->name('account.registration');

Route::post('/account', [AccountController::class, 'store'])
    ->middleware('guest')
    ->name('account.create');


Route::get('/login', [AccountController::class, 'login'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [AccountController::class, 'authenticate'])
    ->middleware('guest')
    ->name('authenticate');


Route::get('/logout', [AccountController::class, 'logout'])
    //->middleware('guest')
    ->name('logout');


//    return view('auth.forgot-password');


Route::get('/forgot-password', [AccountController::class, 'forgotPassword'])->middleware('guest')->name('password.request');
Route::get('/password-forgot', [AccountController::class, 'forgotPassword'])
    ->middleware('guest')
    ->name('password.request');
Route::post('/password-forgot', [AccountController::class, 'sendResetPasswordLink'])
    ->middleware('guest')
    ->name('password.send-reset-link');


Route::get('/account/create', [AccountController::class, 'registrationForm'])
    ->middleware('guest')
    ->name('account.create');

Route::post('/account/create', [AccountController::class, 'store'])
    ->middleware('guest')
    ->name('account.store');

/** Forgot password - creating form and handling email from user */

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');


/* Forgot password ops */
Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token, 'email' => request()->get('email')]);
})->middleware('guest')->name('password.reset');


// Handling reset password form
Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
            $user->save();

            event(new PasswordReset($user));
        }
    );
    return $status === Password::PASSWORD_RESET
        ? redirect()->route('login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');

