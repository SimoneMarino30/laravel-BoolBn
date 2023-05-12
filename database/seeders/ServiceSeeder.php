<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [

            [
                "name" => "Wifi",
                "icon" => "fa-solid fa-wifi",
            ],
            [
                "name" => "Parcheggio",
                "icon" => "fa-solid fa-square-parking",
            ],
            [
                "name" => "Piscina",
                "icon" => "fa-solid fa-person-swimming",
            ],
            [
                "name" => "Portineria",
                "icon" => "fa-solid fa-bell-concierge",
            ],
            [
                "name" => "Sauna",
                "icon" => "fa-regular fa-spa",
            ],
            [
                "name" => "Vista mare",
                "icon" => "fa-solid fa-water",
            ],
            [
                "name" => "Tv",
                "icon" => "fa-solid fa-tv",
            ],
            [
                "name" => "Riscaldamento",
                "icon" => "fa-solid fa-temperature-low ",
            ],
            [
                "name" => "Ariacondizionata",
                "icon" => "fa-solid fa-fan",
            ],
            [
                "name" => "Bagno privato",
                "icon" => "fa-sharp fa-light fa-toilet",
            ],
            [
                "name" => "Colazione inclusa",
                "icon" => "fa-solid fa-mug-hot",
            ],
            [
                "name" => "Vista panoramica",
                "icon" => "fa-solid fa-mountain-sun",
            ],
            [
                "name" => "Cucina",
                "icon" => "fa-solid fa-fire-burner",
            ],
            [
                "name" => "Lavatrice",
                "icon" => "fa-solid fa-soap",
            ],
            [
                "name" => "Asciugacapelli",
                "icon" => "fa-solid fa-wind",
            ],
            [
                "name" => "Idromassaggio",
                "icon" => "fa-sharp fa-regular fa-arrows-spin",
            ],
            [
                "name" => "Domotica",
                "icon" => "fa-solid fa-robot",
            ],
            [
                "name" => "Griglia per barbecue",
                "icon" => "fa-solid fa-grill-hot",
            ],
            [
                "name" => "Giardino",
                "icon" => "fa-solid fa-tree",
            ],
            [
                "name" => "Culla",
                "icon" => "fa-solid fa-baby-carriage",
            ],
            [
                "name" => "Ferro da stiro",
                "icon" => "fa-solid fa-shirt",
            ],
            [
                "name" => "Set di cortesia",
                "icon" => "fa-solid fa-gift",
            ],
            [
                "name" => "Camino",
                "icon" => "fa-duotone fa-fireplace",
            ],
            [
                "name" => "Acessibilità",
                "icon" => "fa-solid fa-wheelchair-move",
            ],

        ];
        
        foreach ($services as $service) {
            Service::create($service);
        }
    }
}