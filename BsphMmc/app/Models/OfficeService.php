<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class OfficeService extends Model {
    protected $fillable = ['office_type','title','icon','description','display_order','status'];
    public function scopeActive($q) { return $q->where('status','active'); }
    public function scopeOrdered($q) { return $q->orderBy('display_order'); }
}
