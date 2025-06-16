<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::get('/', function () {
    return view('detail');
});

// Auth
Route::controller(AuthController::class)->group(function () {
    Route::middleware('guest.custom')->group(function () {
        Route::get('login', 'showLoginForm');
        Route::post('/login', 'login');

        Route::get('register', 'showRegisForm');
        Route::post('/register', 'register');
        
        Route::get('verify-otp', 'showOtpForm')->middleware('verify.otp');
        Route::post('/verify-regis', 'verifyRegis');
        Route::post('/verify-forgot-password', 'verifyForgotPassword');
        Route::post('/send-otp', 'sendOTP');

        Route::get('forgot-password', 'showForgotPasswordForm');
        Route::post('/forgot-password', 'forgotPassword');

        Route::get('reset-password', 'showResetPasswordForm')->middleware('reset.password');
        Route::post('/reset-password', 'resetPassword');
    });

    Route::post('/logout', 'logout')->middleware('auth.custom');
});

Route::get('/dashboard', function() {
    dd(session('auth'));
})->middleware('auth.custom');

Route::get('/profile', function () {
    return view('profile');
});
Route::get('/form', function () {
    return view('form');
});
