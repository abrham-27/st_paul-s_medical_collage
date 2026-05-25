<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutPageSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('about_pages')->truncate();

        DB::table('about_pages')->insert([
            'page_title'         => 'About SPHMMC',
            'subtitle'           => 'Excellence in Healthcare & Education',
            'main_description'   => "<p>Welcome to <strong>St. Paul's Hospital Millennium Medical College (SPHMMC)</strong>, a beacon of hope and innovation in healthcare and medical education in Ethiopia.</p><p>Founded in 2007 under the Ethiopian Federal Ministry of Health, SPHMMC has grown into one of the nation's premier academic medical centers. We are committed to training the next generation of healthcare professionals while delivering world-class clinical services to the people of Ethiopia.</p><p>Our institution combines cutting-edge research, compassionate patient care, and rigorous academic programs to address the evolving healthcare needs of our nation and the broader African continent.</p>",
            'history_text'       => 'At SPHMMC, we are not just shaping the future of healthcare in Ethiopia; we are setting a benchmark for excellence and equity. Join us as a student, partner, or supporter in our journey to transform lives and inspire change.',
            'additional_content' => json_encode([
                'why_items' => [
                    ['title' => 'Unparalleled History',        'desc' => "From its origins as a referral hospital to its status as a premier teaching institution, SPHMMC embodies resilience and progress."],
                    ['title' => 'Advanced Facilities',         'desc' => "Equipped with the latest medical technologies, we address Ethiopia's most complex healthcare challenges."],
                    ['title' => 'Impactful Research',          'desc' => 'Focused on community needs, our research drives innovation and shapes policy.'],
                    ['title' => 'Community-Centered Approach', 'desc' => 'Our outreach programs ensure equitable healthcare access, particularly for underserved populations.'],
                ],
                'specialized_centers' => [
                    ['title' => 'Transplant Surgery',  'desc' => "Home to Ethiopia's first and leading organ transplant center, performing life-saving kidney and liver transplants.", 'icon' => '🫀'],
                    ['title' => 'Cardiac Center',      'desc' => 'Advanced cardiovascular care with state-of-the-art diagnostic and interventional services.',                        'icon' => '❤️'],
                    ['title' => 'Oncology Services',   'desc' => 'Comprehensive cancer care, including radiotherapy and chemotherapy with a focus on patient-centered outcomes.',       'icon' => '🎗️'],
                    ['title' => 'Trauma & Emergency',  'desc' => 'A high-capacity trauma center providing 24/7 critical care to the most vulnerable patients.',                        'icon' => '🚑'],
                ],
            ]),
            'featured_image'     => null,
            'seo_title'          => 'About SPHMMC — St. Paul\'s Hospital Millennium Medical College',
            'seo_description'    => 'Learn about SPHMMC, Ethiopia\'s premier academic medical center dedicated to excellence in healthcare education, research, and clinical services.',
            'created_at'         => now(),
            'updated_at'         => now(),
        ]);
    }
}
