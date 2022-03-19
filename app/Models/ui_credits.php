<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ui_credits extends Model
{
    use HasFactory;
    protected $table = "ui_credits";
    protected $primaryKey = "id";

    protected $casts = [
        'col_Sand_id'=>'boolean',
        'col_Sand_date'=>'boolean',
        'col_Sand_money'=>'boolean',
        'col_Sand_moneyin'=>'boolean',
        'col_Sand_notes'=>'boolean',
        'col_sand_user'=>'boolean',
        'col_sand_desc'=>'boolean',
        'col_Sand_operation'=>'boolean',
        'col_cost_price'=>'boolean',
        'col_gain'=>'boolean',
        'col_currency'=>'boolean',
        'col_userAflet'=>'boolean',
        'col_brig_name'=>'boolean',
        'col_tree_name'=>'boolean'
    ];
}
