<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfficeProcess extends Model
{
    protected $fillable = [
        'office_type',
        'step_number',
        'title',
        'description',
        'icon',
        'status'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeByOffice($query, string $office)
    {
        return $query->where('office_type', $office);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('step_number');
    }
}