<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomTypes extends Model
{
    protected $table = 'room_types';
    protected $primaryKey = 'id';
    
    protected $fillable = ['name'];

    public function rooms()
    {
        return $this->hasMany(Rooms::class);
    }
}
