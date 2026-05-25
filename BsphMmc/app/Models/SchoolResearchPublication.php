<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SchoolResearchPublication extends Model
{
    protected $fillable = [
        'school_type',
        'title',
        'subtitle',
        'abstract',
        'authors',
        'publication_type',
        'publication_date',
        'journal_name',
        'doi_link',
        'external_link',
        'cover_image',
        'pdf_file',
        'keywords',
        'status',
        'featured',
        'display_order',
        'slug',
    ];

    protected $casts = [
        'publication_date' => 'date',
        'featured' => 'boolean',
    ];

    public static function generateSlug(string $title): string
    {
        $slug = Str::slug($title);
        $count = static::where('slug', 'like', $slug . '%')->count();
        return $count ? $slug . '-' . ($count + 1) : $slug;
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeBySchool($query, string $school)
    {
        return $query->where('school_type', $school);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getCoverImageUrlAttribute(): ?string
    {
        if (! $this->cover_image) {
            return null;
        }

        return str_starts_with($this->cover_image, 'http')
            ? $this->cover_image
            : asset('storage/' . $this->cover_image);
    }

    public function getPdfFileUrlAttribute(): ?string
    {
        if (! $this->pdf_file) {
            return null;
        }

        return str_starts_with($this->pdf_file, 'http')
            ? $this->pdf_file
            : asset('storage/' . $this->pdf_file);
    }
}
