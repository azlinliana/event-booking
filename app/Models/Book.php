<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    protected $fillable = [
        'user_id',
        'ticket_id',
        'no_purchased_ticket',
        'total_price_ticket'
    ];

    /**
     * Get the ticket that owns the book.
     */
    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }
}
