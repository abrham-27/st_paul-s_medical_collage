<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchProjectTeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'research_project_id',
        'name',
        'role',
        'bio',
        'image',
        'email',
        'phone',
        'order_index',
        'status'
    ];

    /**
     * Get the research project that owns the team member
     */
    public function researchProject()
    {
        return $this->belongsTo(ResearchProject::class);
    }

    /**
     * Scope to get only active team members
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope to order by index
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order_index', 'asc');
    }

    /**
     * Get the full image URL
     */
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return null;
        }

        if (str_starts_with($this->image, 'http')) {
            return $this->image;
        }

        $apiUrl = config('app.url');
        $storageBase = rtrim($apiUrl, '/') . '/storage';
        $normalized = ltrim($this->image, '/');
        $normalized = preg_replace('/^storage\//', '', $normalized);
        
        return $storageBase . '/' . $normalized;
    }
}