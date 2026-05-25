<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LatestPost;

class LatestPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data
        LatestPost::query()->delete();

        // Create sample news posts
        LatestPost::create([
            'title' => 'SPHMMC Achieves Global Excellence Ranking in Medical Research',
            'slug' => 'sphmmc-achieves-global-excellence-ranking-' . time(),
            'content' => 'In a groundbreaking assessment, St. Paul\'s Hospital Millennium Medical College has been recognized as one of the top research institutions in East Africa for its contributions to global health and infectious disease studies.',
            'type' => 'news',
            'featured_image' => 'https://images.unsplash.com/photo-1576091160550-217359f42f8c?auto=format&fit=crop&q=80&w=2070',
            'author' => 'Public Relations Office',
            'status' => 'published',
        ]);

        LatestPost::create([
            'title' => 'New State-of-the-Art Oncology Department Inauguration',
            'slug' => 'new-state-of-the-art-oncology-department-inauguration-' . time(),
            'content' => 'The college is proud to announce the opening of its latest oncology wing, equipped with next-generation radiotherapy machines and patient-centric specialized care units.',
            'type' => 'news',
            'featured_image' => 'https://images.unsplash.com/photo-1576091160550-217359f42f8c?auto=format&fit=crop&q=80&w=2070',
            'author' => 'Public Relations Office',
            'status' => 'published',
        ]);

        // Create sample announcements
        LatestPost::create([
            'title' => 'Holiday Notice: Victory of Adwa Celebration',
            'slug' => 'holiday-notice-victory-of-adwa-celebration-' . time(),
            'content' => 'The college will be closed on March 2nd in observance of the Victory of Adwa. Essential medical services will remain operational.',
            'type' => 'announcement',
            'author' => 'Administration Office',
            'status' => 'published',
        ]);

        LatestPost::create([
            'title' => 'Revised Policy on Clinical Staff Shift Handover',
            'slug' => 'revised-policy-on-clinical-staff-shift-handover-' . time(),
            'content' => 'In order to improve patient safety, new mandatory shift handover protocols will be enforced starting next Monday.',
            'type' => 'announcement',
            'author' => 'Administration Office',
            'status' => 'published',
        ]);

        // Create sample events
        LatestPost::create([
            'title' => '2026 Annual Medical Graduation Ceremony',
            'slug' => '2026-annual-medical-graduation-ceremony-' . time(),
            'content' => 'Celebrating the achievements of our latest medical and healthcare professionals in a grand ceremony at the Main Hall.',
            'type' => 'event',
            'featured_image' => 'https://images.unsplash.com/photo-1541339907198-e08756ebafe3?auto=format&fit=crop&q=80&w=2070',
            'event_date' => now()->addDays(90)->format('Y-m-d'),
            'author' => 'Student Affairs Office',
            'status' => 'published',
        ]);

        LatestPost::create([
            'title' => 'Workshop: Clinical Research Methods',
            'slug' => 'workshop-clinical-research-methods-' . time(),
            'content' => 'Focused training for postgraduate students on modern clinical research methodologies and data analysis.',
            'type' => 'event',
            'featured_image' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&q=80&w=2070',
            'event_date' => now()->addDays(30)->format('Y-m-d'),
            'author' => 'Research Office',
            'status' => 'published',
        ]);

        // Create sample document
        LatestPost::create([
            'title' => 'SPHMMC Annual Report 2025',
            'slug' => 'sphmmc-annual-report-2025-' . time(),
            'content' => 'Comprehensive annual report covering all achievements, research outputs, and institutional developments for the year 2025.',
            'type' => 'document',
            'file_path' => '/documents/annual-report-2025.pdf',
            'author' => 'Planning Office',
            'status' => 'published',
        ]);
    }
}
