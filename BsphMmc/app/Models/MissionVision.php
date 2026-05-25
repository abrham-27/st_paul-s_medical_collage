<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MissionVision extends Model
{
    protected $table = 'mission_vision';

    protected $fillable = ['type', 'title', 'description'];

    public static function mission(): self
    {
        return self::firstOrCreate(['type' => 'mission'], [
            'title'       => 'Our Mission',
            'description' => '',
        ]);
    }

    public static function vision(): self
    {
        return self::firstOrCreate(['type' => 'vision'], [
            'title'       => 'Our Vision',
            'description' => '',
        ]);
    }
}
