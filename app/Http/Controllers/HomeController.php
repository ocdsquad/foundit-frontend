<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = [
            'status' => $request->input('status'),
            'category-id' => $request->input('category-id'),
            'name' => $request->input('name'),
            'page' => $request->input('page', 0),
            'size' => $request->input('size', 10),
            'sort' => $request->input('sort') ?? 'createdAt,desc',
        ];

        $response = Http::get('http://localhost:8080/items', $query);

        $items = [];
        $pagination = null;

        if ($response->successful()) {
            $data = $response->json('data');
            $items = $data['content'];
            $pagination = [
                'current_page' => $data['current-page'],
                'total_pages' => $data['total-pages'],
            ];
        }

        return view('home', compact('items', 'pagination'));
    }
}
