<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Message;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $apartments = Apartment::all();

        for ($i = 1; $i <= count($apartments); $i++) {

            $message = new Message();

            $message->apartment_id = $i;
            $message->name = "Cliente";
            $message->surname = "Interessato";
            $message->email = "client@mail.it";
            $message->text = "Ciao! Sono molto interessato al tuo appartamento vacanza su Airbnb. Le foto dell'annuncio sono meravigliose e sembra proprio il luogo perfetto per trascorrere una vacanza rilassante. Mi piace molto la posizione centrale e la vicinanza a tutti i servizi, come negozi e ristoranti. 
            Mi piacerebbe avere maggiori informazioni riguardo alla disponibilità e ai prezzi per le date che ho in mente. Inoltre, sarei grato se potessi fornirmi maggiori dettagli riguardo alle caratteristiche dell'appartamento, come il numero di camere da letto, i servizi inclusi e la disposizione degli spazi.";

            $message->save();

       }
    }
}