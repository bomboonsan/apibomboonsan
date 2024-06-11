<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AllNews;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $allNews = AllNews::all();
        return response()->json($allNews, 200);
    }

    public function store(Request $request)
    {

        $request->validate([
            'url' =>'required',
            'title' =>'required',
        ]);
        $payload = $request->json()->all();
        $url = $payload['url'];
        $title = $payload['title'];

        $checkUrl = AllNews::where('url', $url)->first();
        if ($checkUrl) {
            return response()->json(['message' => 'News Already Exists'], 400);
        }

        $allNews = AllNews::create([
            'url' => $url,
            'title' => $title,
        ]);
        if ($allNews) {
            return response()->json(['message' => 'News Created'], 200);
        } else {
            return response()->json(['message' => 'Created fail'], 400);
        }

    }

    public function storeMore (Request $request)
    {
        $payload = $request->json()->all();
        $urls = $payload['urls'];

        foreach ($urls as $url) {
            $statusPayload = 'pending';
            $categoryPayload = 'general';

            // check url is unique
            $checkUrl = AllNews::where('url', $url)->first();
            if ($checkUrl) {
                // continue
                continue;
            }

            AllNews::create([
                'url' => $url,
                'status' => $statusPayload,
                'category' => $categoryPayload,
            ]);
        }

        return response()->json(['message' => 'News Created'], 200);


    }

    public function updateStatus (Request $request)
    {
        $payload = $request->json()->all();
        $url = $payload['url'];
        $status = $payload['status'];

        $checkUrl = AllNews::where('url', $url)->first();
        if ($checkUrl) {
            $checkUrl->status = $status;
            $checkUrl->save();
            return response()->json(['message' => 'Status Updated'], 200);
        } else {
            return response()->json(['message' => 'Status Updated fail'], 400);
        }
    }

    public function destroy(Request $request)
    {
        $payload = $request->json()->all();
        $url = $payload['url'];

        $checkUrl = AllNews::where('url', $url)->first();
        if ($checkUrl) {
            $checkUrl->delete();
            return response()->json(['message' => 'News Deleted'], 200);
        } else {
            return response()->json(['message' => 'News Deleted fail'], 400);
        }
    }
}
