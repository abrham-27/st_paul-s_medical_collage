<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchProjectResourceV2 extends Model
{
    use HasFactory;

    protected $table = 'research_project_resources_v2';

    protected $fillable = [
        'research_project_id',
        'title',
        'description',
        'file_path',
        'file_type',
        'file_size',
        'external_url',
        'icon',
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

    public function getFileUrlAttribute()
    {
        if ($this->external_url) {
            return $this->external_url;
        }

        if (!$this->file_path) {
            return null;
        }

        if (str_starts_with($this->file_path, 'http')) {
            return $this->file_path;
        }

        $apiUrl = config('app.url');
        $storageBase = rtrim($apiUrl, '/') . '/storage';
        $normalized = ltrim($this->file_path, '/');
        $normalized = preg_replace('/^storage\//', '', $normalized);
        
        return $storageBase . '/' . $normalized;
    }
}