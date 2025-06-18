<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'city',
        'country',
        'airport_code',
    ];

    public function originFlights()
    {
        return $this->hasMany(Flight::class, 'origin_id');
    }

    public function destinationFlights()
    {
        return $this->hasMany(Flight::class, 'destination_id');
    }

    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }
}
