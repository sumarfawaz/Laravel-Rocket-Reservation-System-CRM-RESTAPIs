<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'epassportid',
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'age',
        'occcupation',
        'nationality'
    ];
}
