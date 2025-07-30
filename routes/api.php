<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\BookController;

// Event
Route::get('/event', [EventController::class, 'index']); //List event
Route::post('/event', [EventController::class, 'store']); // Event organizer create event

// Book
Route::post('/book', [BookController::class, 'store']); // Customer & VIP book ticket

// Ticket
Route::get('/ticket', [TicketController::class, 'show']); // Customer & VIP view ticket
