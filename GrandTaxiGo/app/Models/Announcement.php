<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Announcement extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'centent',
        'image',
        'trip_start',
        'trip_end',
        'driver_id',
        'max_passengers',
        'status',
        'expires_at',
        'departure_date',
    ];

    public function driver(){

        return $this->belongsTo(User::class,'driver_id');
    }
    
    public function reservations(){
        return $this->hasMany(Reservation::class);
    }
}
