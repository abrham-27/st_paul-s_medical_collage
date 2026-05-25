<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AcademicStaff extends Model
{
    protected $table = 'academic_staffs';

    protected $fillable = [
        'school_type', 'full_name', 'slug', 'position', 'department',
        'profile_image', 'biography', 'qualification',
        'email', 'phone', 'display_order', 'status',
    ];

    public static function generateSlug(string $name): string
    {
        $slug = Str::slug($name);
        $count = static::where('slug', 'like', $slug . '%')->count();
        return $count ? $slug . '-' . ($count + 1) : $slug;
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeBySchool($query, string $school)
    {
        return $query->where('school_type', $school);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order')->orderBy('full_name');
    }
}
