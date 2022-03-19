<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class users_model extends Model
{
    use HasFactory;
    protected $table = "users";
    protected $primaryKey = "user_id";
    protected $hidden = ['password'];

    protected $casts =[
        'user_level'=>'integer',
        'user_type'=>'integer',
        'user_store'=>'integer'
    ];
}
