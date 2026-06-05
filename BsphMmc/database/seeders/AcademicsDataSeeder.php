<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AcademicsDataSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('academics')->truncate();

        $now = now();

        $data = [
            // 1. Basic Sciences Departments
            ['title' => 'Anatomy',          'department' => 'Basic Sciences', 'description' => 'Foundational study of the structure of the human body.', 'image' => null, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Physiology',        'department' => 'Basic Sciences', 'description' => 'Study of the normal functions of living organisms and their parts.', 'image' => null, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Biochemistry',      'department' => 'Basic Sciences', 'description' => 'Study of chemical processes within and related to living organisms.', 'image' => null, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Pathology',         'department' => 'Basic Sciences', 'description' => 'Study of the causes and effects of disease or injury.', 'image' => null, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Microbiology',      'department' => 'Basic Sciences', 'description' => 'Study of microorganisms including bacteria, viruses, fungi, and parasites.', 'image' => null, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Pharmacology',      'department' => 'Basic Sciences', 'description' => 'Study of drug action and the interactions between drugs and biological systems.', 'image' => null, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Immunology',        'department' => 'Basic Sciences', 'description' => 'Study of the immune system and its role in health and disease.', 'image' => null, 'created_at' => $now, 'updated_at' => $now],

            // 2. Preclinical and Paraclinical Departments
            ['title' => 'Community Medicine and Public Health', 'department' => 'Preclinical & Paraclinical', 'description' => 'Focuses on population health, disease prevention, and community-based healthcare.', 'image' => null, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Medical Ethics and Behavioral Sciences', 'department' => 'Preclinical & Paraclinical', 'description' => 'Covers ethical principles in medicine and the behavioral aspects of healthcare.', 'image' => null, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Forensic Medicine', 'department' => 'Preclinical & Paraclinical', 'description' => 'Application of medical knowledge to legal and criminal investigations.', 'image' => null, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Medical Education',  'department' => 'Preclinical & Paraclinical', 'description' => 'Dedicated to advancing teaching methodologies and curriculum development in medicine.', 'image' => null, 'created_at' => $now, 'updated_at' => $now],

            // 3. Clinical Departments — Medicine
            ['title' => 'Internal Medicine',  'department' => 'Clinical — Medicine & Allied', 'description' => 'Diagnosis and non-surgical treatment of adult diseases.', 'image' => null, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Cardiology',          'department' => 'Clinical — Medicine & Allied', 'description' => 'Specialization in heart and cardiovascular system disorders.', 'image' => null, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Dermatology',         'department' => 'Clinical — Medicine & Allied', 'description' => 'Diagnosis and treatment of skin, hair, and nail conditions.', 'image' => null, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Neurology',           'department' => 'Clinical — Medicine & Allied', 'description' => 'Specialization in disorders of the nervous system.', 'image' => null, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Psychiatry',          'department' => 'Clinical — Medicine & Allied', 'description' => 'Diagnosis and treatment of mental, emotional, and behavioral disorders.', 'image' => null, 'created_at' => $now, 'updated_at' => $now],

            // 3. Clinical Departments — Surgery
            ['title' => 'General Surgery',     'department' => 'Clinical — Surgery & Allied', 'description' => 'Surgical treatment of abdominal organs, skin, and soft tissue.', 'image' => null, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Orthopedics',         'department' => 'Clinical — Surgery & Allied', 'description' => 'Surgical and non-surgical treatment of musculoskeletal system disorders.', 'image' => null, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Neurosurgery',        'department' => 'Clinical — Surgery & Allied', 'description' => 'Surgical treatment of disorders of the nervous system.', 'image' => null, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Urology',             'department' => 'Clinical — Surgery & Allied', 'description' => 'Surgical treatment of urinary tract and male reproductive system disorders.', 'image' => null, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Plastic and Reconstructive Surgery', 'department' => 'Clinical — Surgery & Allied', 'description' => 'Restoration, reconstruction, and alteration of the human body.', 'image' => null, 'created_at' => $now, 'updated_at' => $now],

            // 3. Clinical Departments — Pediatrics
            ['title' => 'General Pediatrics',  'department' => 'Clinical — Pediatrics & Child Health', 'description' => 'Medical care of infants, children, and adolescents.', 'image' => null, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Neonatology',         'department' => 'Clinical — Pediatrics & Child Health', 'description' => 'Specialized care for newborn infants, especially premature or ill newborns.', 'image' => null, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Pediatric Cardiology','department' => 'Clinical — Pediatrics & Child Health', 'description' => 'Diagnosis and treatment of heart conditions in children.', 'image' => null, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Pediatric Surgery',   'department' => 'Clinical — Pediatrics & Child Health', 'description' => 'Surgical treatment of diseases in fetuses, infants, children, and adolescents.', 'image' => null, 'created_at' => $now, 'updated_at' => $now],

            // 3. Clinical Departments — OB/GYN
            ['title' => 'General Obstetrics',  'department' => 'Clinical — Obstetrics & Gynecology', 'description' => 'Care during pregnancy, childbirth, and the postpartum period.', 'image' => null, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Gynecology',          'department' => 'Clinical — Obstetrics & Gynecology', 'description' => 'Medical practice dealing with the health of the female reproductive system.', 'image' => null, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Maternal and Fetal Medicine', 'department' => 'Clinical — Obstetrics & Gynecology', 'description' => 'Subspecialty focusing on management of high-risk pregnancies.', 'image' => null, 'created_at' => $now, 'updated_at' => $now],

            // 3. Clinical Departments — Radiology
            ['title' => 'Diagnostic Radiology',    'department' => 'Clinical — Radiology & Imaging', 'description' => 'Use of imaging technologies to diagnose diseases.', 'image' => null, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Interventional Radiology', 'department' => 'Clinical — Radiology & Imaging', 'description' => 'Minimally invasive procedures guided by imaging technologies.', 'image' => null, 'created_at' => $now, 'updated_at' => $now],

            // 3. Clinical Departments — Anesthesiology
            ['title' => 'General Anesthesia',  'department' => 'Clinical — Anesthesiology', 'description' => 'Administration of anesthesia for surgical and medical procedures.', 'image' => null, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Pain Management',     'department' => 'Clinical — Anesthesiology', 'description' => 'Multidisciplinary approach to relieving pain and improving quality of life.', 'image' => null, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Critical Care Medicine', 'department' => 'Clinical — Anesthesiology', 'description' => 'Specialized care for patients with life-threatening conditions.', 'image' => null, 'created_at' => $now, 'updated_at' => $now],

            // 3. Clinical Departments — Other
            ['title' => 'Ophthalmology',       'department' => 'Clinical — Specialized', 'description' => 'Focused on eye care and surgery.', 'image' => null, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Otorhinolaryngology (ENT)', 'department' => 'Clinical — Specialized', 'description' => 'Focused on ear, nose, throat, and related structures.', 'image' => null, 'created_at' => $now, 'updated_at' => $now],

            // 4. Specialized Units
            ['title' => 'Emergency Medicine',  'department' => 'Specialized Units', 'description' => 'Immediate decision-making and action to prevent death or further disability.', 'image' => null, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Oncology',            'department' => 'Specialized Units', 'description' => 'Diagnosis and treatment of cancer.', 'image' => null, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Infectious Diseases', 'department' => 'Specialized Units', 'description' => 'Diagnosis and treatment of infections caused by bacteria, viruses, fungi, and parasites.', 'image' => null, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Palliative Care',     'department' => 'Specialized Units', 'description' => 'Specialized medical care focused on relief from symptoms and stress of serious illness.', 'image' => null, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Rehabilitation Medicine', 'department' => 'Specialized Units', 'description' => 'Restoration of function and quality of life for patients with physical impairments.', 'image' => null, 'created_at' => $now, 'updated_at' => $now],

            // 5. Research and Training Centers
            ['title' => 'Clinical Research Center', 'department' => 'Research & Training', 'description' => 'Dedicated to conducting clinical trials and medical research at SPHMMC.', 'image' => null, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Medical Simulation and Skills Training Center', 'department' => 'Research & Training', 'description' => 'Advanced simulation-based training for medical students and healthcare professionals.', 'image' => null, 'created_at' => $now, 'updated_at' => $now],
        ];

        DB::table('academics')->insert($data);
    }
}

