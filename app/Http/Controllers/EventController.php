<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use App\Models\Ticket;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * 1. Display a list of the event.
     * 2. For the VIP ticket, only VIP customer can see 24 hours earlier
     * 3. After 24 hours VIP customer and normal customer can view all
     */
    public function index($userId)
    {
        // Get user
        $user = User::find($userId);

        if ($user->is_vip == 1) {
            $getTicketsVIP = Ticket::with('event')
                ->get();

            return response()->json($getTicketsVIP, 200);
        }

        $getTickets = Ticket::with('event')
            ->where(function ($query) {
                $query->where('is_vip', 0)
                ->orWhere('is_vip', 1)
                ->where('created_at', '<=', Carbon::now()->subHours(24));
            })
            ->get();

        return response()->json($getTickets, 200);
    }

    /**
     * Store a newly created event and ticket.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'venue' => ['required', 'string', 'max:255'],
            'total_ticket_available' => ['required', 'integer'],
            'is_vip' => ['required', 'boolean'],
            'ticket_price' => ['required', 'numeric'],
        ]);

        // Create event
        $event = Event::create([
            'name' => $request->name,
            'date'=> $request->date,
            'venue'=> $request->venue,
            'total_ticket_available'=> $request->total_ticket_available,
        ]);

        // Create ticket related to event
        $ticket = Ticket::create([
            'event_id' => $event->id,
            'is_vip'=> $request->is_vip,
            'ticket_price' => $request->ticket_price,
        ]);

        return response()->json([
            'dataEvent' => $event,
            'dataTicket' => $ticket,
            'message' => 'Event created!'
        ], 200);
    }
}
