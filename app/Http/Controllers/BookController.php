<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * 1. Check no_purchased_ticket > total_ticket_available
     * 2. Store a newly booked ticket.
     * 3. Update total_ticket_available from the event list
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => ['required'],
            'ticket_id' => ['required'],
            'no_purchased_ticket' => ['required', 'integer'],
        ]);

        // Get ticket
        $getTicket = Ticket::find($request->ticket_id);

        // Get current total_ticket_available from events
        $getTotalTicketAvailable = $getTicket
            ->event
            ->total_ticket_available;

        // 1
        if ($request->no_purchased_ticket > $getTotalTicketAvailable) {
            return response()->json([
                'message' => 'No. of purchased ticket is more than number of total available ticket.'
            ], 500);
        }
        else {
            // Get user info
            $getUser = User::where('id', $request->user_id)
                ->first();

            // Get ticket info
            $getTicket = Ticket::where('id', $request->ticket_id)
                ->first();

            // Calculate total price of ticket based on the number purchased ticket
            // ticket_price * no_purchased_ticket
            $total_price_ticket = round(($getTicket->ticket_price) * ($request->no_purchased_ticket), 2);

            // 2. 
            // Create booking
            $book = Book::create([
                'user_id' => $getUser->id,
                'ticket_id' => $getTicket->id,
                'no_purchased_ticket' => $request->no_purchased_ticket,
                'total_price_ticket' => $total_price_ticket
            ]);

            // 3
            // Update total_ticket_available in the event list
            $updateTotalTicketAvailable = $getTotalTicketAvailable - ($request->no_purchased_ticket);

            // Get event info
            $getEventInfo = $getTicket->event;

            $getEventInfo->total_ticket_available = $updateTotalTicketAvailable;
            $getEventInfo->save();

            return response()->json([
                'dataUser' => $getUser,
                'dataTicket' => $getTicket,
                'dataBooking' => $book,
                'message' => 'Booking created!'
            ], 200);
        }
    }
}
