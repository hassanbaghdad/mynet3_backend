<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ui_bills extends Model
{
    use HasFactory;
    protected $table = "ui_bills";
    protected $primaryKey = "id";

    protected $casts = [
        'col_Sand_id'=>'boolean',
        'col_Sand_date'=>'boolean',
        'col_Sand_moneyType'=>'boolean',
        'col_Sand_money'=>'boolean',
        'col_Sand_moneyin'=>'boolean',
        'col_Sand_cardtype'=>'boolean',
        'col_cost_name'=>'boolean',
        'col_cost_user'=>'boolean',
        'col_sand_user'=>'boolean'
    ];
}
