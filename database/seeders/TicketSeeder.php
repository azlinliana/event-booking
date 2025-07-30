<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ticket;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Case 1: Normal ticket
        Ticket::create([
            'event_id' => 1,
            'is_vip' => false,
            'ticket_price' => 100.00
        ]);

        // Case 2: VIP ticket
        Ticket::create([
            'event_id' => 2,
            'is_vip' => true,
            'ticket_price' => 300.00
        ]);

        Ticket::create([
            'event_id' => 3,
            'is_vip' => false,
            'ticket_price' => 200.00
        ]);

        // Case 3: Past date
        Ticket::create([
            'event_id' => 4,
            'is_vip' => false,
            'ticket_price' => 80.00
        ]);
    }
}
