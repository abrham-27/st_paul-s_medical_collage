<?php

namespace App\Models;

use App\Traits\HasPublicStorageUrl;
use Illuminate\Database\Eloquent\Model;

class PartnershipDocument extends Model
{
    use HasPublicStorageUrl;
    protected $table = 'partnership_documents';

    protected $fillable = [
        'title',
        'slug',
        'file_url',
        'document_category',
        'description',
        'display_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getFileUrlAttribute(?string $value): ?string
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
