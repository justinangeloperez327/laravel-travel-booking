<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id',
        'type',
        'capacity',
        'price_per_night',
        'quantity'
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
