<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'user_id',
        'ticket_id',
        'no_purchased_ticket',
        'total_price_ticket'
    ];
}
