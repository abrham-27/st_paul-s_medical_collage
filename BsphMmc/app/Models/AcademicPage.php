<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicPage extends Model
{
    protected $table = 'academic_pages';

    protected $fillable = [
        'school_type', 'page_type',
        'title', 'content',
        'secondary_title', 'secondary_content',
        'tertiary_title', 'tertiary_content',
        'featured_image',
    ];

    public static function getOrCreate(string $school, string $page): self
    {
        return static::firstOrCreate(
            ['school_type' => $school, 'page_type' => $page],
            ['title' => '', 'content' => '']
        );
    }
}
