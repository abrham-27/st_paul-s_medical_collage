<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchProjectFaqV2 extends Model
{
    use HasFactory;

    protected $table = 'research_project_faqs_v2';

    protected $fillable = [
        'research_project_id',
        'question',
        'answer',
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
}