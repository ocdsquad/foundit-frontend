<?php

use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;


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


// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', [HomeController::class, 'index'])->name('items.index');

Route::get('/items/{id}', [ItemController::class, 'getDetailItem'])->name('item.detail');

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

Route::get('form', [ItemController::class, 'showForm']);
Route::post('/form', [ItemController::class, 'create'])->middleware('auth.custom')->name('item.create');


Route::post('/report/{id}', [\App\Http\Controllers\ReportController::class, 'store'])
    ->middleware('auth.custom')
    ->name('report.store');


Route::middleware('auth.custom')->group(function () {
    Route::controller(UserController::class)->group(function() {
        Route::get('/profile', 'edit');
        Route::put('/profile', 'update');
    });
});

Route::post('/report/{id}', [\App\Http\Controllers\ReportController::class, 'sendReport'])
    ->middleware('auth.custom')
    ->name('report.store');


