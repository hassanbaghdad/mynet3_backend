<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class items_model extends Model
{
    use HasFactory;

    protected $table = "items";

    protected $primaryKey = "item_id";

    protected $fillable = [
        'item_isdel'
    ];
    protected $casts =[
        'item_priceDinar'=>'float',
        'item_priceDolar'=>'float',
        'item_priceSale'=>'float',
        'item_count'=>'integer',
        'item_type'=>'integer',
        'item_store'=>'integer'
    ];
}
