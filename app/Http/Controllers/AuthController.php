<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OtpRequest;
use App\Http\Requests\EmailRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetPasswordRequest;

class AuthController extends Controller
{
    public function showRegisForm() {
        return view('auth.register');
    }

    public function register(RegisterRequest $request) {
        $validatedData = $request->validated();

        $body = [
            'fullname' => $validatedData['fullname'],
            'email' => $validatedData['email'],
            'phone-number' => $validatedData['phone_number'],
            'username' => $validatedData['username'],
            'password' => $validatedData['password']
        ];

        $response = Http::post('http://localhost:8080/auth/register', $body);

         if ($response->created()) {
            return redirect('/verify-otp?email=' . $response->json('data')['email'] . '&purpose=regis')->with('flash', ['success','Registrasi berhasil, mohon verifikasi email anda']);
         }
            
         return back()->with('flash', ['danger', $response->json()['message']]);
    }

    public function showOtpForm() {
        return view('auth.otp');
    }

    public function verifyRegis(OtpRequest $request) {
        $body = $request->validated();

        $response = Http::post('http://localhost:8080/auth/verify-regis', $body);

        if ($response->ok()) {
            if (session()->has('auth')) {
                $auth = session('auth');
                $auth['user']['active'] = true;
                session(['auth' => $auth]);
                return redirect('/profile')->with('flash', ['success', 'Verifikasi email berhasil']);
            } else {
                return redirect('/login')->with('flash', ['success', 'Verifikasi berhasil, silahkan login']);
            }
        }
            
        return back()->with('flash', ['warning', $response->json()['message']])->onlyInput('otp');
    }

    public function sendOTP(EmailRequest $request) {
        $body = $request->validated();

        $response = Http::post('http://localhost:8080/auth/send-otp', $body);

        if ($response->ok()) {
            return redirect('/verify-otp?email=' . $response->json()['data']['email'] . '&purpose=' . $request->purpose)->with('flash', ['success','Resend OTP berhasil, mohon verifikasi email anda']);
        }
            
        return back()->with('flash', ['danger', $response->json()['message']]);
    }

    public function showLoginForm() {
        return view('auth.login');    
    }

    public function login(LoginRequest $request) {
        $body = $request->validated();

        $loginResponse = Http::post('http://localhost:8080/auth/login', $body);
        
        if ($loginResponse->ok()) {
            $token = $loginResponse->json()['data']['token'];
            $userResponse = Http::withToken($token)->get('http://localhost:8080/user/profile');

            $request->session()->regenerate();
            session([ 'auth' => [
                    'token' => $token,
                    'exp' =>  time() + 1800,
                    'user' => $userResponse->ok() ? $userResponse->json()['data'] : null
                ]
            ]);

            return redirect()->intended('/profile');
        } 
        
        if ($loginResponse->forbidden()) {
            return redirect('/verify-otp?email=' . $loginResponse->json('data')['email'] . '&purpose=regis')->with('flash', ['warning','Akun anda belum terverifikasi, mohon verifikasi terlebih dahulu']);
        }
            
        return back()->with('flash', ['warning', $loginResponse->json()['message']])->onlyInput('username');
    }

    public function logout(Request $request) {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function showForgotPasswordForm() {
        return view('auth.forgot-password');
    }

    public function forgotPassword(EmailRequest $request) {
        $body = $request->validated();

        $response = Http::post('http://localhost:8080/auth/forgot-password', $body);

        if ($response->ok()) {
            return redirect('/verify-otp?email=' . $response->json()['data']['email'] . '&purpose=forgot')->with('flash', ['success','OTP telah dikirim, mohon verifikasi email anda']);
        }
        
        return back()->with('flash', ['warning', $response->json()['message']])->onlyInput('email');
    }

    public function verifyForgotPassword(OtpRequest $request) {
         $body = $request->validated();

        $response = Http::post('http://localhost:8080/auth/verify-forgot-password', $body);

        if ($response->ok()) {
            return redirect('/reset-password?token=' . $response->json()['data']['token'] . '&email=' . $body['email'])->with('flash', ['success', 'Verifikasi berhasil, silahkan reset password anda']);
        }
            
        return back()->with('flash', ['warning', $response->json()['message']])->onlyInput('otp');
    }

    public function showResetPasswordForm() {
        return view('auth.reset-password');
    }

    public function resetPassword(ResetPasswordRequest $request) {
        $validatedData = $request->validated();

        $body = [
            'email' => $validatedData['email'],
            'new-password' => $validatedData['password'],
            'confirm-new-password' => $validatedData['password'],
            'token' => $request->token
        ];

        $response = Http::post('http://localhost:8080/auth/reset-password', $body);

        if ($response->ok()) {
            return redirect('/login')->with('flash', ['success', 'Reset password berhasil, silahkan login']);
        }
            
        return back()->with('flash', ['warning', $response->json()['message']])->onlyInput('email');
    }
}
