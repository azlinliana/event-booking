<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    protected $fillable = [
        'name', 
        'date',
        'venue', 
        'total_ticket_available'
    ];

    /**
     * Get the tickets for the event.
     */
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
}
