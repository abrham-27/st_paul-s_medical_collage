<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HealthCategory extends Model
{
    protected $fillable = ['name', 'description', 'icon', 'sort_order'];

    public function diseases(): HasMany
    {
        return $this->hasMany(HealthDisease::class)->orderBy('sort_order');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }
}
