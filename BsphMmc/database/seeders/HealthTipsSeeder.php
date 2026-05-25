<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HealthCategory;
use App\Models\HealthDisease;
use App\Models\SpecializedCenter;

class HealthTipsSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'name' => 'Cancer', 'icon' => '🎗️', 'sort_order' => 1,
                'description' => 'Authoritative resources on various types of cancer, their early detection, and management.',
                'diseases' => [
                    ['name' => 'Breast Cancer', 'description' => 'One of the most common cancers affecting women worldwide.',
                     'symptoms' => ['Painless lump in the breast','Change in breast shape or size','Skin dimpling or redness','Nipple discharge'],
                     'prevention' => ['Regular self-examination','Clinical breast exams and mammograms','Maintaining a healthy weight','Limiting alcohol consumption'],
                     'advice' => ['Early detection significantly improves survival rates','Consult a doctor immediately if you find a lump','Genetic counseling for those with family history']],
                    ['name' => 'Lung Cancer', 'description' => 'Leading cause of cancer-related deaths, often linked to smoking.',
                     'symptoms' => ['Persistent cough','Coughing up blood','Shortness of breath','Chest pain','Unexplained weight loss'],
                     'prevention' => ['Avoid smoking and tobacco products','Reduce exposure to secondhand smoke','Test home for radon','Use protective gear in hazardous workplaces'],
                     'advice' => ['Quitting smoking at any age reduces risk','Early screening for high-risk individuals is vital','Support groups can help manage the emotional impact']],
                    ['name' => 'Prostate Cancer', 'description' => 'Common cancer in men, often slow-growing but requiring monitoring.',
                     'symptoms' => ['Frequent urination, especially at night','Difficulty starting or stopping urination','Blood in urine or semen','Bone pain in the lower back or hips'],
                     'prevention' => ['Maintain a healthy diet rich in fruits and vegetables','Regular physical activity','Screening for men over 50'],
                     'advice' => ['Discuss screening pros and cons with your doctor','Many prostate cancers grow slowly','Choose a healthy lifestyle to support overall prostate health']],
                ],
            ],
            [
                'name' => 'Cardiovascular', 'icon' => '🩸', 'sort_order' => 2,
                'description' => 'Information on conditions affecting the blood vessels and circulation system.',
                'diseases' => [
                    ['name' => 'Hypertension', 'description' => 'High blood pressure that can lead to severe health complications.',
                     'symptoms' => ['Severe headaches','Fatigue or confusion','Vision problems','Chest pain','Difficulty breathing'],
                     'prevention' => ['Reduce salt intake','Eat a balanced diet (DASH diet)','Regular exercise','Limit alcohol and caffeine'],
                     'advice' => ['Monitor your blood pressure regularly at home','Take prescribed medications consistently','Reduce stress through relaxation techniques']],
                    ['name' => 'Stroke', 'description' => 'A medical emergency when blood supply to part of the brain is interrupted.',
                     'symptoms' => ['Face drooping','Arm weakness','Speech difficulty','Sudden confusion','Trouble seeing in one or both eyes'],
                     'prevention' => ['Manage high blood pressure','Control cholesterol and diabetes','Quit smoking','Stay physically active'],
                     'advice' => ['Remember FAST (Face, Arms, Speech, Time)','Immediate medical attention is critical','Rehabilitation is key to recovery post-stroke']],
                ],
            ],
            [
                'name' => 'Heart Health', 'icon' => '❤️', 'sort_order' => 3,
                'description' => 'Dedicated resources for maintaining a healthy heart and managing heart-specific conditions.',
                'diseases' => [
                    ['name' => 'Heart Failure', 'description' => "Condition where the heart doesn't pump blood as well as it should.",
                     'symptoms' => ['Shortness of breath during activity or lying down','Fatigue and weakness','Swelling in legs, ankles, and feet','Rapid or irregular heartbeat'],
                     'prevention' => ['Manage underlying conditions like CAD and hypertension','Maintain a healthy weight','Lower high cholesterol','Don\'t smoke'],
                     'advice' => ['Follow a low-sodium diet','Track your daily fluid intake if advised','Exercise within your doctor\'s recommended limits']],
                    ['name' => 'Arrhythmia', 'description' => 'Problems with the rhythm or rate of the heartbeat.',
                     'symptoms' => ['Fluttering in the chest','Racing heartbeat (tachycardia)','Slow heartbeat (bradycardia)','Chest pain','Shortness of breath'],
                     'prevention' => ['Reduce stress','Limit caffeine and nicotine','Avoid stimulants in over-the-counter medications','Treat sleep apnea if present'],
                     'advice' => ['Learn to check your own pulse','Identify triggers for your irregular heartbeats','Carry a list of your medications at all times']],
                ],
            ],
            [
                'name' => 'Infectious Diseases', 'icon' => '🦠', 'sort_order' => 4,
                'description' => 'Preventing and managing diseases caused by organisms like bacteria, viruses, or parasites.',
                'diseases' => [
                    ['name' => 'Malaria', 'description' => 'Mosquito-borne disease prevalent in many tropical regions.',
                     'symptoms' => ['Fever and chills','Headache','Nausea and vomiting','Muscle pain and fatigue'],
                     'prevention' => ['Sleep under insecticide-treated nets','Use mosquito repellents','Wear protective clothing','Take preventive antimalarial medication when traveling'],
                     'advice' => ['Seek treatment immediately if symptoms appear after being in a malaria region','Complete the full course of treatment as prescribed','Help eliminate mosquito breeding sites around the home']],
                    ['name' => 'Tuberculosis', 'description' => 'Infectious disease primarily affecting the lungs but can spread to other parts.',
                     'symptoms' => ['Cough that lasts 3 weeks or more','Coughing up blood','Chest pain','Unintentional weight loss','Night sweats'],
                     'prevention' => ['BCG vaccination','Covering mouth and nose when coughing','Ensuring good ventilation','Identifying and treating latent TB infections'],
                     'advice' => ['TB is curable with proper long-term treatment','Never skip doses of TB medication','Consult a doctor if you have persistent cough for more than 2 weeks']],
                ],
            ],
        ];

        foreach ($data as $i => $catData) {
            $cat = HealthCategory::updateOrCreate(['name' => $catData['name']], [
                'description' => $catData['description'],
                'icon'        => $catData['icon'],
                'sort_order'  => $catData['sort_order'],
            ]);
            foreach ($catData['diseases'] as $j => $d) {
                HealthDisease::updateOrCreate(
                    ['health_category_id' => $cat->id, 'name' => $d['name']],
                    ['description' => $d['description'], 'symptoms' => $d['symptoms'],
                     'prevention' => $d['prevention'], 'advice' => $d['advice'], 'sort_order' => $j]
                );
            }
        }

        $centers = [
            ['name' => 'National Kidney Transplant Center', 'icon' => '🧬', 'sort_order' => 1,
             'description' => "St. Paul's established and operates the first kidney transplant center in Ethiopia.",
             'details' => 'Our center is equipped with state-of-the-art facilities for kidney transplantation, providing life-saving procedures to patients from across the nation and beyond.',
             'location' => 'Main Hospital Block, 3rd Floor', 'hours' => '24/7 Emergency, 8:00 AM - 5:00 PM OPD', 'contact' => '+251 112 75 01 25'],
            ['name' => 'Open-Heart Surgery Service', 'icon' => '❤️', 'sort_order' => 2,
             'description' => 'Launched in partnership with the Children\'s Heart Fund of Ethiopia and other specialized centers.',
             'details' => 'This service provides specialized cardiac surgeries, including complex open-heart procedures.',
             'location' => 'Cardiac Wing, 2nd Floor', 'hours' => '24/7 Emergency, 8:00 AM - 5:00 PM OPD', 'contact' => '+251 112 75 01 25'],
            ['name' => 'IVF and Fertility Center', 'icon' => '👶', 'sort_order' => 3,
             'description' => 'Offers advanced reproductive health services, including IVF and fertility treatments.',
             'details' => 'Our center provides a range of advanced reproductive health services, including In-Vitro Fertilization (IVF), fertility preservation, and specialized gynecological care.',
             'location' => 'Women\'s Health Block, 1st Floor', 'hours' => '8:00 AM - 5:00 PM Mon-Sat', 'contact' => '+251 112 75 01 25'],
            ['name' => 'Specialized Trauma Care', 'icon' => '🚑', 'sort_order' => 4,
             'description' => 'Features dedicated facilities for trauma and orthopedics.',
             'details' => 'The trauma unit is designed to handle severe injuries and orthopedic emergencies with dedicated operating rooms and intensive care facilities.',
             'location' => 'Emergency Block, Ground Floor', 'hours' => '24/7', 'contact' => '+251 112 75 01 25'],
            ['name' => 'Burn Care Unit', 'icon' => '🔥', 'sort_order' => 5,
             'description' => 'Specialized treatment for burn injuries.',
             'details' => 'Our Burn Care Unit provides comprehensive treatment for all types of burn injuries, focusing on advanced wound management, surgical skin grafting, and long-term rehabilitation.',
             'location' => 'AaBET Building', 'hours' => '24/7', 'contact' => '+251 112 75 01 25'],
        ];

        foreach ($centers as $c) {
            SpecializedCenter::updateOrCreate(['name' => $c['name']], $c);
        }

        $this->command->info('✅ Health Tips & Specialized Centers seeded');
    }
}
