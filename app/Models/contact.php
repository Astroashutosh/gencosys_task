<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class contact extends Model
{
    protected $fillable = [
        'name',
        'fname',
        'dob',
        'mobile',
        'email',
        'address',
        'image',
        'roll_no'
    ];
}
