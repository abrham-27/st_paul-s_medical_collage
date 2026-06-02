<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PartnerCategory extends Model
{
    protected $table = 'partner_categories';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'display_order',
    ];

    public function partners(): HasMany
    {
        return $this->hasMany(Partner::class, 'category_id');
    }
}
