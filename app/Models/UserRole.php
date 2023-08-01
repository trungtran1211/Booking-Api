<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'UserRoles';
    protected $primaryKey = 'user_role_id';
    
    protected $fillable = ['user_id', 'role_id'];
}
