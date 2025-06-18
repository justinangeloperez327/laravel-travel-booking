<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Currency extends Model
{
    use HasFactory;

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
