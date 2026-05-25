<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MedicineDepartment;
use App\Models\MedicineSubDepartment;
use App\Models\AcademicUnit;
use Illuminate\Support\Str;

class MedicineDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        MedicineDepartment::truncate();
        MedicineSubDepartment::truncate();
        AcademicUnit::truncate();
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $data = [
            [
                'name' => 'Basic Sciences Departments',
                'slug' => 'basic',
                'description' => 'Foundational medical sciences providing the groundwork for clinical practice.',
                'sub_departments' => [
                    ['name' => 'Anatomy', 'slug' => 'anatomy'],
                    ['name' => 'Physiology', 'slug' => 'physiology'],
                    ['name' => 'Biochemistry', 'slug' => 'biochemistry'],
                    ['name' => 'Pathology', 'slug' => 'pathology'],
                    ['name' => 'Microbiology', 'slug' => 'microbiology'],
                    ['name' => 'Pharmacology', 'slug' => 'pharmacology'],
                    ['name' => 'Immunology', 'slug' => 'immunology'],
                ]
            ],
            [
                'name' => 'Preclinical and Paraclinical Departments',
                'slug' => 'preclinical',
                'description' => 'Bridge between basic sciences and clinical medicine focusing on community and ethics.',
                'sub_departments' => [
                    ['name' => 'Community Medicine and Public Health', 'slug' => 'community-medicine'],
                    ['name' => 'Medical Ethics and Behavioral Sciences', 'slug' => 'medical-ethics'],
                    ['name' => 'Forensic Medicine', 'slug' => 'forensic-medicine'],
                    ['name' => 'Medical Education', 'slug' => 'medical-education'],
                ]
            ],
            [
                'name' => 'Clinical Departments',
                'slug' => 'clinical',
                'description' => 'Core medical and surgical specialties involving direct patient care.',
                'sub_departments' => [
                    [
                        'name' => 'Medicine and Allied Specialties', 
                        'slug' => 'medicine-allied',
                        'academic_units' => ['Internal Medicine', 'Cardiology', 'Dermatology', 'Neurology', 'Psychiatry']
                    ],
                    [
                        'name' => 'Surgery and Allied Specialties', 
                        'slug' => 'surgery-allied',
                        'academic_units' => ['General Surgery', 'Orthopedics', 'Neurosurgery', 'Urology', 'Plastic and Reconstructive Surgery']
                    ],
                    [
                        'name' => 'Pediatrics and Child Health', 
                        'slug' => 'pediatrics-child-health',
                        'academic_units' => ['General Pediatrics', 'Neonatology', 'Pediatric Cardiology', 'Pediatric Surgery']
                    ],
                    ['name' => 'Obstetrics and Gynecology', 'slug' => 'ob-gyn'],
                    ['name' => 'Radiology and Imaging', 'slug' => 'radiology'],
                    ['name' => 'Anesthesiology', 'slug' => 'anesthesiology'],
                    ['name' => 'Ophthalmology', 'slug' => 'ophthalmology'],
                    ['name' => 'Otorhinolaryngology (ENT)', 'slug' => 'ent'],
                    ['name' => 'Orthopedics', 'slug' => 'orthopedics-main'],
                ]
            ],
            [
                'name' => 'Specialized Units and Departments',
                'slug' => 'specialized',
                'description' => 'Advanced specialized medical units and departments.',
                'sub_departments' => [
                    ['name' => 'Emergency Medicine', 'slug' => 'emergency-medicine'],
                    ['name' => 'Oncology', 'slug' => 'oncology'],
                    ['name' => 'Infectious Diseases', 'slug' => 'infectious-diseases'],
                    ['name' => 'Palliative Care', 'slug' => 'palliative-care'],
                    ['name' => 'Rehabilitation Medicine', 'slug' => 'rehabilitation-medicine'],
                ]
            ],
        ];

        foreach ($data as $deptData) {
            $department = MedicineDepartment::create([
                'name' => $deptData['name'],
                'slug' => $deptData['slug'],
                'description' => $deptData['description'],
                'display_order' => 0,
                'status' => true,
            ]);

            foreach ($deptData['sub_departments'] as $subIdx => $subData) {
                $subDepartment = $department->subDepartments()->create([
                    'name' => $subData['name'],
                    'slug' => $subData['slug'],
                    'display_order' => $subIdx,
                    'status' => true,
                ]);

                if (isset($subData['academic_units'])) {
                    foreach ($subData['academic_units'] as $unitIdx => $unitName) {
                        $subDepartment->academicUnits()->create([
                            'name' => $unitName,
                            'display_order' => $unitIdx,
                            'status' => true,
                        ]);
                    }
                }
            }
        }
    }
}
