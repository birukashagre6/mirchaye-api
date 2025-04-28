<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\PoliticalPartyAuthController;

Route::prefix('party')->group(function () {
    Route::post('/register', [PoliticalPartyAuthController::class, 'register']);
    Route::post('/login', [PoliticalPartyAuthController::class, 'login']);
    
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [PoliticalPartyAuthController::class, 'logout']);
        Route::get('/me', [PoliticalPartyAuthController::class, 'me']);
    });
});