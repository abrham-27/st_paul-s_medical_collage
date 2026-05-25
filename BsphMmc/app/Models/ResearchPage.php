<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ResearchPage extends Model
{
    protected $fillable = [
        'page_type', // background, mission, vision
        'title',
        'content', 
        'image',
        'status'
    ];

    public function scopeActive($query) {
        return $query->where('status', 'active');
    }
}
