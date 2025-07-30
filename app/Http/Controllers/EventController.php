<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Ticket;

class EventController extends Controller
{
    /**
     * Display a list of the event.
     */
    public function index()
    {
        $events = Event::all();

        return response()->json($events, 200);
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
