<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    protected $table = 'images';
    protected $primaryKey = 'id';
    
    protected $fillable = ['path'];
    public function setFilenamesAttribute($value)
    {
        $this->attributes['path'] = json_encode($value);
    }
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

}
