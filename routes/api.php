<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\NewsController;
use App\Http\Controllers\api\ParaphaseController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// All News
Route::get('/news' , [NewsController::class, 'index']);
// Create News
Route::post('/news' , [NewsController::class,'store']);
// Create News More than one
Route::post('/news/more' , [NewsController::class,'storeMore']);
// Update News Status
Route::put('/news/status' , [NewsController::class,'updateStatus']);
// Delete News
Route::delete('/news' , [NewsController::class,'destroy']);

// -------- Paraphrase News

// All Paraphrase News
Route::get('/paraphrase-news' , [ParaphaseController::class, 'index']);
// Create Paraphrase News
Route::post('/paraphrase-news' , [ParaphaseController::class,'store']);
// Update Paraphrase News
Route::put('/paraphrase-news/status' , [ParaphaseController::class,'updateStatus']);
// Delete Paraphrase News
Route::delete('/paraphrase-news' , [ParaphaseController::class,'destroy']);
