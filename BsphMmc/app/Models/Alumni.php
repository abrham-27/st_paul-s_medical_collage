<?php

namespace App\Models;

use App\Traits\HasPublicStorageUrl;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasPublicStorageUrl;

    protected $table = 'alumni';

    protected $fillable = [
        'name',
        'graduation_year',
        'degree',
        'specialty',
        'current_position',
        'workplace',
        'location',
        'email',
        'phone',
        'image',
        'achievements',
        'awards',
        'bio',
        'linkedin',
        'twitter',
        'research_gate',
        'publications',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'graduation_year' => 'integer',
        'achievements' => 'array',
        'awards' => 'array',
        'publications' => 'integer',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Resolve the public storage URL for the profile image.
     */
    public function getImageAttribute(?string $value): ?string
    {
        return self::resolvePublicStorageUrl($value);
    }
}
