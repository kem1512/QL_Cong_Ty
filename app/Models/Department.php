<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Department extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'id_department_parent',
        'status',
    ];
    public static function getDepartments()
    {
        $departments = DB::table('departments');
        return $departments->paginate(88);
    }
}
