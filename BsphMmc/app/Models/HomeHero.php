<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class HomeHero extends Model
{
    use HasFactory;

    protected $table = 'home_hero_sections';

    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'image',
        'button_text',
        'button_link',
        'display_order',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute(): ?string
    {
        if (! $this->image) {
            return null;
        }

        if (str_starts_with($this->image, 'http')) {
            return $this->image;
        }

        $publicPath = public_path($this->image);
        if (file_exists($publicPath)) {
            return asset($this->image);
        }

        if (Storage::disk('public')->exists($this->image)) {
            return Storage::disk('public')->url($this->image);
        }

        return asset('storage/' . $this->image);
    }

    /**
     * Scope to get active slides ordered by display_order
     */
    public function scopeActive($query)
    {
        return $query->where('status', true)->orderBy('display_order', 'asc');
    }

    /**
     * Scope to get all slides ordered by display_order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order', 'asc');
    }
}
