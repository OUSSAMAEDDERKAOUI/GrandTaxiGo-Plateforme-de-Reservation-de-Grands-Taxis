<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'pickup_location',
        'destination',
        'departure_time',
        'status',
        'passengers_nbr',
        'passenger_id',
        'driver_id',
        'announcement_id',
        
    ];

    public function passenger()
    {
        return $this->belongsTo(User::class, 'passenger_id');
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function announcement()
    {
        return $this->belongsTo(Announcement::class, 'announcement_id');
    }


    public function isPassenger()
    {
        return $this->passenger()->exists();
    }

    public function isDriver()
    {
        return $this->driver()->exists();
    }
}
