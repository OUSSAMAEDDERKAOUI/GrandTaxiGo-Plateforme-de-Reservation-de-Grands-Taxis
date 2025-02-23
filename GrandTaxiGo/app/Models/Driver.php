<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Driver extends Model
{
    use HasFactory, HasRoles;


    public function announcements(){
        return $this->hasMany(Announcement::class);
    }
    public function reservations(){
        return $this->hasMany(Reservation::class);
    }















}
