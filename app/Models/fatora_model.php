<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fatora_model extends Model
{
    use HasFactory;
    
    protected $table = "fatora";

    protected $primaryKey = "fatora_id";

    protected $casts = [
        'fatora_id'=>'integer',
        'fatora_number'=>'integer',
        'fatora_numberItems'=>'integer',
        'fatora_total_my'=>'float',
        'fatora_wasel_him'=>'float',
        'fatora_type'=>'integer',
        'fatora_cosfk'=>'integer',
    ];

    protected $fillable = ['fatora_id','fatora_number','fatora_date','fatora_numberItems','fatora_total_my','fatora_wasel_him','fatora_type','fatora_cosfk','fatora_user','fatora_type','fatora_notes','fatora_SaveDate'];
}
