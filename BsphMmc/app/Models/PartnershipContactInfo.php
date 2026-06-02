<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnershipContactInfo extends Model
{
    protected $table = 'partnership_contact_info';

    protected $fillable = [
        'office_name',
        'email',
        'phone',
        'address',
        'office_hours',
        'website_url',
    ];

    // Ensure only one record exists
    public static function getInstance(): self
    {
        return self::firstOrCreate([]);
    }
}
