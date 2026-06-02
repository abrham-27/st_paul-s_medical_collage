<?php

namespace App\Models;

use App\Traits\HasPublicStorageUrl;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Partner extends Model
{
    use HasPublicStorageUrl;
    protected $table = 'partners';

    protected $fillable = [
        'name',
        'slug',
        'logo_image_url',
        'short_description',
        'full_description',
        'category_id',
        'website_url',
        'partnership_year',
        'collaboration_type',
        'is_featured',
        'display_order',
        'is_active',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'partnership_year' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(PartnerCategory::class, 'category_id');
    }

    public function featuredPartner(): HasMany
    {
        return $this->hasMany(FeaturedPartner::class, 'partner_id');
    }

    public function getLogoImageUrlAttribute(?string $value): ?string
    {
        return self::resolvePublicStorageUrl($value);
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->slug) {
                $model->slug = \Illuminate\Support\Str::slug($model->name);
            }
        });
        static::updating(function ($model) {
            if ($model->isDirty('name')) {
                $model->slug = \Illuminate\Support\Str::slug($model->name);
            }
        });
    }
}
