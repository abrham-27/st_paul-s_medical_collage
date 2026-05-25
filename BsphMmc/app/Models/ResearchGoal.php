<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ResearchGoal extends Model
{
    protected $fillable = [
        'title',
        'description',
        'display_order',
        'status'
    ];

    public function scopeActive($query) {
        return $query->where('status', 'active');
    }

    public function scopeOrdered($query) {
        return $query->orderBy('display_order', 'asc');
    }
}
