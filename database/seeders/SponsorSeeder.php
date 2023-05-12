<?php

namespace Database\Seeders;

use App\Models\Sponsor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsors =
            [
                [
                    "type" => "Silver",
                    "price" => 2.99,
                    "duration" => 24,
                    "description" => "Ottieni accesso completo alle funzionalità avanzate del nostro servizio di sponsorizzazione a soli 2,99 euro per 24 ore!",
                ],

                [
                    "type" => "Gold",
                    "price" => 5.99,
                    "duration" => 72,
                    "description" => "Ottieni accesso completo alle funzionalità avanzate del nostro servizio di sponsorizzazione a soli 5,99 euro per 72 ore!",
                ],

                [
                    "type" => "Platinum",
                    "price" => 9.99,
                    "duration" => 144,
                    "description" => "Ottieni accesso completo alle funzionalità avanzate del nostro servizio di sponsorizzazione a soli 9,99 euro per 144 ore!",
                ],
            ];


        foreach ($sponsors as $sponsor) {
            Sponsor::create($sponsor);
        }
    }
}
