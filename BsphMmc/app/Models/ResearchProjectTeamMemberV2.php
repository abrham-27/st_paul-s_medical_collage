<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchProjectTeamMemberV2 extends Model
{
    use HasFactory;

    protected $table = 'research_project_team_members_v2';

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
        return $query->orderBy('order_index', 'asc');
    }

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