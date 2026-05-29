<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleResponsibilityContent extends Model
{
    protected $table = 'role_responsibility_content';
    
    protected $fillable = [
        'section_type',
        'title',
        'subtitle',
        'content',
        'image',
        'cta_button_text',
        'cta_button_link',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('section_type', $type);
    }
}
