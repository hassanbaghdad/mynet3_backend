<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ui_customers extends Model
{
    use HasFactory;
    protected $table = "ui_customers";
    protected $primaryKey = "id";
}
