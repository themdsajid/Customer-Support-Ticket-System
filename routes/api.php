<?php

use App\Http\Controllers\API\TicketController as ApiTicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return response()->json(['message' => 'API working!!!']);
});

Route::post('/login', [ApiTicketController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/tickets', [ApiTicketController::class, 'store']);
    Route::get('/tickets', [ApiTicketController::class, 'index']);
});
