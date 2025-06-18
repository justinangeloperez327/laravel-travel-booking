<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = [
        'code',
        'name',
        'exchange_rate'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
