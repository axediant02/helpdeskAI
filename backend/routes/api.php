<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route to show the registration form
Route::get('/admin/register', [AdminController::class, 'create'])->name('admin.register');

// Route to handle the registration form submission
Route::post('/admin/register', [AdminController::class, 'store']);
