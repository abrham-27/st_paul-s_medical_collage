<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleResponsibilityCategory extends Model
{
    protected $table = 'role_responsibility_categories';
    
    protected $fillable = [
        'title',
        'icon',
        'image',
        'summary',
        'detailed_content',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', true)->orderBy('sort_order');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}
