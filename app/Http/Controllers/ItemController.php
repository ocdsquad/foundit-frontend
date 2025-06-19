<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\ItemRequest;
use Illuminate\Http\Client\RequestException;
use GuzzleHttp\Client;
use Illuminate\Support\Str;


class ItemController extends Controller
{
    public function index()
    {
        // Logic to display a list of items
    }

    public function showForm()
    {
        return view('form');
    }

    public function getDetailItem($id)
    {
        $token = session('auth.token');
        $response = Http::withToken($token)->get("http://localhost:8080/items/{$id}");

        if ($response->ok()) {
            return view('detail', ['item' => $response->json()['data']]);
        } else {
            return back()->with('flash', ['danger', 'Item not found']);
        }
    }
    
    public function create(ItemRequest $request)
    {
        $token = session('auth.token');
        $validated = $request->validated();

        $itemPayload = [
            'name' => $validated['name'],
            'description' => $validated['description'],
            'chronology' => $validated['chronology'],
            'location' => $validated['location'],
            'status' => 'FRESH',
            'category-id' => (int) $validated['category_id']
        ];

        $multipart = [
            [
                'name' => 'item',
                'contents' => json_encode($itemPayload),
                'headers' => ['Content-Type' => 'application/json']
            ]
        ];

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $multipart[] = [
                'name' => 'image-url',
                'contents' => fopen($request->file('image')->getPathname(), 'r'),
                'filename' => $request->file('image')->getClientOriginalName(),
            ];
        }

        try {
            $response = Http::withToken($token)
                ->asMultipart()
                ->post('http://localhost:8080/items', $multipart);

            if ($response->successful()) {
                return redirect('/') // Kembali ke halaman utama
                    ->with('flash', ['success', $response['message'] ?? 'Item successfully reported.']);
            } else {
                return back()
                    ->withInput()
                    ->with('flash', ['danger', $response['message'] ?? 'Failed to create item.']);
            }
        } catch (RequestException $e) {
            return back()
                ->withInput()
                ->with('flash', ['danger', 'Request failed: ' . $e->getMessage()]);
        }
    }


    public function edit($id)
    {
        $token = session('auth.token');
        $response = Http::withToken($token)->get("http://localhost:8080/items/{$id}");

        if ($response->successful()) {
            return view('dashboard.edit', ['item' => $response['data']]);
        } else {
            return redirect()->route('items.index')->with('flash', ['danger', 'Gagal mengambil data item']);
        }
    }

        public function update(Request $request, $id)
        {
            $token = session('auth.token');

            $itemPayload = [
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'chronology' => $request->input('chronology'),
                'location' => $request->input('location'),
                'status' => $request->input('status') ?? 'FRESH',
                'categoryId' => (int) $request->input('category_id'),
            ];



            $multipart = [
                [
                    'name' => 'item',
                    'contents' => json_encode($itemPayload),
                    'headers' => ['Content-Type' => 'application/json'],
                ]
            ];

            // dd($multipart);

            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $multipart[] = [
                    'name' => 'image-url', // nama HARUS SAMA dengan @RequestPart("image-url")
                    'contents' => fopen($request->file('image')->getPathname(), 'r'),
                    'filename' => $request->file('image')->getClientOriginalName(),
                ];
            }

            try {
                $client = new \GuzzleHttp\Client();
                $response = $client->request('PUT', "http://localhost:8080/items/{$id}", [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                    'multipart' => $multipart,
                ]);

                $responseBody = json_decode($response->getBody(), true);

                return redirect()
                    ->route('item.show', $id)
                    ->with('flash', ['success', $responseBody['message'] ?? 'ITEM UPDATE SUCCESS']);
            } catch (\GuzzleHttp\Exception\RequestException $e) {
                $message = 'ITEM UPDATE FAILED';

                if ($e->hasResponse()) {
                    $responseBody = json_decode($e->getResponse()->getBody()->getContents(), true);
                    $message = $responseBody['message'] ?? $message;
                }

                return redirect()
                    ->route('item.edit', $id)
                    ->with('flash', ['danger', $message]);
            }
        }

    public function show($id)
    {
        $token = session('auth.token');

        try {
            $response = Http::withToken($token)->get("http://localhost:8080/items/{$id}");

            if ($response->successful()) {
                return view('dashboard.detail', ['item' => $response['data']]);
            } else {
                return redirect()->route('items.index')
                    ->with('flash', ['danger', 'Gagal mengambil detail item.']);
            }
        } catch (\Exception $e) {
            return redirect()->route('items.index')
                ->with('flash', ['danger', 'Terjadi kesalahan saat mengambil data.']);
        }
    }

    public function destroy($id)
    {
        $token = session('auth.token');

        try {
            $response = Http::withToken($token)
                ->delete("http://localhost:8080/items/{$id}");

            if ($response->successful()) {
                return redirect()->route('items.index')->with('flash', ['success', $response['message'] ?? 'Item deleted successfully']);
            } else {
                return redirect()->back()->with('flash', ['danger', $response['message'] ?? 'Failed to delete item']);
            }
        } catch (RequestException $e) {
            return redirect()->back()->with('flash', ['danger', 'Request failed: ' . $e->getMessage()]);
        }
    }
}
