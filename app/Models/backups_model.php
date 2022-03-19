<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class backups_model extends Model
{
    use HasFactory;
    protected $table = "backups";
    protected $primaryKey = "back_id";
}
