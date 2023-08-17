<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{

    protected $table = 'rooms';
    protected $primaryKey = 'id';
    
    protected $fillable = ['address', 'capacity', 'is_available', 'room_number', 'description', 'price_per_night'];

    public function places() {
        return $this->belongsTo(Places::class);
    }

    public function roomtypes(){
        return $this->belongsTo(RoomTypes::class);
    }

    public function bookings(){
        return $this->belongsTo(Bookings::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
