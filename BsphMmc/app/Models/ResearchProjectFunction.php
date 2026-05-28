<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchProjectFunction extends Model
{
    use HasFactory;

    protected $fillable = [
        'research_project_id',
        'title',
        'description',
        'icon',
        'features',
        'order_index',
        'status'
    ];

    protected $casts = [
        'features' => 'array',
        'order_index' => 'integer'
    ];

    /**
     * Get the research project that owns the function
     */
    public function researchProject()
    {
        return $this->belongsTo(ResearchProject::class);
    }

    /**
     * Scope to get only active functions
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
}