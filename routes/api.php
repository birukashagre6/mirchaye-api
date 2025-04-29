<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Auth\NEBEAuthController;
use App\Http\Controllers\PartyApprovalController;
use App\Http\Controllers\PoliticalPartyAuthController;
use App\Http\Controllers\PartyPostController;
use App\Http\Controllers\NEBEPostController;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/nebe/posts', [NEBEPostController::class, 'store']);
});


Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/party/posts', [PartyPostController::class, 'store']);
});



Route::prefix('nebe')->group(function () {
    // NEBE Admin Login
    Route::post('/login', [NEBEAuthController::class, 'login']);
    Route::middleware('auth:sanctum')->group(function () {
        // NEBE Admin Logout
        Route::get('/approval-requests', [PartyApprovalController::class, 'listPending']);
        Route::post('/approve/{id}', [PartyApprovalController::class, 'approve']);
        Route::post('/reject/{id}', [PartyApprovalController::class, 'reject']);
    });
});
Route::post('/party/register', [PartyApprovalController::class, 'registerRequest']);
Route::post('/party/login', [PoliticalPartyAuthController::class, 'login']);

