<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpaceStation extends Model
{
    use HasFactory;

    protected $fillable = [
        'spacestation_name',
        'spacestation_location',
        'distance_from_earth',
        'time_at_space_station',
    ];
}
