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
                'title' => 'Serengeti Migration Safari',
                'description' => 'Witness the incredible Great Migration across the Serengeti plains. Watch millions of wildebeest and zebras make their annual journey while spotting Africa\'s big cats in action.',
                'price' => 2499.99,
                'duration' => 6,
                'location' => 'Serengeti National Park, Tanzania',
                'difficulty_level' => 'moderate',
                'is_featured' => true,
                'active' => true,
                'max_people' => 8,
                'image_type' => 'custom',
                'included_services' => json_encode([
                    'Professional safari guide',
                    'Luxury lodge accommodation',
                    'All meals and drinks',
                    'Game drive vehicles',
                    'Park entrance fees',
                    'Airport transfers'
                ]),
                'excluded_services' => json_encode([
                    'International flights',
                    'Travel insurance',
                    'Personal expenses',
                    'Gratuities'
                ]),
                'itinerary' => json_encode([
                    'Day 1: Arrival and welcome briefing',
                    'Day 2-3: Serengeti Central game drives',
                    'Day 4-5: Northern Serengeti and Migration',
                    'Day 6: Departure day'
                ])
            ],
            [
                'title' => 'Kilimanjaro Machame Route',
                'description' => 'Climb Africa\'s highest peak via the scenic Machame Route. Experience diverse landscapes from rainforest to arctic conditions at the summit.',
                'price' => 3299.99,
                'duration' => 7,
                'location' => 'Mount Kilimanjaro, Tanzania',
                'difficulty_level' => 'challenging',
                'is_featured' => true,
                'active' => true,
                'max_people' => 12,
                'image_type' => 'custom',
                'included_services' => json_encode([
                    'Professional mountain guides',
                    'Camping equipment',
                    'All meals on mountain',
                    'Park fees',
                    'Emergency oxygen',
                    'Airport transfers'
                ]),
                'excluded_services' => json_encode([
                    'Personal climbing gear',
                    'Travel insurance',
                    'Tips for guides',
                    'Personal expenses'
                ]),
                'itinerary' => json_encode([
                    'Day 1: Machame Gate to Machame Camp',
                    'Day 2: Machame Camp to Shira Camp',
                    'Day 3: Shira Camp to Lava Tower to Barranco Camp',
                    'Day 4: Barranco Camp to Karanga Camp',
                    'Day 5: Karanga Camp to Barafu Camp',
                    'Day 6: Summit Day - Uhuru Peak',
                    'Day 7: Descent to Mweka Gate'
                ])
            ],
            [
                'title' => 'Zanzibar Beach & Culture',
                'description' => 'Explore the pristine beaches and rich culture of Zanzibar. Visit historic Stone Town, spice plantations, and relax on white sandy beaches.',
                'price' => 1799.99,
                'duration' => 5,
                'location' => 'Zanzibar, Tanzania',
                'difficulty_level' => 'easy',
                'is_featured' => true,
                'active' => true,
                'max_people' => 15,
                'image_type' => 'custom',
                'included_services' => json_encode([
                    'Luxury beach resort stay',
                    'Stone Town tour',
                    'Spice plantation visit',
                    'Sunset dhow cruise',
                    'All breakfasts and dinners',
                    'Airport transfers'
                ]),
                'excluded_services' => json_encode([
                    'International flights',
                    'Travel insurance',
                    'Personal expenses',
                    'Some lunches'
                ]),
                'itinerary' => json_encode([
                    'Day 1: Arrival and Stone Town tour',
                    'Day 2: Spice plantation and beach resort check-in',
                    'Day 3: Beach activities and water sports',
                    'Day 4: Sunset dhow cruise',
                    'Day 5: Departure day'
                ])
            ],
            [
                'title' => 'Ngorongoro Crater Safari',
                'description' => 'Explore the world\'s largest intact volcanic caldera, home to a dense population of African wildlife including the rare black rhino.',
                'price' => 1999.99,
                'duration' => 4,
                'location' => 'Ngorongoro Conservation Area, Tanzania',
                'difficulty_level' => 'easy',
                'is_featured' => true,
                'active' => true,
                'max_people' => 6,
                'image_type' => 'custom',
                'included_services' => json_encode([
                    'Professional guide',
                    'Luxury lodge accommodation',
                    'All meals',
                    '4x4 safari vehicle',
                    'Park fees',
                    'Airport transfers'
                ]),
                'excluded_services' => json_encode([
                    'International flights',
                    'Travel insurance',
                    'Personal expenses',
                    'Gratuities'
                ]),
                'itinerary' => json_encode([
                    'Day 1: Arrival and transfer to lodge',
                    'Day 2: Full day crater tour',
                    'Day 3: Maasai village visit and wildlife viewing',
                    'Day 4: Final game drive and departure'
                ])
            ],
            [
                'title' => 'Tarangire & Lake Manyara Safari',
                'description' => 'Combine two of Tanzania\'s most unique parks. See massive elephant herds in Tarangire and tree-climbing lions in Lake Manyara.',
                'price' => 1699.99,
                'duration' => 3,
                'location' => 'Tarangire & Lake Manyara, Tanzania',
                'difficulty_level' => 'easy',
                'is_featured' => true,
                'active' => true,
                'max_people' => 8,
                'image_type' => 'custom',
                'included_services' => json_encode([
                    'Expert wildlife guide',
                    'Tented camp accommodation',
                    'All meals',
                    'Game drives',
                    'Park entrance fees',
                    'Transport'
                ]),
                'excluded_services' => json_encode([
                    'Flights',
                    'Travel insurance',
                    'Personal items',
                    'Tips'
                ]),
                'itinerary' => json_encode([
                    'Day 1: Tarangire National Park game drives',
                    'Day 2: Lake Manyara National Park exploration',
                    'Day 3: Morning game drive and departure'
                ])
            ]
        ];

        foreach ($tours as $tour) {
            Tour::create([
                ...$tour,
                'slug' => Str::slug($tour['title']),
            ]);
        }
    }
}
