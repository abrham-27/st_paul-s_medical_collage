<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleResponsibilityContact extends Model
{
    protected $table = 'role_responsibility_contact';
    
    protected $fillable = [
        'office_name',
        'office_location',
        'email',
        'phone',
        'office_hours',
        'website',
        'additional_info',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
}
