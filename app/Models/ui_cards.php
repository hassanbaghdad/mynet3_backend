<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ui_cards extends Model
{
    use HasFactory;
    protected $table = "ui_cards";
    protected $primaryKey = "id";

    protected $casts = [
        'col_card_name'=>'boolean',
        'col_card_priceDinar'=>'boolean',
        'col_card_priceDO'=>'boolean'
    ];
}
