<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ui_towers extends Model
{
    use HasFactory;
    protected $table = "ui_towers";
    protected $primaryKey = "id";

    protected $casts = [
        'col_brig_main'=>'boolean',
        'col_brig_name'=>'boolean',
        'col_brig_type'=>'boolean',
        'col_count_customers'=>'boolean'
    ];
}
