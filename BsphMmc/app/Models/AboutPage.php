<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutPage extends Model
{
    protected $fillable = [
        'page_title', 'subtitle', 'main_description',
        'history_text', 'featured_image', 'additional_content',
        'seo_title', 'seo_description',
    ];

    /** Always return the single CMS record, creating it if absent. */
    public static function instance(): self
    {
        return self::firstOrCreate([], ['page_title' => 'About Us']);
    }
}
