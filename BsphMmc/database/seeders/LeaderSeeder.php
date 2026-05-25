<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Leader;

class LeaderSeeder extends Seeder
{
    public function run(): void
    {
        $leaders = [
            [
                'full_name'     => 'Muluken Tesfaye',
                'position'      => 'Chief Executive Director / Provost',
                'qualification' => 'MD, Psychiatry',
                'biography'     => "Dr. Muluken Tesfaye is the Chief Executive Director of St. Paul's Hospital Millennium Medical College (SPHMMC). He was appointed by H.E. Dr. Mekdes Daba, Minister of Health. Dr. Muluken brings over a decade of experience as a clinician, academician, healthcare leader, and program manager. He has served SPHMMC as Assistant Professor, Head of the Department of Psychiatry, and member of the Academic Council and Senate (2018–2023). During this time, he also worked as Senior Advisor for Medical Services in the Office of the Vice Provost. Since September 2023, Dr. Muluken has been leading Eka Kotebe Hospital as Chief Executive Director. He is also a former President of the Ethiopian Psychiatric Association.",
                'display_order' => 1,
                'status'        => 'active',
                'profile_image' => null,
            ],
            [
                'full_name'     => 'Jemal Shifa Mussa',
                'position'      => 'Business Development Vice Provost (BDVP)',
                'qualification' => 'MPH, BSc Public Health',
                'biography'     => "Mr. Jemal Shifa Mussa is a seasoned healthcare leader with extensive experience in public health and hospital management. He earned his Bachelor of Science in Public Health (BSc) degree from Dilla University, Faculty of Health Science, and further pursued graduate study with a Master of Public Health (MPH) at Addis Continental Institute of Public Health, Addis Ababa. He currently serves as the Business Development Vice Provost (BDVP) at St. Paul's Hospital Millennium Medical College. Prior to this role, he was the Chief Executive Director at Werabe Comprehensive Specialized Hospital, where he successfully established numerous specialty services and led major healthcare initiatives. He has been awarded excellence in healthcare service quality at national levels.",
                'display_order' => 2,
                'status'        => 'active',
                'profile_image' => null,
            ],
            [
                'full_name'     => 'Lemi Belay',
                'position'      => 'Academic and Medical Services Corporate Director',
                'qualification' => 'MD, Associate Professor OB/GYN',
                'biography'     => "Dr. Lemi Belay was appointed as the new Academic and Medical Services Corporate Director of SPHMMC by Her Excellency Dr. Mekdes Daba, Minister of Health. An Associate Professor of Obstetrics and Gynecology, Dr. Lemi specializes in Family Planning and Reproductive Health as well as Maternal and Fetal Medicine. He is a distinguished researcher, educator, and trainer, with more than 65 publications in leading international journals. Dr. Lemi has made significant contributions to the development of international and national reproductive health guidelines, protocols, and training materials—including valuable inputs to World Health Organization (WHO) protocols and guidelines.",
                'display_order' => 3,
                'status'        => 'active',
                'profile_image' => null,
            ],
            [
                'full_name'     => 'Ewenat Gebrehanna',
                'position'      => 'Research and Community Service Vice Provost',
                'qualification' => 'PhD Public Health, MPH',
                'biography'     => "Dr. Ewenat Gebrehanna has been appointed as the Research and Community Service Corporate Director of SPHMMC. Dr. Ewenat is a distinguished public health researcher and academician with over 20 years of experience managing diverse research projects and leading collaborations across institutions in Ethiopia and internationally. She currently serves as an Associate Professor at SPHMMC, where she leads major grant-funded initiatives focused on reproductive health, gender equity, and health systems strengthening. She holds a PhD in Public Health from the University of Gondar and an MPH from Addis Ababa University. She also serves as an Executive Board Member of the Ethiopian Public Health Association (EPHA).",
                'display_order' => 4,
                'status'        => 'active',
                'profile_image' => null,
            ],
        ];

        foreach ($leaders as $data) {
            Leader::updateOrCreate(
                ['full_name' => $data['full_name']],
                $data
            );
        }

        $this->command->info('✅ Leaders seeded: ' . count($leaders) . ' records');
    }
}
