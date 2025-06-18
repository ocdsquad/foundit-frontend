<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\ItemRequest;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Logic to display a list of items
    }

    public function showForm()
    {
        // dd(session('auth'));
        return view('form');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getDetailItem($id)
    {
        $token = session('auth.token');
        $response = Http::withToken($token)->get("http://localhost:8080/items/{$id}");
        // dd($response->json());
        
        if ($response->ok()) {
            return view('detail', ['item' => $response->json()['data']]);
        } else {
            return back()->with('flash', ['danger', 'Item not found']);
        }
    }


    public function create(ItemRequest $request)
    {
  
        dd($request->json());
        $request = $request->validated();
        $token = session('auth.token');
        $request['status'] = 'FRESH';

        $body = [
            'name' => $request['name'],
            'description' => $request['description'],
            'chronology' => $request['chronology'],
            'status' => $request['status'],
            'category_id' => $request['category_id'],
            'location' => $request['location'],
            'file' => null
        ];
        dd($body);
        $response = Http::withToken($token)->post('http://localhost:8080/items', $body);
        if ($response->created()) {
            return back()->with('flash', ['success', $response->json()['message']]);
        } else {
            return back()->with('flash', ['danger', $response->json()['message']]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Logic to store a new item
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Logic to display a specific item
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Logic to show the form for editing an item
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Logic to update an existing item
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Logic to delete an item
    }
}
