<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function edit() {
        $response = Http::withToken(session('auth')['token'])->get('http://localhost:8080/user/profile');
        return view('profile', ['data' => $response->json()['data']]);
    }

    public function update(UserRequest $request) {
        $validatedData = $request->validated();

        $body = [
            'fullname' => $validatedData['fullname'],
            'email' => $validatedData['email'],
            'phone-number' => $validatedData['phone_number'],
            'image-url' => $request->file('avatar') == null ? $request->old_avatar : null
        ];

        $http = Http::withToken(session('auth')['token'])->attach('user', json_encode($body), null, ['Content-Type' => 'application/json']);
        
        if ($request->file('avatar') != null) {
            $avatar = $request->file('avatar');
            $http->attach('image-url', file_get_contents($avatar->getRealPath()), $avatar->getClientOriginalName(), ['Content-Type' => $avatar->getMimeType()]);
        }

        $updateResponse = $http->put('http://localhost:8080/user/profile');

        if ($updateResponse->ok()) {
            $profileResponse = Http::withToken(session('auth')['token'])->get('http://localhost:8080/user/profile');
            $auth = session('auth');
            $auth['user'] = $profileResponse->json()['data'];
            session(['auth' => $auth]);

            return session('auth')['user']['active']
                        ? back()->with('flash', ['success', 'Update berhasil'])
                        : redirect('/verify-otp?email=' . session('auth')['user']['email'] . '&purpose=regis')->with('flash', ['success', 'Update berhasil, mohon verifikasi email terlebih dahulu']);;
        }

        if ($updateResponse->status() == 413) {
            return back()->with('flash', ['warning', 'Ukuran file melebihi batas maksimum (5MB)']);
        }

        if ($updateResponse->status() == 415) {
            return back()->with('flash', ['warning', $updateResponse->json('message', 'Update gagal')]);
        }

        return back()->with('flash', ['danger', 'Update gagal']);
    }
}
