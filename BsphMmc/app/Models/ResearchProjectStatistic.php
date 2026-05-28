<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchProjectStatistic extends Model
{
    use HasFactory;

    protected $fillable = [
        'research_project_id',
        'label',
        'value',
        'description',
        'icon',
        'color',
        'order_index',
        'status'
    ];

    protected $casts = [
        'order_index' => 'integer'
    ];

    /**
     * Get the research project that owns the statistic
     */
    public function researchProject()
    {
        return $this->belongsTo(ResearchProject::class);
    }

    /**
     * Scope to get only active statistics
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
     * Get numeric value for animation
     */
    public function getNumericValueAttribute()
    {
        // Extract numeric value from string like "150+", "2.5K", etc.
        $value = $this->value;
        
        // Remove common suffixes and symbols
        $cleaned = preg_replace('/[^\d.]/', '', $value);
        
        // Handle K, M suffixes
        if (str_contains(strtoupper($value), 'K')) {
            return floatval($cleaned) * 1000;
        }
        
        if (str_contains(strtoupper($value), 'M')) {
            return floatval($cleaned) * 1000000;
        }
        
        return floatval($cleaned);
    }
}