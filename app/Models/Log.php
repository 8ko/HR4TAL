<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'employee_id',
        'log_type',
        'quota_hours',
        'time_in',
        'time_out',
    ];

}
