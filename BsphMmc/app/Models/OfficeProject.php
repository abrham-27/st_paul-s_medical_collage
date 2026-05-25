<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class OfficeProject extends Model {
    protected $fillable = ['office_type','title','slug','image','excerpt','content','status'];
    public function scopePublished($q) { return $q->where('status','published'); }
    public static function generateSlug(string $title): string {
        $slug = Str::slug($title);
        $count = static::where('slug','like',$slug.'%')->count();
        return $count ? $slug.'-'.($count+1) : $slug;
    }
}
