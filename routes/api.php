<?php

use App\Http\Controllers\Api\EleveApiController;
use Illuminate\Support\Facades\Route;


Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});

Route::middleware('verify.api.token')->group(function () {
    Route::get('/eleves', [EleveApiController::class, 'index']);
    Route::get('/eleves/{id}/exportNotes', [EleveApiController::class, 'exportNotes']);
});
