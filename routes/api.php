<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\BookController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Route::prefix('auth')->group(function() {
//     Route::get('/user', [UserController::class, 'index']);

//     Route::post('/user/register', [UserController::class, 'register']);

//     Route::post('/user/login', [UserController::class, 'login']);

//     Route::put('/user/{userId}', [UserController::class, 'update']);

//     Route::delete('/user/{userId}', [UserController::class, 'detroy']);
// });

// Route::prefix('event')->group(function() {
    Route::get('/event', [EventController::class, 'index']);

    Route::post('/event', [EventController::class, 'store']);
// });

    Route::post('/book', [BookController::class, 'store']);



