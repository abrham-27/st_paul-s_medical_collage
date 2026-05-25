<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatisticsDataSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('statistics')->truncate();

        DB::table('statistics')->insert([
            [
                'title'       => 'Medical Service Areas',
                'value'       => '30+',
                'description' => 'High quality, standardized clinical services across 30+ medical service areas.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'title'       => 'Enrolled Students',
                'value'       => '2000+',
                'description' => 'Currently more than 2000 enrolled students doing undergraduate, graduate, and postgraduate studies.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'title'       => 'Service Coverage',
                'value'       => '75%',
                'description' => 'Serving over 75% of the nation\'s rural community. Average of 1000 deliveries per month.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'title'       => 'Academic Staff',
                'value'       => '800',
                'description' => 'Over 800 academic staff members who work tirelessly to provide the best service to students.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'title'       => 'Operating Theaters',
                'value'       => '25',
                'description' => 'Our hospital has doubled its operating room tables, performed twice as many procedures, and reduced the backlog in the last three years.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'title'       => 'Annual Patient Flow',
                'value'       => '620,000+',
                'description' => 'Delivering service to more than half a million customers from all four corners of the country seeking specialized high quality and affordable clinical care.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'title'       => 'Emergency Services',
                'value'       => '80,000+',
                'description' => 'Our hospital is the country\'s largest referral hospital for emergency cases. It has its own trauma center called Addis Ababa Burn Emergency and Trauma Hospital/SPHMMC.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'title'       => 'Permanent & Part-time Employees',
                'value'       => '4850+',
                'description' => 'Diversified and competent human capital with 4850+ permanent and part-time employees.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}
