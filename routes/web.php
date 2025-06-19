<?php

use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;


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

        Route::get('forgot-password', 'showForgotPasswordForm');
        Route::post('/forgot-password', 'forgotPassword');

        Route::get('reset-password', 'showResetPasswordForm')->middleware('reset.password');
        Route::post('/reset-password', 'resetPassword');
    });
        
    Route::get('verify-otp', 'showOtpForm')->middleware('verify.otp');
    Route::post('/verify-regis', 'verifyRegis');
    Route::post('/verify-forgot-password', 'verifyForgotPassword');
    Route::post('/send-otp', 'sendOTP');

    Route::post('/logout', 'logout')->middleware('auth.custom');
});

Route::get('form', [ItemController::class, 'showForm']);
Route::post('/form', [ItemController::class, 'create'])->middleware('auth.custom')->name('item.create');


Route::middleware('auth.custom')->group(function () {
    Route::controller(UserController::class)->group(function() {
        Route::get('/profile', 'edit');
        Route::put('/profile', 'update');
    });
});

Route::post('/report/{id}', [ReportController::class, 'sendReport'])
    ->middleware('auth.custom')
    ->name('report.store');
Route::post('/report/{id}/guest', [ReportController::class, 'sendReportGuest']);
Route::get('/report/{id}/verify-otp', [ReportController::class, 'showVerifyOtpForm']);
Route::post('/report/{id}/verify-and-send', [ReportController::class, 'verifyOtp']);

Route::get('/test', function() {
    dd(session('auth'));
})->middleware('auth.custom');


Route::get('/dashboard', [DashboardController::class, 'index']);

Route::get('/dashboard/{id}', [DashboardController::class, 'getDetailItem']);
