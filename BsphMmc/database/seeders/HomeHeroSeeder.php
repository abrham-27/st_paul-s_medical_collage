<?php

namespace Database\Seeders;

use App\Models\HomeHero;
use Illuminate\Database\Seeder;

class HomeHeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $heroSlides = [
            [
                'title' => 'Welcome to SPHMMC',
                'subtitle' => 'Excellence in Medical Education and Healthcare',
                'description' => 'Leading institution dedicated to advancing medical education, healthcare services, and research.',
                'button_text' => 'Learn More',
                'button_link' => '/about',
                'display_order' => 0,
                'status' => true,
            ],
            [
                'title' => 'Serving Our Community',
                'subtitle' => 'Community Impact',
                'description' => 'From free health screenings to outreach programs, SPHMMC is committed to improving public health across Ethiopia.',
                'button_text' => 'Health Tips',
                'button_link' => '/health-tips',
                'display_order' => 1,
                'status' => true,
            ],
            [
                'title' => 'World-Class Education',
                'subtitle' => 'Academic Excellence',
                'description' => 'Our schools provide comprehensive medical, nursing, and public health education with modern facilities and expert faculty.',
                'button_text' => 'View Programs',
                'button_link' => '/academics',
                'display_order' => 2,
                'status' => true,
            ],
            [
                'title' => 'Cutting-Edge Research',
                'subtitle' => 'Innovation & Discovery',
                'description' => 'Advancing medical science through rigorous research projects and collaborations with international institutions.',
                'button_text' => 'Explore Research',
                'button_link' => '/research',
                'display_order' => 3,
                'status' => true,
            ],
            [
                'title' => 'Professional Healthcare',
                'subtitle' => 'Patient Care',
                'description' => 'State-of-the-art medical facilities and compassionate healthcare professionals dedicated to your wellbeing.',
                'button_text' => 'Our Services',
                'button_link' => '/services',
                'display_order' => 4,
                'status' => true,
            ],
        ];

        foreach ($heroSlides as $slide) {
            HomeHero::create($slide);
        }
    }
}
