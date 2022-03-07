<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ui_bills extends Model
{
    use HasFactory;
    protected $table = "ui_bills";
    protected $primaryKey = "id";
}
