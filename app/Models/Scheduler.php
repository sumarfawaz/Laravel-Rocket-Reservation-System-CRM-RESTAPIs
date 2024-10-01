<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scheduler extends Model
{
    use HasFactory;

    protected $fillable = [
        'scheduler_name',
        'rocketname',
        'spacestation_name',
        'launch_date_time',
        'price',
        'passengers',
    ];
}
