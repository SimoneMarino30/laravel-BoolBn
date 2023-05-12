<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\ApartmentSponsor;
use App\Models\Sponsor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApartmentSponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $sponsors = Sponsor::all()->pluck('id');

        $apartmentSponsors = [
            [
                'apartment_id' => '1',
                'sponsor_id' => '3',
                'starting_date' => '2023-05-01',
                'expiring_date' => '2023-05-03',
            ],

            [
                'apartment_id' => '2',
                'sponsor_id' => '3',
                'starting_date' => '2023-05-01',
                'expiring_date' => '2023-05-03',
            ],

            [
                'apartment_id' => '3',
                'sponsor_id' => '3',
                'starting_date' => '2023-05-01',
                'expiring_date' => '2023-05-03',
            ],

            [
                'apartment_id' => '4',
                'sponsor_id' => '3',
                'starting_date' => '2023-05-01',
                'expiring_date' => '2023-05-03',
            ],

            [
                'apartment_id' => '5',
                'sponsor_id' => '3',
                'starting_date' => '2023-05-01',
                'expiring_date' => '2023-05-03',
            ],
        ];
    }
}
