<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnershipStatistic extends Model
{
    protected $table = 'partnership_statistics';

    protected $fillable = [
        'title',
        'value',
        'icon_class',
        'display_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
