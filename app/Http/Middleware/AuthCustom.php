<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthCustom
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->has('auth')) {
            if (!session('auth')['user']['active']) {
                $email = session('auth')['user']['email'];
                return redirect('/verify-otp?email=' . $email . '&purpose=regis')->with('flash', ['warning', 'Mohon verifikasi email terlebih dahulu']);
            }

            if (session('auth')['user']['active'] && session('auth')['exp'] > time()) {
                return $next($request);
            }
        }

        session()->forget('auth');

        return redirect('/login');
    }
}
