<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicProject extends Model
{
    protected $table = 'academic_projects';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'featured_image',
        'status',
        'display_order',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public static function generateSlug(string $title): string
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
        $originalSlug = $slug;
        $counter = 1;

        while (self::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        return $slug;
    }
}
