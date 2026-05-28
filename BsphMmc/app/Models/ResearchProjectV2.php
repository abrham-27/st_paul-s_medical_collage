<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchProjectV2 extends Model
{
    use HasFactory;

    protected $table = 'research_projects_v2';

    protected $fillable = [
        'project_type',
        'title',
        'subtitle',
        'overview',
        'hero_image',
        'cta_buttons',
        'contact_email',
        'contact_phone',
        'contact_address',
        'office_hours',
        'status'
    ];

    protected $casts = [
        'cta_buttons' => 'array'
    ];

    // Relationships
    public function functions()
    {
        return $this->hasMany(ResearchProjectFunctionV2::class, 'research_project_id')->active()->ordered();
    }

    public function workflows()
    {
        return $this->hasMany(ResearchProjectWorkflowV2::class, 'research_project_id')->active()->ordered();
    }

    public function resources()
    {
        return $this->hasMany(ResearchProjectResourceV2::class, 'research_project_id')->active()->ordered();
    }

    public function statistics()
    {
        return $this->hasMany(ResearchProjectStatisticV2::class, 'research_project_id')->active()->ordered();
    }

    public function teamMembers()
    {
        return $this->hasMany(ResearchProjectTeamMemberV2::class, 'research_project_id')->active()->ordered();
    }

    public function faqs()
    {
        return $this->hasMany(ResearchProjectFaqV2::class, 'research_project_id')->active()->ordered();
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeByType($query, $type)
    {
        return $query->where('project_type', $type);
    }

    // Static methods
    public static function getByType($type)
    {
        return static::active()->byType($type)->first();
    }

    public static function getOrCreateByType($type)
    {
        $project = static::getByType($type);
        
        if (!$project) {
            $project = static::create([
                'project_type' => $type,
                'title' => ucfirst($type) . ' Project',
                'subtitle' => 'Professional research and development',
                'overview' => '<p>Welcome to our ' . ucfirst($type) . ' project.</p>',
                'status' => 'active'
            ]);
        }
        
        return $project;
    }

    // Helper methods
    public function getHeroImageUrlAttribute()
    {
        return $this->resolveImageUrl($this->hero_image);
    }

    private function resolveImageUrl($imagePath)
    {
        if (!$imagePath) {
            return null;
        }

        if (str_starts_with($imagePath, 'http')) {
            return $imagePath;
        }

        $apiUrl = config('app.url');
        $storageBase = rtrim($apiUrl, '/') . '/storage';
        $normalized = ltrim($imagePath, '/');
        $normalized = preg_replace('/^storage\//', '', $normalized);
        
        return $storageBase . '/' . $normalized;
    }

    public function loadCompleteData()
    {
        $this->load([
            'functions',
            'workflows',
            'resources',
            'statistics',
            'teamMembers',
            'faqs'
        ]);

        return $this;
    }
}