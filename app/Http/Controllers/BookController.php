<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => ['required'],
            'ticket_id' => ['required'],
            'no_purchased_ticket' => ['required', 'integer'],
        ]);

        // Get user info
        $getUser = User::where('id', $request->user_id)
            ->first();

        // Get ticket info
        $getTicket = Ticket::where('id', $request->ticket_id)
            ->first();

        // Calculate total price of ticket based on the number purchased ticket
        // ticket_price * no_purchased_ticket
        $total_price_ticket = round(($getTicket->ticket_price) * ($request->no_purchased_ticket), 2);

        // Create booking
        $book = Book::create([
            'user_id' => $getUser->id,
            'ticket_id' => $getTicket->id,
            'no_purchased_ticket' => $request->no_purchased_ticket,
            'total_price_ticket' => $total_price_ticket
        ]);

        return response()->json([
            'dataUser' => $getUser,
            'dataTicket' => $getTicket,
            'dataBooking' => $book,
            'message' => 'Booking created!'
        ], 200);
    }
}
