<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ui_customers extends Model
{
    use HasFactory;
    protected $table = "ui_customers";
    protected $primaryKey = "id";

    protected $casts = [
        'col_cost_address'=>'boolean',
        'col_cost_admin'=>'boolean',
        'col_cost_brig'=>'boolean',
        'col_cost_id' =>'boolean',
        'col_cost_ipNano'=>'boolean',
        'col_cost_name'=>'boolean',
        'col_cost_pass'=>'boolean',
        'col_cost_passNano'=>'boolean',
        'col_cost_phone'=>'boolean',
        'col_cost_user'=>'boolean',
        'col_cost_userNano'=>'boolean',
        'col_remaining_days'=>'boolean',
        'col_remaining_days2'=>'boolean',
        'col_cost_secter'=>'boolean'
    ];
}
