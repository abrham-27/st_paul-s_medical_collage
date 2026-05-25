<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class OfficeGallery extends Model {
    protected $fillable = ['office_type','title','image','category','sort_order'];
}
