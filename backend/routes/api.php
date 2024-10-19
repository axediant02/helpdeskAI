<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthenticationController::class, 'login']);
Route::post('/signup', [AuthenticationController::class, 'signup']);
Route::post('/logout', [AuthenticationController::class, 'logout'])->middleware('auth:sanctum');
