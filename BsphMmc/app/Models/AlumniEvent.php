<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlumniEvent extends Model
{
    protected $table = 'alumni_events';

    protected $fillable = [
        'title',
        'date',
        'location',
        'type',
        'description',
        'attendees',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
