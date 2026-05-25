<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecializedCenter extends Model
{
    protected $fillable = [
        'name', 'description', 'details',
        'icon', 'location', 'hours', 'contact', 'sort_order',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }
}
