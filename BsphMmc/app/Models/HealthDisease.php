<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HealthDisease extends Model
{
    protected $fillable = [
        'health_category_id', 'name', 'description',
        'symptoms', 'prevention', 'advice', 'sort_order',
    ];

    protected $casts = [
        'symptoms'   => 'array',
        'prevention' => 'array',
        'advice'     => 'array',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(HealthCategory::class, 'health_category_id');
    }
}
