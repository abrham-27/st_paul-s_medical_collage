<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class OfficeContact extends Model {
    protected $fillable = ['office_type','office_name','email','phone','location','working_hours'];
    public static function getOrCreate(string $type): self {
        return static::firstOrCreate(['office_type' => $type]);
    }
}
