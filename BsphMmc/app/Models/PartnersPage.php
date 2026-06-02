<?php

namespace App\Models;

use App\Traits\HasPublicStorageUrl;
use Illuminate\Database\Eloquent\Model;

class PartnersPage extends Model
{
    use HasPublicStorageUrl;
    protected $table = 'partners_pages';

    protected $fillable = [
        'hero_title',
        'hero_subtitle',
        'hero_banner_image_url',
        'overview_content',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getHeroBannerImageUrlAttribute(?string $value): ?string
    {
        return self::resolvePublicStorageUrl($value);
    }

    public static function getInstance(): self
    {
        return self::firstOrCreate([]);
    }
}
