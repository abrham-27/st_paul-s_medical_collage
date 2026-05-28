<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchProjectWorkflowV2 extends Model
{
    use HasFactory;

    protected $table = 'research_project_workflows_v2';

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
        'requirements' => 'array'
    ];

    public function researchProject()
    {
        return $this->belongsTo(ResearchProjectV2::class, 'research_project_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('step_number', 'asc');
    }
}