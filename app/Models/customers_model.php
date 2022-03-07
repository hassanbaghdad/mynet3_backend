<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customers_model extends Model
{
    use HasFactory;
    protected $table = "costumer";
    protected $primaryKey = "cost_id";
}
