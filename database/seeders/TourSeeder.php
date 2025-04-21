<?php

namespace Database\Seeders;

use App\Models\Tour;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TourSeeder extends Seeder
{
    public function run(): void
    {
        $tours = [
            [
                'title' => 'Mountain Adventure Trek',
                'description' => 'Experience the thrill of mountain climbing with our expert guides. This trek offers breathtaking views and challenging terrain perfect for adventure seekers.',
                'price' => 299.99,
                'duration' => 3,
                'location' => 'Rocky Mountains, Colorado',
                'difficulty_level' => 'challenging',
                'is_featured' => true,
                'max_people' => 12,
                'image_type' => 'custom',
                'included_services' => json_encode([
                    'Professional mountain guides',
                    'All necessary equipment',
                    'Accommodation',
                    'Meals',
                    'Transportation'
                ]),
                'excluded_services' => json_encode([
                    'Personal gear',
                    'Travel insurance',
                    'Personal expenses'
                ]),
                'itinerary' => json_encode([
                    'Day 1: Base camp arrival and orientation',
                    'Day 2: Summit climb',
                    'Day 3: Descent and celebration'
                ])
            ],
            [
                'title' => 'Coastal Paradise Tour',
                'description' => 'Explore the beautiful coastline with this relaxing tour. Perfect for nature lovers and photography enthusiasts.',
                'price' => 199.99,
                'duration' => 2,
                'location' => 'Pacific Coast, California',
                'difficulty_level' => 'easy',
                'is_featured' => true,
                'max_people' => 15,
                'image_type' => 'custom',
                'included_services' => json_encode([
                    'Expert guide',
                    'Transportation',
                    'Snacks and refreshments',
                    'Photography tips'
                ]),
                'excluded_services' => json_encode([
                    'Camera equipment',
                    'Personal expenses',
                    'Travel insurance'
                ]),
                'itinerary' => json_encode([
                    'Day 1: Coastal exploration and beach activities',
                    'Day 2: Marine life watching and sunset farewell'
                ])
            ],
            [
                'title' => 'Desert Safari Experience',
                'description' => 'Journey through the magnificent desert landscape. Experience the magic of sand dunes and starlit nights.',
                'price' => 249.99,
                'duration' => 2,
                'location' => 'Mojave Desert, Nevada',
                'difficulty_level' => 'moderate',
                'is_featured' => false,
                'max_people' => 10,
                'image_type' => 'custom',
                'included_services' => json_encode([
                    '4x4 desert adventure',
                    'Camel riding',
                    'Bedouin camp experience',
                    'Meals and refreshments'
                ]),
                'excluded_services' => json_encode([
                    'Personal gear',
                    'Travel insurance',
                    'Personal expenses'
                ]),
                'itinerary' => json_encode([
                    'Day 1: Desert exploration and sunset camel ride',
                    'Day 2: Morning safari and return'
                ])
            ],
        ];

        foreach ($tours as $tour) {
            Tour::create([
                ...$tour,
                'slug' => Str::slug($tour['title']),
            ]);
        }
    }
}
