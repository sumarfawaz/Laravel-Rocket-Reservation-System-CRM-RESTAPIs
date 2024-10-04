<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerLogin extends Model
{
    use HasFactory;

    protected $fillable = ['epassportid', 'password'];

    // If passwords will be hashed, you can add this mutator
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
}
