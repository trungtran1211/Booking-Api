<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Places extends Model
{
    protected $table = 'places';
    protected $primaryKey = 'id';
    
    protected $fillable = ['name', 'description', 'map'];

    public function rooms()
    {
        return $this->hasMany(Rooms::class);
    }
}
