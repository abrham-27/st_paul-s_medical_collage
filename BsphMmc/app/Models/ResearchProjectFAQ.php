<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchProjectFAQ extends Model
{
    use HasFactory;

    protected $table = 'research_project_faqs';

    protected $fillable = [
        'research_project_id',
        'question',
        'answer',
        'order_index',
        'status'
    ];

    /**
     * Get the research project that owns the FAQ
     */
    public function researchProject()
    {
        return $this->belongsTo(ResearchProject::class);
    }

    /**
     * Scope to get only active FAQs
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