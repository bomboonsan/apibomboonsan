<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ParaphraseNews;


class ParaphaseController extends Controller
{
    public function index(Request $request)
    {
        $paharase_news = ParaphraseNews::all();
        return response()->json($paharase_news, 200);
    }

    public function store(Request $request)
    {
        $payload = $request->json()->all();
        $url = $payload['url'];
        $title = $payload['title'];
        $image = $payload['image'];
        $category = $payload['category'];
        $content = $payload['content'];
        $status = $payload['status'];
        $reference = $payload['reference'];

        // check url is unique
        $checkUrl = ParaphraseNews::where('url', $url)->first();
        if ($checkUrl) {
            return response()->json(['message' => 'Paraphrase News already exists'], 400);
        }

        $paraphrase_news = ParaphraseNews::create([
            'url' => $url,
            'title' => $title,
            'image' => $image,
            'category' => $category,
            'content' => $content,
            'status' => $status,
            'reference' => $reference,
        ]);


        return response()->json(['message' => 'Paraphrase News added successfully'], 200);
    }

    public function updateStatus(Request $request)
    {
        $payload = $request->json()->all();
        $url = $payload['url'];
        $status = $payload['status'];

        $paraphrase_news = ParaphraseNews::where('url', $url)->first();
        $paraphrase_news->status = $status;
        $paraphrase_news->save();

        return response()->json(['message' => 'Paraphrase News status updated successfully'], 200);
    }

    public function destroy(Request $request)
    {
        $payload = $request->json()->all();
        $url = $payload['url'];

        $paraphrase_news = ParaphraseNews::where('url', $url)->first();
        $paraphrase_news->delete();

        return response()->json(['message' => 'Paraphrase News deleted successfully'], 200);
    }
}
