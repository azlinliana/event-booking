<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Event;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'event_id' => ['required'],
            'number_ticket' => ['required', 'integer'],
        ]);

        $getEvent = Event::find($request->event_id);

        dd($getEvent);
        // Calculate total price based on the number of ticket
        $total_price = * ($request->number_ticket);

        // $book = Book::create([
        //     'event_id' => $request->event_id,
        //     'number_ticket' => $request->number_ticket,
        //     'total_price' =>
        // ]);

        // return response()->json([
        //     'data' => $book,
        //     'message' => 'Booking created!'
        // ], 200);
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
