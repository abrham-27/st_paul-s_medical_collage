<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleResponsibilityStatistic extends Model
{
    protected $table = 'role_responsibility_statistics';
    
    protected $fillable = [
        'label',
        'value',
        'icon',
        'description',
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
