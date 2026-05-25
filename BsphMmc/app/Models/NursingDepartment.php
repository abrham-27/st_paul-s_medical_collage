<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NursingDepartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'icon',
        'title',
        'subtitle',
        'description',
        'features',
        'detail',
        'display_order',
        'status',
    ];

    protected $casts = [
        'features' => 'array',
        'detail' => 'array',
        'status' => 'boolean',
    ];
}
