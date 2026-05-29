<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleResponsibilityProcess extends Model
{
    protected $table = 'role_responsibility_processes';
    
    protected $fillable = [
        'title',
        'description',
        'step_number',
        'icon',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', true)->orderBy('step_number');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}
