<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeFeatured extends Model
{
    use HasFactory;

    protected $table = 'home_featured_sections';

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
