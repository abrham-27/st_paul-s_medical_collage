<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchProjectStatisticV2 extends Model
{
    use HasFactory;

    protected $table = 'research_project_statistics_v2';

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