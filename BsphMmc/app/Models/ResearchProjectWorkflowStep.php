<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchProjectWorkflowStep extends Model
{
    use HasFactory;

    protected $fillable = [
        'research_project_id',
        'title',
        'description',
        'step_number',
        'icon',
        'estimated_time',
        'requirements',
        'status'
    ];

    protected $casts = [
        'step_number' => 'integer',
        'requirements' => 'array'
    ];

    /**
     * Get the research project that owns the workflow step
     */
    public function researchProject()
    {
        return $this->belongsTo(ResearchProject::class);
    }

    /**
     * Scope to get only active workflow steps
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope to order by step number
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('step_number', 'asc');
    }
}