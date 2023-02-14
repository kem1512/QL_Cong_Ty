<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\equiment;

class Equiment_Type extends Model
{
    use HasFactory;

    protected $fillTable = ['name', 'status', 'created_at', 'updated_at'];
}
