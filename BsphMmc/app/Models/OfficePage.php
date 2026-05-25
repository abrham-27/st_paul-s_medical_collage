<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class OfficePage extends Model {
    protected $fillable = ['office_type','title','content','featured_image'];
    public static function getOrCreate(string $type): self {
        return static::firstOrCreate(['office_type' => $type], ['title' => '', 'content' => '']);
    }
}
