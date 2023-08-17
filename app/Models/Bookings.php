<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    public function rooms()
    {
        return $this->hasMany(Rooms::class);
    }

    public function users()
    {
        return $this->belongsTo(Uses::class);
    }
}
