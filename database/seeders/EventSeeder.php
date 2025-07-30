<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        // Case 1: Normal ticket
        Event::create([
            'name' => 'Carnival of Research & Innovation',
            'date' => '2025/10/12',
            'venue' => "Putrajaya Convention Centre (PICC) - Hall 1",
            'total_ticket_available' => 100,
        ]);

        // Case 2: VIP ticket
        Event::create([
            'name' => 'Comic Fiesta VIP',
            'date' => '2025/12/12',
            'venue' => "KLCC Convention Centre",
            'total_ticket_available' => 1500,
        ]);

        Event::create([
            'name' => 'Comic Fiesta',
            'date' => '2025/12/12',
            'venue' => "KLCC Convention Centre",
            'total_ticket_available' => 1500,
        ]);

        // Case 3: Past date
        Event::create([
            'name' => 'Taekwondo ITF',
            'date' => '2024/12/12',
            'venue' => "Shah Alam Arena",
            'total_ticket_available' => 3,
        ]);
    }
}
