<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\UnansweredQuestionsController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AdminController;

Route::get('/users', [AuthenticationController::class, 'index']);
Route::get('/user/{id}', [AuthenticationController::class, 'show']);

Route::post('/login', [AuthenticationController::class, 'login']);
Route::post('/signup', [AuthenticationController::class, 'signup']);
Route::post('/logout', [AuthenticationController::class, 'logout'])->middleware('auth:sanctum');

Route::get('/unanswered-questions', [UnansweredQuestionsController::class, 'index']);
Route::post('/unanswered-questions', [UnansweredQuestionsController::class, 'store']);
Route::get('/unanswered-questions/{id}', [UnansweredQuestionsController::class, 'show']);
Route::put('/unanswered-questions/{id}', [UnansweredQuestionsController::class, 'update']);
Route::delete('/unanswered-questions/{id}', [UnansweredQuestionsController::class, 'destroy']);

// Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/list', [AdminController::class, 'listAdmins']);
    Route::post('/admin/create', [AdminController::class, 'addAdmin']);
    Route::put('/admin/update/{id}', [AdminController::class, 'editAdmin']);
    Route::delete('/admin/delete/{id}', [AdminController::class, 'deleteAdmin']);
// });
