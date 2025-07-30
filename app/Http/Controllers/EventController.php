<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();

        return response()->json($events, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'date' => ['required'],
            // 'venue' => ['required', 'string', 'max:255'],
            'total_ticket_available' => ['required', 'integer'],
            'ticket_price' => ['required'],
        ]);

        $event = Event::create([
            'name' => $request->name,
            'date'=> $request->date,
            // 'venue'=> $request->venue,
            'total_ticket_available'=> $request->total_ticket_available,
            'ticket_price' => $request->ticket_price,
        ]);

        return response()->json([
            'data' => $event,
            'message' => 'Event created!'
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
