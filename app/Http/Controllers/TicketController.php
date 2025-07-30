<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Book;

class TicketController extends Controller
{
    /**
     * Display booking information.
     */
    public function show($bookId) {
        // Get event info based on bookId
        $getEventInfo = Book::find($bookId)->ticket->event;

        // Get ticket info based on bookId
        $getTicketInfo = Book::find($bookId)->ticket;

        // Get ticket info based on bookId
        $getBookingInfo = Book::find($bookId)->first();

        // Get user info based on bookId
        $getUserId = Book::find($bookId)->user_id;
        $getUserInfo = User::find($getUserId);

        return response()->json([
            'eventName' => $getEventInfo->name,
            'eventDate' => $getEventInfo->date,
            'eventVenue' => $getEventInfo->venue,
            'price' => "RM". $getTicketInfo->ticket_price,
            'noTicket' => $getBookingInfo->no_purchased_ticket,
            'totalPrice' => "RM". $getBookingInfo->total_price_ticket,
            'customerName' => $getUserInfo->name,
            'customerEmail' => $getUserInfo->email,
            'customerStatus' => $getUserInfo->is_vip ? 'VIP': 'Normal'
        ], 200);
    }
}
