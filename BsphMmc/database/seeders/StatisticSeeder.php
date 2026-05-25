<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Statistic;

class StatisticSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Statistic::create([
            'title' => 'Medical Service Areas',
            'value' => '30+',
            'description' => 'High Quality, standardized clinical services',
        ]);

        Statistic::create([
            'title' => 'enrolled students',
            'value' => '2000+',
            'description' => 'Currently, there are more than 2000 enrolled students doing their undergraduate, graduate, and postgraduate studies.',
        ]);

        Statistic::create([
            'title' => 'Service Coverage',
            'value' => '75%',
            'description' => 'Serving over 75% of the nation\'s rural community. Average of 1000 Deliveries per month',
        ]);

        Statistic::create([
            'title' => 'Academic staff',
            'value' => '800',
            'description' => 'The college is expanding its academic programs in order to provide an excellent medical education. We have over 800 academic staff members who work tirelessly to provide the best service to our students.',
        ]);

        Statistic::create([
            'title' => 'Operating Theaters',
            'value' => '25',
            'description' => 'Our hospital has doubled its operating room tables, performed twice as many procedures, and reduced the backlog in the last three years.',
        ]);

        Statistic::create([
            'title' => 'Annual Patient Flow',
            'value' => '620,000+',
            'description' => 'With an ever-expanding service capacity, our institution has been delivering service to more than half a million customers coming from all four corners of the country seeking for specialized high quality and affordable clinical care',
        ]);

        Statistic::create([
            'title' => 'Emergency Services given in 2017',
            'value' => '80,000+',
            'description' => 'Our hospital is the country\'s largest referral hospital for emergency cases.it has its own trauma center called AaBET/ Addis Ababa Burn Emergency and Trauma Hospital/SPHMMC',
        ]);

        Statistic::create([
            'title' => 'Permanent and Part-time employees',
            'value' => '4850+',
            'description' => 'Diversified and Competent Human Capital',
        ]);
    }
}
