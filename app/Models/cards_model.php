<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cards_model extends Model
{
    use HasFactory;
    protected $table = "card";
    protected $praimaryKey ="card_id";
}
