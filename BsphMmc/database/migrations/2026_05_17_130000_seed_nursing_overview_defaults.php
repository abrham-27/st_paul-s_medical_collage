<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $content = json_encode([
            'hero_subtitle' => 'Excellence in Nursing Education Since 2012',
            'timeline' => [
                [
                    'year' => '2007',
                    'title' => 'Foundation',
                    'description' => "Saint Paul's Hospital Millennium Medical College was opened and became a higher education institution under Ethiopian Federal Ministry of Health (EFMOH).",
                ],
                [
                    'year' => '2012',
                    'title' => 'Nursing Education Directorate',
                    'description' => 'Started with two specialty Nursing Programs: Operating Theatre Nursing and Emergency and Critical Care Nursing.',
                ],
                [
                    'year' => '2022',
                    'title' => 'School of Nursing',
                    'description' => "Nursing Education Directorate was scaled up to School of Nursing (SoN) by College's Senate pronouncement.",
                ],
            ],
            'about_text' => null,
        ]);

        $exists = DB::table('academic_pages')
            ->where('school_type', 'nursing')
            ->where('page_type', 'overview')
            ->exists();

        if ($exists) {
            DB::table('academic_pages')
                ->where('school_type', 'nursing')
                ->where('page_type', 'overview')
                ->update([
                    'title' => 'About School of Nursing',
                    'content' => $content,
                    'secondary_title' => 'Our Mission',
                    'secondary_content' => 'To provide exceptional nursing education that produces highly competent, compassionate, and innovative healthcare professionals who can address the evolving healthcare needs of Ethiopia and beyond through excellence in teaching, research, and community service.',
                    'tertiary_title' => 'Our Vision',
                    'tertiary_content' => 'To be a premier center of excellence in nursing education, research, and practice that produces transformative leaders who advance healthcare delivery, improve patient outcomes, and shape the future of nursing in Ethiopia and across Africa.',
                    'updated_at' => now(),
                ]);
        } else {
            DB::table('academic_pages')->insert([
                'school_type' => 'nursing',
                'page_type' => 'overview',
                'title' => 'About School of Nursing',
                'content' => $content,
                'secondary_title' => 'Our Mission',
                'secondary_content' => 'To provide exceptional nursing education that produces highly competent, compassionate, and innovative healthcare professionals who can address the evolving healthcare needs of Ethiopia and beyond through excellence in teaching, research, and community service.',
                'tertiary_title' => 'Our Vision',
                'tertiary_content' => 'To be a premier center of excellence in nursing education, research, and practice that produces transformative leaders who advance healthcare delivery, improve patient outcomes, and shape the future of nursing in Ethiopia and across Africa.',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        // Keep data on rollback.
    }
};
