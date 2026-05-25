<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MissionVision;
use App\Models\CoreValue;
use App\Models\AboutPage;

class MissionVisionSeeder extends Seeder
{
    public function run(): void
    {
        // About page
        AboutPage::updateOrCreate([], [
            'page_title'       => 'About SPHMMC',
            'subtitle'         => 'Excellence in Healthcare & Education',
            'main_description' => "Welcome to St. Paul's Hospital Millennium Medical College (SPHMMC), a beacon of hope and innovation in healthcare and medical education in Ethiopia. Established to meet the nation's growing demand for skilled medical professionals and advanced healthcare, SPHMMC is now a cornerstone of excellence in education, research, and specialized clinical services.",
            'history_text'     => "From its origins as a referral hospital to its status as a premier teaching institution, SPHMMC embodies resilience and progress. Equipped with the latest medical technologies, we address Ethiopia's most complex healthcare challenges.",
            'seo_title'        => 'About SPHMMC - St. Paul\'s Hospital Millennium Medical College',
            'seo_description'  => 'Learn about SPHMMC - Ethiopia\'s leading medical college and hospital providing excellence in healthcare, education, and research.',
        ]);

        // Mission
        MissionVision::updateOrCreate(['type' => 'mission'], [
            'title'       => 'Our Mission',
            'description' => "To provide quality and affordable curative, rehabilitative, preventive, and promotive healthcare services and train competent, compassionate and ethical health professionals using integrated and quality medical education, and to perform need-based research.",
        ]);

        // Vision
        MissionVision::updateOrCreate(['type' => 'vision'], [
            'title'       => 'Our Vision',
            'description' => "To be a sought-after medical center and a prestigious academic and research center in Africa by 2030 G.C.",
        ]);

        // Core Values
        $values = [
            ['title' => 'Collaboration', 'icon' => '🤝', 'description' => 'Cultivate relationships built on trust and respect. Recognize and value the skills and qualities of others.', 'sort_order' => 1],
            ['title' => 'Creativity',    'icon' => '💡', 'description' => 'Encourage and support innovation, ingenuity, and resourcefulness. Apply new ideas and technology to improve education, research, and clinical practice.', 'sort_order' => 2],
            ['title' => 'Diversity',     'icon' => '🌍', 'description' => 'Recognize the value of different perspectives and backgrounds. Foster cultural awareness and empathy.', 'sort_order' => 3],
            ['title' => 'Excellence',    'icon' => '🏆', 'description' => 'Achieve the highest standards of performance and outcomes in education, research, service, and clinical practice.', 'sort_order' => 4],
            ['title' => 'Integrity',     'icon' => '⚖️', 'description' => 'Adhere to the standards of conduct, policies, and procedures of the organization. Demonstrate honesty and transparency.', 'sort_order' => 5],
        ];

        foreach ($values as $v) {
            CoreValue::updateOrCreate(['title' => $v['title']], $v);
        }

        $this->command->info('✅ Mission, Vision & Values seeded');
    }
}
