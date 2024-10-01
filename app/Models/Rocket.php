<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rocket extends Model
{
    use HasFactory;

    protected $fillable = [
        'rocketname',
        'height',
        'diameter',
        'mass',
        'payloadtoleo',
        'payloadtogto',
        'payloadtomars'
    ];
}
