<?php

namespace Database\Seeders;

use App\Models\NursingDepartment;
use App\Models\NursingDepartmentLanding;
use Illuminate\Database\Seeder;

class NursingDepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $data = require __DIR__ . '/data/nursing_departments_data.php'; // loads landing + dept JSON files

        NursingDepartmentLanding::query()->delete();
        NursingDepartment::query()->delete();

        NursingDepartmentLanding::create($data['landing']);

        foreach ($data['departments'] as $order => $dept) {
            NursingDepartment::create(array_merge($dept, ['display_order' => $order, 'status' => true]));
        }
    }
}
