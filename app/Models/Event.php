<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name', 
        'date', 
        // 'venue', 
        'total_ticket_available',
        'ticket_price'
    ];
}
