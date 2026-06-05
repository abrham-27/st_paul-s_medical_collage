<?php

namespace Database\Seeders;

use App\Models\Alumni;
use App\Models\AlumniEvent;
use Illuminate\Database\Seeder;

class AlumniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing records first
        Alumni::truncate();
        AlumniEvent::truncate();

        // Seed Alumni profiles
        $alumniData = [
            [
                'name' => 'Dr. Sara Tekle',
                'graduation_year' => 2015,
                'degree' => 'Doctor of Medicine',
                'specialty' => 'Cardiology',
                'current_position' => 'Senior Cardiologist',
                'workplace' => 'Mayo Clinic',
                'location' => 'Rochester, USA',
                'email' => 'sara.tekle@sphmmc.edu.et',
                'phone' => '+1 507 123 4567',
                'image' => 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&h=400&fit=crop&crop=face',
                'achievements' => [
                    'Pioneered minimally invasive cardiac procedures',
                    'Published 25+ research papers in cardiology',
                    'Established cardiac rehabilitation program',
                    'WHO consultant for cardiovascular health'
                ],
                'awards' => ['Excellence in Cardiology Award 2022', 'Innovation in Medicine 2021'],
                'bio' => 'Dr. Sara is a distinguished cardiologist dedicated to advancing cardiovascular care. After graduating from SPHMMC, she completed her fellowship in interventional cardiology and has been instrumental in establishing modern cardiac care protocols.',
                'linkedin' => 'https://linkedin.com/in/saratekle',
                'research_gate' => 'https://researchgate.net/profile/Sara-Tekle',
                'publications' => 25,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Dr. Michael Bekele',
                'graduation_year' => 2018,
                'degree' => 'Doctor of Medicine',
                'specialty' => 'Pediatrics',
                'current_position' => 'Director',
                'workplace' => "Children's Hospital Ethiopia",
                'location' => 'Addis Ababa, Ethiopia',
                'email' => 'michael.bekele@sphmmc.edu.et',
                'phone' => '+251 911 234 567',
                'image' => 'https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=400&h=400&fit=crop&crop=face',
                'achievements' => [
                    'Established pediatric oncology unit',
                    'Reduced child mortality by 40%',
                    'Trained 100+ pediatric specialists',
                    'UNICEF pediatric health consultant'
                ],
                'awards' => ['Humanitarian Award 2023', 'Excellence in Pediatrics 2022'],
                'bio' => 'Dr. Michael specializes in pediatric emergency medicine and has been a pioneer in developing child-friendly emergency care systems in Ethiopia. His work has significantly improved pediatric emergency outcomes.',
                'linkedin' => 'https://linkedin.com/in/michaelbekele',
                'twitter' => 'https://twitter.com/drbekele',
                'publications' => 18,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Dr. Lena Tadesse',
                'graduation_year' => 2012,
                'degree' => 'Doctor of Medicine',
                'specialty' => 'Public Health',
                'current_position' => 'WHO Representative',
                'workplace' => 'World Health Organization',
                'location' => 'Nairobi, Kenya',
                'email' => 'lena.tadesse@sphmmc.edu.et',
                'phone' => '+254 712 345 678',
                'image' => 'https://images.unsplash.com/photo-1594824476967-48c8b964f137?w=400&h=400&fit=crop&crop=face',
                'achievements' => [
                    'Led malaria eradication initiatives',
                    'Established national vaccination program',
                    'Published 30+ public health papers',
                    'Advisor to Ministry of Health'
                ],
                'awards' => ['Global Health Leadership Award 2023', 'WHO Excellence Award 2021'],
                'bio' => 'Dr. Lena is a WHO Representative leading public health initiatives. Her work in establishing comprehensive vaccine campaigns has been recognized globally.',
                'linkedin' => 'https://linkedin.com/in/lenatadesse',
                'research_gate' => 'https://researchgate.net/profile/Lena-Tadesse',
                'publications' => 32,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Dr. Samuel Kassa',
                'graduation_year' => 2023,
                'degree' => 'Doctor of Medicine',
                'specialty' => 'Emergency Medicine',
                'current_position' => 'Resident',
                'workplace' => 'SPHMMC',
                'location' => 'Addis Ababa, Ethiopia',
                'email' => 'samuel.kassa@sphmmc.edu.et',
                'phone' => '+251 913 456 789',
                'image' => 'https://images.unsplash.com/photo-1582750433449-648ed127bb54b?w=400&h=400&fit=crop&crop=face',
                'achievements' => [
                    'Best Resident Award 2023',
                    'Published first research paper'
                ],
                'bio' => 'Dr. Samuel is an energetic resident doctor specializing in emergency response and critical care management at SPHMMC.',
                'publications' => 1,
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'name' => 'Dr. Hannah Girma',
                'graduation_year' => 2023,
                'degree' => 'Doctor of Medicine',
                'specialty' => 'Obstetrics & Gynecology',
                'current_position' => 'Medical Officer',
                'workplace' => 'Bahir Dar Hospital',
                'location' => 'Bahir Dar, Ethiopia',
                'email' => 'hannah.girma@sphmmc.edu.et',
                'phone' => '+251 914 567 890',
                'image' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=400&h=400&fit=crop&crop=face',
                'achievements' => [
                    'Established maternal health outreach',
                    'Reduced maternal complications'
                ],
                'bio' => 'Dr. Hannah is a dedicated medical officer improving reproductive and maternal health access in remote communities.',
                'publications' => 0,
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'name' => 'Dr. Daniel Tesfaye',
                'graduation_year' => 2022,
                'degree' => 'Doctor of Medicine',
                'specialty' => 'Internal Medicine',
                'current_position' => 'Fellow',
                'workplace' => 'Harvard Medical School',
                'location' => 'Boston, USA',
                'email' => 'daniel.tesfaye@sphmmc.edu.et',
                'phone' => '+1 617 123 4567',
                'image' => 'https://images.unsplash.com/photo-1556157382-97eda2d62296a?w=400&h=400&fit=crop&crop=face',
                'achievements' => [
                    'Harvard Medical Fellowship',
                    'Published 5 research papers'
                ],
                'bio' => 'Dr. Daniel is pursuing an advanced research fellowship at Harvard Medical School with focus on internal medicine subspecialties.',
                'linkedin' => 'https://linkedin.com/in/danieltsefaye',
                'research_gate' => 'https://researchgate.net/profile/Daniel-Tesfaye',
                'publications' => 5,
                'is_featured' => false,
                'is_active' => true,
            ]
        ];

        foreach ($alumniData as $alumnus) {
            Alumni::create($alumnus);
        }

        // Seed Alumni Events
        $eventData = [
            [
                'title' => 'Alumni Reunion 2026',
                'date' => 'July 15-17, 2026',
                'location' => 'SPHMMC Campus',
                'type' => 'Reunion',
                'description' => 'Join us for an exciting weekend of networking, learning, and celebration on campus.',
                'attendees' => '500+ expected',
                'is_active' => true,
            ],
            [
                'title' => 'Medical Innovation Summit',
                'date' => 'September 10, 2026',
                'location' => 'Virtual',
                'type' => 'Conference',
                'description' => 'Global summit on medical innovation, clinical trials, and healthcare technology.',
                'attendees' => '1000+ expected',
                'is_active' => true,
            ],
            [
                'title' => 'Homecoming Weekend',
                'date' => 'December 5-7, 2026',
                'location' => 'Addis Ababa',
                'type' => 'Social',
                'description' => 'Annual gathering with cultural events, hospital tours, and networking dinners.',
                'attendees' => '300+ expected',
                'is_active' => true,
            ],
            [
                'title' => 'Research Symposium',
                'date' => 'March 20, 2026',
                'location' => 'SPHMMC Assembly Hall',
                'type' => 'Academic',
                'description' => 'Showcase of alumni research, publications, and healthcare innovations.',
                'attendees' => '200+ expected',
                'is_active' => true,
            ]
        ];

        foreach ($eventData as $event) {
            AlumniEvent::create($event);
        }
    }
}
