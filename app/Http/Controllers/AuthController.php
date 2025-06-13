<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function register(Request $request) {
        $validatedData = $request->validate([
            'fullname' => ['required', 'min:4', 'max:100', 'regex:/^[a-zA-Z\\s]*$/'],
            'email' => ['required', 'max:100', 'regex:/^(?=.{1,64}@.{1,255}$)(?:(?![.])[a-zA-Z0-9._%+-]+(?:(?<!\\\\)[.][a-zA-Z0-9-]+)*?)@[a-zA-Z0-9.-]+(?:\\.[a-zA-Z]{2,50})+$/'],
            'phone_number' => ['required', 'regex:/^(62|\\+62|0)8[0-9]{9,13}$/'],
            'username' => ['required', 'min:3', 'max:50', 'regex:/^[a-z0-9.]*$/'],
            'password' => ['required', 'min:8', 'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[@_#\\-$]).*$/', 'confirmed']
        ]);

        $body = [
            'fullname' => $validatedData['fullname'],
            'email' => $validatedData['email'],
            'phone-number' => $validatedData['phone_number'],
            'username' => $validatedData['username'],
            'password' => $validatedData['password']
        ];

        $response = Http::post('http://localhost:8080/auth/register', $body);

         if ($response->created()) {
            session(['registered_email' => $response->json('data')['email']]);
            return redirect('/verify-otp')->with('flash', ['success','Registrasi berhasil, mohon verifikasi email anda']);
         } else {
            return back()->with('flash', ['danger', $response->json()['message']]); 
         }
    }

    public function verifyRegis(Request $request) {
        $body = $request->validate([
            'email' => ['required', 'max:100', 'regex:/^(?=.{1,64}@.{1,255}$)(?:(?![.])[a-zA-Z0-9._%+-]+(?:(?<!\\\\)[.][a-zA-Z0-9-]+)*?)@[a-zA-Z0-9.-]+(?:\\.[a-zA-Z]{2,50})+$/'],
            'otp' => ['required', 'regex:/^[0-9]{6}$/']
        ]);

        $response = Http::post('http://localhost:8080/auth/verify-regis', $body);

        if ($response->ok()) {
            session()->forget('registered_email');
            return redirect('/login')->with('flash', ['success', 'Verifikasi berhasil, silahkan login']);
        } else {
            return back()->with('flash', ['warning', $response->json()['message']]);
        }
    }

    public function sendOTP(Request $request) {
        $body = $request->validate([
            'email' => ['required', 'max:100', 'regex:/^(?=.{1,64}@.{1,255}$)(?:(?![.])[a-zA-Z0-9._%+-]+(?:(?<!\\\\)[.][a-zA-Z0-9-]+)*?)@[a-zA-Z0-9.-]+(?:\\.[a-zA-Z]{2,50})+$/']
        ]);

        $response = Http::post('http://localhost:8080/auth/send-otp', $body);

        if ($response->ok()) {
            session(['registered_email' => $response->json('data')['email']]);
            return redirect('/verify-otp')->with('flash', ['success','Resend OTP berhasil, mohon verifikasi email anda']);
        } else {
            return back()->with('flash', ['danger', $response->json()['message']]);
        }
    }

    public function login(Request $request) {
        $body = $request->validate([
            'username' => ['required', 'min:3', 'max:50', 'regex:/^[a-z0-9.]*$/'],
            'password' => ['required', 'min:8', 'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[@_#\\-$]).*$/']
        ]);

        $response = Http::post('http://localhost:8080/auth/login', $body);

        if ($response->ok()) {
            session(['auth_token' => $response->json()['data']['token']]);
            $request->session()->regenerate();
            return redirect()->intended();
        } elseif ($response->forbidden()) {
            session(['registered_email' => $response->json()['data']['email']]);
            return redirect('/verify-otp')->with('flash', ['warning','Akun anda belum terverifikasi, mohon verifikasi terlebih dahulu']);
        } else {
            return back()->with('flash', ['warning', $response->json()['message']])->onlyInput('username');
        }
    }
}
