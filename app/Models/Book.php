<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'event_id',
        'number_ticket',
        'total_price'
    ];
}
