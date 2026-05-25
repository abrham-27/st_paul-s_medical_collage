<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineSubDepartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'name',
        'slug',
        'description',
        'icon',
        'image',
        'display_order',
        'status',
    ];

    public function department()
    {
        return $this->belongsTo(MedicineDepartment::class, 'department_id');
    }

    public function academicUnits()
    {
        return $this->hasMany(AcademicUnit::class, 'sub_department_id')->orderBy('display_order');
    }
}
