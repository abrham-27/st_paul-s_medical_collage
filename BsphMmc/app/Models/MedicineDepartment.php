<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineDepartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'image',
        'display_order',
        'status',
    ];

    public function subDepartments()
    {
        return $this->hasMany(MedicineSubDepartment::class, 'department_id')->orderBy('display_order');
    }
}
