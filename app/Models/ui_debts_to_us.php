<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ui_debts_to_us extends Model
{
    use HasFactory;

    protected $table = "ui_debts_to_us";
    protected $primaryKey = "id";

    protected $casts = [
        'col_cost_name'=>'boolean',
        'col_cost_user'=>'boolean',
        'col_cost_phone'=>'boolean',
        'col_brig_name'=>'boolean',
        'col_Sand_dateto'=>'boolean',
        'col_Sand_nextdate'=>'boolean',
        'col_Sand_carry'=>'boolean'
    ];
}
