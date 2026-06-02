<?php

namespace App\Models;

use App\Traits\HasPublicStorageUrl;
use Illuminate\Database\Eloquent\Model;

class SuccessStory extends Model
{
    use HasPublicStorageUrl;
    protected $table = 'success_stories';

    protected $fillable = [
        'title',
        'slug',
        'image_url',
        'summary',
        'content',
        'display_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getImageUrlAttribute(?string $value): ?string
    {
        return self::resolvePublicStorageUrl($value);
    }

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
