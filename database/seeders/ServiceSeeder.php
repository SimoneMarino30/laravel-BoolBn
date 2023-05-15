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
                "icon" => "fa-solid fa-spa",
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
                "icon" => "fa-solid fa-toilet",
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
                "icon" => "fa-solid fa-hot-tub-person",
            ],
            [
                "name" => "Domotica",
                "icon" => "fa-solid fa-robot",
            ],
            [
                "name" => "Barbeque",
                "icon" => "fa-solid fa-stroopwafel",
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
                "icon" => "fa-solid fa-spray-can-sparkles",
            ],
            [
                "name" => "Camino",
                "icon" => "fa-solid fa-fire"
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