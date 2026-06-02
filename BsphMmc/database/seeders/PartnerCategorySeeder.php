<?php

namespace Database\Seeders;

use App\Models\PartnerCategory;
use Illuminate\Database\Seeder;

class PartnerCategorySeeder extends Seeder
{
    public function run()
    {
        PartnerCategory::firstOrCreate(
            ['slug' => 'local'],
            ['name' => 'Local Partners']
        );

        PartnerCategory::firstOrCreate(
            ['slug' => 'external'],
            ['name' => 'External / International Partners']
        );
    }
}
