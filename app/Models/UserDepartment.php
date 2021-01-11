<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDepartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'department_id',
    ];

    protected $hidden = [
        'user_id',
        'department_id',
    ];
}
