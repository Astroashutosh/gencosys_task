<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'courseName',
        'thumbnail',
        'description',
        'fees', // Add the fees field to the fillable array
    ];
}
