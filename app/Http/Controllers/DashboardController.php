<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    function index(Request $request)
    {
        // Logic to display the dashboard
        $token = session('auth.token');

        $response = Http::withToken($token)->get('http://localhost:8080/items/user');

       

        if ($response->successful()) {
            $data = $response->json('data');
            

            return view('dashboard.dashboard', compact('data'));
        }else{
            return view('dashboard.dashboard', ['data' => []]);
        }
        // return view('dashboard.dashboard');
    }

    function showDetailItem(Request $request, $id)
    {
        $token = session('auth.token');
        $response = Http::withToken($token)->get("http://localhost:8080/items/{$id}");

        if ($response->ok()) {
            return view('dashboard.detail', ['item' => $response->json()['data']]);
        } else {
            return back()->with('flash', ['danger', 'Item not found']);
        }
    }
    
}


