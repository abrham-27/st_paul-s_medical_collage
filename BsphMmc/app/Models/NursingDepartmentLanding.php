<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NursingDepartmentLanding extends Model
{
    use HasFactory;

    protected $fillable = [
        'hero_title',
        'hero_subtitle',
        'excellence',
        'stats',
        'programs',
    ];

    protected $casts = [
        'excellence' => 'array',
        'stats' => 'array',
        'programs' => 'array',
    ];

    public static function getSettings(): self
    {
        return static::firstOrCreate([], [
            'hero_title' => 'Our Departments',
            'hero_subtitle' => 'Excellence in Specialized Nursing Education',
        ]);
    }
}
