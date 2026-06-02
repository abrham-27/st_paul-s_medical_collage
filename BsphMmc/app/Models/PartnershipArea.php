<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnershipArea extends Model
{
    protected $table = 'partnership_areas';

    protected $fillable = [
        'title',
        'slug',
        'icon_class',
        'description',
        'display_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->slug) {
                $model->slug = \Illuminate\Support\Str::slug($model->title);
            }
        });
        static::updating(function ($model) {
            if ($model->isDirty('title')) {
                $model->slug = \Illuminate\Support\Str::slug($model->title);
            }
        });
    }
}
