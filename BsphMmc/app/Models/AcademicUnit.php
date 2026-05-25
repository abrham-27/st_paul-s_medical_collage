<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicUnit extends Model
{
    use HasFactory;

    protected $fillable = [
        'sub_department_id',
        'name',
        'description',
        'display_order',
        'status',
    ];

    public function subDepartment()
    {
        return $this->belongsTo(MedicineSubDepartment::class, 'sub_department_id');
    }
}
