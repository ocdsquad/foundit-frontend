<?php

use App\Http\Middleware\EmailSession;
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

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/verify-otp', function () {
    return view('auth.otp');
})->middleware(EmailSession::class);

Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/verify-regis', 'verifyRegis');
    Route::post('/send-otp', 'sendOTP');
    Route::post('/login', 'login');
});
