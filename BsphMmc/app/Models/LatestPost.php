<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LatestPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'type',
        'featured_image',
        'file_path',
        'event_date',
        'author',
        'status',
    ];

    protected $casts = [
        'event_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $appends = [
        'featured_image_url',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getFeaturedImageUrlAttribute()
    {
        if (! $this->featured_image) {
            return null;
        }

        if (str_starts_with($this->featured_image, 'http')) {
            return $this->featured_image;
        }

        return asset('storage/' . $this->featured_image);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeUpcomingEvents($query)
    {
        return $query->where('type', 'event')
                    ->where('event_date', '>=', now())
                    ->orderBy('event_date', 'asc');
    }

    public function scopePastEvents($query)
    {
        return $query->where('type', 'event')
                    ->where('event_date', '<', now())
                    ->orderBy('event_date', 'desc');
    }

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function getFormattedEventDateAttribute()
    {
        return $this->event_date ? $this->event_date->format('F j, Y - g:i A') : null;
    }

    public function getIsUpcomingEventAttribute()
    {
        return $this->type === 'event' && $this->event_date && $this->event_date->isFuture();
    }
}
