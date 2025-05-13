<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'mobile',
        'course', // this is the course ID (foreign key by logic)
    ];

    // Define the relationship manually using 'course' as the foreign key
    public function courses()
    {
        return $this->belongsTo(course::class, 'course', 'id');
    }
}
