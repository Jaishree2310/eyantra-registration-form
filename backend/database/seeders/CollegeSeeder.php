<?php
namespace Database\Seeders;

use App\Models\College;
use App\Models\Country;
use Illuminate\Database\Seeder;

class CollegeSeeder extends Seeder
{
    public function run(): void
    {
        $india = Country::where('code', 'IN')->first();
        $us = Country::where('code', 'US')->first();
        $uk = Country::where('code', 'GB')->first();

        if (!$india || !$us || !$uk) {
            $this->command->info('Please run CountrySeeder first!');
            return;
        }

        $colleges = [
            // India colleges
            [
                'name' => 'Indian Institute of Technology Bombay',
                'country_id' => $india->id,
                'city' => 'Mumbai',
                'state' => 'Maharashtra'
            ],
            [
                'name' => 'Indian Institute of Technology Delhi',
                'country_id' => $india->id,
                'city' => 'New Delhi',
                'state' => 'Delhi'
            ],
            [
                'name' => 'Indian Institute of Technology Madras',
                'country_id' => $india->id,
                'city' => 'Chennai',
                'state' => 'Tamil Nadu'
            ],
            [
                'name' => 'Indian Institute of Technology Kanpur',
                'country_id' => $india->id,
                'city' => 'Kanpur',
                'state' => 'Uttar Pradesh'
            ],
            [
                'name' => 'Indian Institute of Technology Kharagpur',
                'country_id' => $india->id,
                'city' => 'Kharagpur',
                'state' => 'West Bengal'
            ],
            
            // US colleges
            [
                'name' => 'Massachusetts Institute of Technology',
                'country_id' => $us->id,
                'city' => 'Cambridge',
                'state' => 'Massachusetts'
            ],
            [
                'name' => 'Stanford University',
                'country_id' => $us->id,
                'city' => 'Stanford',
                'state' => 'California'
            ],
            [
                'name' => 'California Institute of Technology',
                'country_id' => $us->id,
                'city' => 'Pasadena',
                'state' => 'California'
            ],
            
            // UK colleges
            [
                'name' => 'University of Cambridge',
                'country_id' => $uk->id,
                'city' => 'Cambridge',
                'state' => 'Cambridgeshire'
            ],
            [
                'name' => 'University of Oxford',
                'country_id' => $uk->id,
                'city' => 'Oxford',
                'state' => 'Oxfordshire'
            ],
        ];

        foreach ($colleges as $college) {
            College::updateOrCreate(
                [
                    'name' => $college['name'],
                    'country_id' => $college['country_id']
                ],
                [
                    'city' => $college['city'],
                    'state' => $college['state']
                ]
            );
        }
    }
}