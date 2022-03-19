<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ui_users extends Model
{
    use HasFactory;
    protected $table = "ui_users";
    protected $primaryKey = "id";

    protected $casts = [
        'col_Fullname'=>'boolean',
        'col_username'=>'boolean',
        'col_user_level'=>'boolean'
    ];
}
