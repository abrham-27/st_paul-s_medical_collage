<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gallery;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Gallery::query()->delete();

        $items = [
            [
                'title' => 'Modern Surgical Suite',
                'image' => 'https://images.unsplash.com/photo-1580281657521-99468f65286d?auto=format&fit=crop&q=80&w=1200',
                'category' => 'Hospital',
                'sort_order' => 0,
            ],
            [
                'title' => 'Medical Training Session',
                'image' => 'https://images.unsplash.com/photo-1580281658621-41d9760dd17d?auto=format&fit=crop&q=80&w=1200',
                'category' => 'Education',
                'sort_order' => 1,
            ],
            [
                'title' => 'Community Health Outreach',
                'image' => 'https://images.unsplash.com/photo-1526256262350-7da7584cf5eb?auto=format&fit=crop&q=80&w=1200',
                'category' => 'Community',
                'sort_order' => 2,
            ],
            [
                'title' => 'Research Laboratory',
                'image' => 'https://images.unsplash.com/photo-1581094278477-3ec525c34f56?auto=format&fit=crop&q=80&w=1200',
                'category' => 'Research',
                'sort_order' => 3,
            ],
            [
                'title' => 'Annual Graduation Ceremony',
                'image' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&q=80&w=1200',
                'category' => 'Events',
                'sort_order' => 4,
            ],
            [
                'title' => 'Patient Care Facility',
                'image' => 'https://images.unsplash.com/photo-1580281657516-ba70b9f61e84?auto=format&fit=crop&q=80&w=1200',
                'category' => 'Hospital',
                'sort_order' => 5,
            ],
        ];

        foreach ($items as $item) {
            Gallery::create($item);
        }
    }
}
