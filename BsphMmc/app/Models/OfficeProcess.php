<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class OfficeProcess extends Model {
    protected $fillable = ['office_type','step_number','title','description','icon','status','sort_order'];
    
    public function scopeActive($q) { 
        return $q->where('status','active'); 
    }
    
    public function scopeOrdered($q) { 
        return $q->orderBy('sort_order', 'asc'); 
    }
    
    public static function generateSlug(string $title): string {
        $slug = Str::slug($title);
        $count = static::where('slug','like',$slug.'%')->count();
        return $count ? $slug.'-'.($count+1) : $slug;
    }
}
