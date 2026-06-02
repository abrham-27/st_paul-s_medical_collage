<?php

namespace App\Traits;

trait HasPublicStorageUrl
{
    protected static function resolvePublicStorageUrl(?string $path): ?string
    {
        if (!$path) {
            return null;
        }

        if (preg_match('#^https?://#i', $path)) {
            return $path;
        }

        return asset('storage/' . ltrim($path, '/'));
    }
}
