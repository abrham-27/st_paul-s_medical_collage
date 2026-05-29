<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleResponsibilityFaq extends Model
{
    protected $table = 'role_responsibility_faqs';
    
    protected $fillable = [
        'question',
        'answer',
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
