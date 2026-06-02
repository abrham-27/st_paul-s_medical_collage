<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnershipApplication extends Model
{
    protected $fillable = [
        'institution_name',
        'institution_type',
        'country',
        'city',
        'website_url',
        'contact_person_name',
        'contact_email',
        'contact_phone',
        'contact_role',
        'collaboration_interests',
        'message',
        'status',
        'admin_feedback',
        'reviewed_at',
    ];

    protected $casts = [
        'reviewed_at' => 'datetime',
    ];

    public const STATUSES = [
        'pending' => 'Pending',
        'under_review' => 'Under Review',
        'approved' => 'Approved',
        'declined' => 'Declined',
    ];

    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }
}
