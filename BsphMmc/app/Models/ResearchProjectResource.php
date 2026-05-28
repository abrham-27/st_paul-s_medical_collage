<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchProjectResource extends Model
{
    use HasFactory;

    protected $fillable = [
        'research_project_id',
        'title',
        'description',
        'file_path',
        'file_type',
        'file_size',
        'external_url',
        'download_count',
        'order_index',
        'status'
    ];

    protected $casts = [
        'download_count' => 'integer',
        'order_index' => 'integer'
    ];

    /**
     * Get the research project that owns the resource
     */
    public function researchProject()
    {
        return $this->belongsTo(ResearchProject::class);
    }

    /**
     * Scope to get only active resources
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
     * Get the full file URL
     */
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

    /**
     * Increment download count
     */
    public function incrementDownloadCount()
    {
        $this->increment('download_count');
    }

    /**
     * Get file type icon
     */
    public function getFileTypeIconAttribute()
    {
        $icons = [
            'pdf' => '📄',
            'doc' => '📝',
            'docx' => '📝',
            'xls' => '📊',
            'xlsx' => '📊',
            'ppt' => '📊',
            'pptx' => '📊',
            'zip' => '📦',
            'rar' => '📦',
            'jpg' => '🖼️',
            'jpeg' => '🖼️',
            'png' => '🖼️',
            'gif' => '🖼️',
            'mp4' => '🎥',
            'avi' => '🎥',
            'mov' => '🎥',
            'mp3' => '🎵',
            'wav' => '🎵',
        ];

        return $icons[$this->file_type] ?? '📄';
    }
}