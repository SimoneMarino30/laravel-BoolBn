<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\ApartmentSponsor;
use App\Models\Sponsor;

use Faker\Generator as Faker;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApartmentSponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $apartments_sponsored = [
            [
                "apartment_id" => "1",
                "sponsor_id" => "2",
                "starting_date" => date("Y-m-d H:i:s"),
                "expiring_date" => "2023-05-25",
            ],
            [
                "apartment_id" => "10",
                "sponsor_id" => "3",
                "starting_date" => date("Y-m-d H:i:s"),
                "expiring_date" => "2023-05-28",
            ],
            [
                "apartment_id" => "4",
                "sponsor_id" => "3",
                "starting_date" => date("Y-m-d H:i:s"),
                "expiring_date" => "2023-05-28",
            ],
            [
                "apartment_id" => "14",
                "sponsor_id" => "1",
                "starting_date" => date("Y-m-d H:i:s"),
                "expiring_date" => "2023-05-23",
            ],
        ];

        foreach($apartments_sponsored as $key => $apartment) {
            ApartmentSponsor::create($apartment);
        }

    }
}