<?php

namespace Database\Seeders;

use App\Models\Apartment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apartments = [
            //1a
            [
                "user_id" => "1",
                "title" => "La Chiocciola",
                "description" => "Appartamento spazioso e luminoso, decorato con un elegante stile moderno. Goditi la tua colazione sulla terrazza privata con vista sulla città.",
                "rooms" => "2",
                "beds" => "3",
                "bathrooms" => "1",
                "mq" => "60",
                "address" => "via dei Fori Imperiali, 1, 00186, Roma, RM",
                "latitude" => "41.894939",
                "longitude" => "12.484137",
                "price" => 150.00,
                "image" => "",
                "visibility" => "1",
            ],
            //5c
            [
                "user_id"=> "1",
                "title"=> "Casa Mira Mare",
                "description"=> "Appartamento vista mare, situato in una tranquilla zona residenziale a pochi passi dalla spiaggia. Confortevole e arredato in stile marino, è l'ideale per le tue vacanze al mare.",
                "rooms"=> "5",
                "beds"=> "7",
                "bathrooms"=> "2",
                "mq"=> "120",
                "address"=> "via Tuscolana, 300, 00186, Roma, RM",
                "latitude"=> "41.876075",
                "longitude"=> "12.526703",
                "price"=> 300.00,
                "image"=> "", 
                "visibility"=> "1",
            ],
            //3c
            [
                "user_id" => "1",
                "title" => "Attico degli Artisti",
                "description" => "Questo appartamento è stato ristrutturato e arredato da un famoso artista. È spazioso e luminoso, con soffitti alti e dettagli artistici unici. Goditi la vista panoramica sulla città dalla terrazza privata.",
                "rooms" => "2",
                "beds" => "2",
                "bathrooms" => "1",
                "mq" => "70",
                "address" => "via dei Fori Imperiali, 1, 00186, Roma, RM",
                "latitude" => "41.894939",
                "longitude" => "12.484137",
                "price" => 190.00,
                "image" => "",
                "visibility" => "1",
            ],
            //10b
            [
                "user_id" => "1",
                "title" => "Maison des fleurs",
                "description" => "Appartamento dallo stile shabby-chic, con interni romantici e fiori ovunque. Situato in una posizione strategica nel centro storico, è l'ideale per esplorare la città.",
                "rooms" => "1",
                "beds" => "1",
                "bathrooms" => "1",
                "mq" => "50",
                "address" => "Via Cuma, 7, 80132 Napoli NA",
                "latitude" => "40.83263110283131",
                "longitude" => "14.251169177939595",
                "price" => 140.00,
                "image" => "",
                "visibility" => "1",
            ],
            //9b
            [
                "user_id" => "1",
                "title" => "Design Loft Virgil",
                "description" => "Appartamento in stile loft con interni moderni e dettagli di design. Dispone di una grande area living con cucina a vista e soppalco con la zona notte.",
                "rooms" => "1",
                "beds" => "1",
                "bathrooms" => "1",
                "mq" => "50",
                "address" => "via dei Fori Imperiali, 1, 00186, Roma, RM",
                "latitude" => "41.894939",
                "longitude" => "12.484137",
                "price" => 140.00,
                "image" => "",
                "visibility" => "1",
            ],
            //1b
            [
                "user_id" => "2",
                "title" => "La Ventana",
                "description" => "Appartamento romantico, luminoso e moderno. Dotato di una grande finestra panoramica, offre una vista mozzafiato sulla città.",
                "rooms" => "2",
                "beds" => "3",
                "bathrooms" => "1",
                "mq" => "50",
                "address" => "Via S. Giovanni Maggiore Pignatelli, 15, 80134 Napoli NA",
                "latitude" => "40.84687572473189",
                "longitude" => "14.25482264686615",
                "price" => 175.00,
                "image" => "",
                "visibility" => "1",
            ],
            //1c
            [
                "user_id" => "2",
                "title" => "La Ginestra",
                "description" => "Monolocale dallo stile moderno e minimalista, con arredi di design e una vista panoramica sulla città. Dotato di una cucina completamente attrezzata, è l'ideale per chi ama cucinare e vuole godersi la vista mentre prepara i propri piatti preferiti.",
                "rooms" => "1",
                "beds" => "2",
                "bathrooms" => "1",
                "mq" => "40",
                "address" => "Via S. Giovanni Maggiore Pignatelli, 15, 80134, Napoli, NA",
                "latitude" => "40.84687572473189",
                "longitude" => "14.25482264686615",
                "price" => 120.00,
                "image" => "",
                "visibility" => "1",
            ],
            //2a
            [
                "user_id"=> "2",
                "title"=> "Parco delle Muse",
                "description"=> "Appartamento immerso nel verde, situato in una tranquilla zona residenziale vicino al parco. Arredato in stile country-chic, è dotato di un ampio giardino privato.",
                "rooms"=> "3",
                "beds"=> "5",
                "bathrooms"=> "2",
                "mq"=> "90",
                "address"=> "via del Corso, 1, 00186, Roma, RM",
                "latitude"=> "41.90993",
                "longitude"=> "12.47680",
                "price"=> 275.00,
                "image"=> "", 
                "visibility"=> "1",
            ],
            //2b
            [
                "user_id" => "2",
                "title" => "Family House",
                "description" => "Trilocale dallo stile moderno e alla moda, con interni di design e dettagli originali. Situato in una posizione strategica, vicino alle maggiori attrazioni della città.",
                "rooms" => "2",
                "beds" => "5",
                "bathrooms" => "2",
                "mq" => "100",
                "address" => "via dei Fori Imperiali, 1, 00186, Roma, RM",
                "latitude" => "41.894939",
                "longitude" => "12.484137",
                "price" => 240.00,
                "image" => "",
                "visibility" => "1",
            ],
            //2c
            [
                "user_id" => "3",
                "title" => "Lux mea",
                "description" => "Caratterizzato da ampie finestre che lasciano entrare la luce naturale. L'arredamento minimalista e le pareti bianche contribuiscono a creare un ambiente luminoso e arioso. Un'esperienza unica per chi cerca una casa moderna e luminosa.",
                "rooms" => "2",
                "beds" => "4",
                "bathrooms" => "1",
                "mq" => "80",
                "address" => "via dei Fori Imperiali, 1, 00186, Roma, RM",
                "latitude" => "41.894939",
                "longitude" => "12.484137",
                "price" => 180.00,
                "image" => "",
                "visibility" => "1",
            ],
            //3b
            [
                "user_id" => "3",
                "title" => "Flat 2.0",
                "description" => "Questo appartamento è il perfetto esempio di come la tecnologia può essere integrata in un'abitazione moderna. Controllo domotico, schermi intelligenti e un sistema audio di alta qualità sono solo alcune delle funzionalità di questo spazio futuristico",
                "rooms" => "1",
                "beds" => "2",
                "bathrooms" => "1",
                "mq" => "60",
                "address" => "via dei Fori Imperiali, 1, 00186, Roma, RM",
                "latitude" => "41.894939",
                "longitude" => "12.484137",
                "price" => 200.00,
                "image" => "",
                "visibility" => "1",
            ],
            //4a
            [
                "user_id" => "3",
                "title" => "Il porto sicuro",
                "description" => "Appartamento luminoso situato vicino al porto turistico, con vista sul mare e sulle barche in arrivo e partenza. Arredato in stile nautico, è dotato di ogni comfort.",
                "rooms" => "2",
                "beds" => "4",
                "bathrooms" => "1",
                "mq" => "110",
                "address" => "via dei Fori Imperiali, 1, 00186, Roma, RM",
                "latitude" => "41.894939",
                "longitude" => "12.484137",
                "price" => 190.00,
                "image" => "",
                "visibility" => "1",
            ],
            //3a
            [
                "user_id" => "3",
                "title" => "Bodhisattva",
                "description" => "Questo appartamento è caratterizzato da linee minimaliste, stile moderno e ispirato all'oriente. La zona living offre spazio e comfort, mentre la camera da letto è accogliente e rilassante. L'ideale per chi cerca un ambiente tranquillo e confortevole.",
                "rooms" => "2",
                "beds" => "4",
                "bathrooms" => "1",
                "mq" => "70",
                "address" => "via dei Fori Imperiali, 1, 00186, Roma, RM",
                "latitude" => "41.894939",
                "longitude" => "12.484137",
                "price" => 160.00,
                "image" => "",
                "visibility" => "1",
            ],
            //4b
            [
                "user_id"=> "4",
                "title"=> "Maison Royal",
                "description"=> "Il perfetto esempio di come il lusso può essere integrato in un'abitazione moderna. L'arredamento, curato nei minimi dettagli, è realizzato con materiali di altissima qualità, come marmo, legno pregiato e tessuti pregiati. Gli spazi sono ampi e luminosi, offrendo il massimo del comfort e del relax.",
                "rooms"=> "3",
                "beds"=> "6",
                "bathrooms"=> "3",
                "mq"=> "150",
                "address"=> "via Marmorata, 1, 00186, Roma, RM",
                "latitude"=> "41.88252",
                "longitude"=> "12.47615",
                "price"=> 460.00,
                "image"=> "", 
                "visibility"=> "1",
            ],
            //4c
            [
                "user_id" => "4",
                "title" => "Il Giardino dei segreti",
                "description" => "Questo monolocale si affaccia su un grazioso giardino interno dotato di idromassaggio, creando un'atmosfera rilassante e silenziosa. Gli interni sono arredati in modo confortevole e funzionale, con una zona living che include un angolo cottura attrezzato e un letto matrimoniale.",
                "rooms" => "1",
                "beds" => "2",
                "bathrooms" => "2",
                "mq" => "45",
                "address" => "via dei Fori Imperiali, 1, 00186, Roma, RM",
                "latitude" => "41.894939",
                "longitude" => "12.484137",
                "price" => 220.00,
                "image" => "",
                "visibility" => "1",
            ],
            //5b
            [
                "user_id" => "4",
                "title" => "Hindustyal",
                "description" => "Questo appartamento è caratterizzato da un design a base di metalli e dettagli industriali. Tubi a vista, metallo arrugginito e finiture in acciaio inox creano un ambiente unico e originale, perfetto per gli amanti dello stile industriale",
                "rooms" => "1",
                "beds" => "2",
                "bathrooms" => "1",
                "mq" => "60",
                "address" => "P.za del Duomo, 20122, Milano, MI",
                "latitude" => "45.464211",
                "longitude" => "9.191383",
                "price" => 120.00,
                "image" => "",
                "visibility" => "1",
            ],
            //5a
            [
                "user_id" => "5",
                "title" => "Villa Gaia",
                "description" => "Questa villa è il luogo perfetto per chi cerca il massimo del relax e della privacy. Gli spazi interni sono arredati in stile minimalista, creando un ambiente moderno e confortevole. La grande piscina privata e il giardino ben curato offrono uno spazio perfetto per rilassarsi e godersi la natura circostante. La villa si trova in una zona tranquilla e appartata, lontano dal caos della città.",
                "rooms" => "4",
                "beds" => "9",
                "bathrooms" => "3",
                "mq" => "360",
                "address" => "P.za del Duomo, 20122 Milano MI",
                "latitude" => "45.464211",
                "longitude" => "9.191383",
                "price" => 520.00,
                "image" => "",
                "visibility" => "1",
            ],
            //6b
            [
                "user_id" => "5",
                "title" => "Comfy Home",
                "description" => "Questo monolocale è caratterizzato da una spaziosa zona living con angolo cottura e una camera da letto separata da una parete divisoria. Gli interni sono decorati con opere d'arte e dettagli creativi che rendono l'ambiente unico e originale.",
                "rooms" => "1",
                "beds" => "2",
                "bathrooms" => "1",
                "mq" => "50",
                "address" => "via dei Fori Imperiali, 1, 00186, Roma, RM",
                "latitude" => "41.894939",
                "longitude" => "12.484137",
                "price" => 90.00,
                "image" => "",
                "visibility" => "1",
            ],
            //6a
            [
                "user_id" => "5",
                "title" => "La Vie en rose",
                "description" => "Questo appartamento è caratterizzato da un arredamento chic e glamour, perfetto per chi cerca un ambiente elegante e raffinato. Mobili in velluto, lampadari in cristallo e finiture dorate creano un'atmosfera sofisticata e unica.",
                "rooms" => "2",
                "beds" => "4",
                "bathrooms" => "2",
                "mq" => "160",
                "address" => "via dei Fori Imperiali, 1, 00186, Roma, RM",
                "latitude" => "41.894939",
                "longitude" => "12.484137",
                "price" => 320.00,
                "image" => "", //
                "visibility" => "1",
            ],
            //6c
            [
                "user_id" => "5",
                "title" => "Il Focolare ",
                "description" => "Questo appartamento è caratterizzato dalla presenza di un bellissimo camino in pietra, che crea un'atmosfera accogliente e romantica. Gli spazi interni sono arredati con mobili in legno massello e tessuti caldi, offrendo un ambiente confortevole e rilassante. La zona living include un comodo divano-letto e una cucina completamente attrezzata, mentre la camera da letto dispone di un letto matrimoniale. L'appartamento si trova in una posizione tranquilla e panoramica, con vista sulle colline circostanti.",
                "rooms" => "3",
                "beds" => "7",
                "bathrooms" => "2",
                "mq" => "130",
                "address" => "Via Federico Stibbert, 29, 50134 Firenze FI",
                "latitude" => "43.791562",
                "longitude" => "11.255041",
                "price" => 300.00,
                "image" => "",
                "visibility" => "1",
            ],
            //7a
            [
                "user_id"=> "5",
                "title"=> "House Valentine",
                "description"=> "Questo appartamento è perfetto per una fuga romantica, con una vista mozzafiato sulla città e gli interni arredati con gusto e cura dei dettagli. La zona living un angolo cottura completamente attrezzato, mentre la camera da letto dispone di un letto matrimoniale e un balcone privato con vista panoramica. Il bagno è dotato di una grande vasca idromassaggio, perfetta per rilassarsi e coccolarsi in coppia.",
                "rooms"=> "1",
                "beds"=> "2",
                "bathrooms"=> "1",
                "mq"=> "50",
                "address"=> "Via della Scala, 40, 50123 Firenze FI ",
                "latitude"=> "43.775642",
                "longitude"=> " 11.245791",
                "price"=> 300.00,
                "image"=> "", 
                "visibility"=> "1",
            ],
            //7b
            [
                "user_id" => "5",
                "title" => "Woodstok",
                "description" => " Appartamento accogliente e rustico, situato nelle vicinanze delle montagne e delle piste da sci. Arredato in stile montano, offre una vista spettacolare sulle montagne circostanti.",
                "rooms" => "3",
                "beds" => "8",
                "bathrooms" => "3",
                "mq" => "150",
                "address" => "via dei Fori Imperiali, 1, 00186, Roma, RM",
                "latitude" => "41.894939",
                "longitude" => "12.484137",
                "price" => 320.00,
                "image" => "",
                "visibility" => "1",
            ],
            //7c
            [
                "user_id" => "5",
                "title" => "CityLounge",
                "description" => " Questo appartamento è perfetto per chi viaggia per lavoro, con spazi interni funzionali e arredati con gusto. La zona living include una scrivania e un comodo divano-letto, mentre la camera da letto dispone di un letto matrimoniale e un grande armadio. L'appartamento è dotato di una cucina completamente attrezzata e un bagno con doccia. La posizione è centrale e ben collegata con i principali uffici e sedi di lavoro della città.",
                "rooms" => "3",
                "beds" => "3",
                "bathrooms" => "3",
                "mq" => "110",
                "address" => "via dei Fori Imperiali, 1, 00186, Roma, RM",
                "latitude" => "41.894939",
                "longitude" => "12.484137",
                "price" => 220.00,
                "image" => "",
                "visibility" => "1",
            ],
            //8b
            [
                "user_id" => "5",
                "title" => "Appartamento Tela Bianca",
                "description" => " Arredato in stile boho, l'appartamento crea un ambiente caldo e accogliente. Gli interni sono arredati con tessuti etnici, cuscini colorati e tappeti in stile kilim. La zona living include un divano-letto e una cucina completamente attrezzata, mentre la camera da letto dispone di un letto matrimoniale e un armadio in legno decorato a mano. Il bagno è dotato di una doccia a pioggia e di un lavabo in pietra. L'appartamento si trova in una posizione strategica, vicino alle principali attrazioni turistiche della città e ai mezzi pubblici.",
                "rooms" => "2",
                "beds" => "4",
                "bathrooms" => "1",
                "mq" => "80",
                "address" => "via dei Fori Imperiali, 1, 00186, Roma, RM",
                "latitude" => "41.894939",
                "longitude" => "12.484137",
                "price" => 150.00,
                "image" => "",
                "visibility" => "1",
            ],
            //8a
            [
                "user_id"=> "5",
                "title"=> "Feng Shui Armony",
                "description"=> " Questo appartamento è stato arredato secondo i principi del feng shui, creando un ambiente armonioso e rilassante. Gli interni sono minimalisti ed eleganti, con una grande zona living e una cucina completamente attrezzata. La camera da letto dispone di un letto matrimoniale con un morbido piumone e di un balcone privato con vista sulla città. Il bagno è dotato di una grande vasca idromassaggio, perfetta per rilassarsi e rigenerarsi. L'appartamento si trova in una posizione tranquilla e riservata, offrendo la massima privacy e relax.",
                "rooms"=> "1",
                "beds"=> "2",
                "bathrooms"=> "1",
                "mq"=> "70",
                "address"=> "Via Maso Finiguerra, 50123 Firenze FI ",
                "latitude"=> "43.77399",
                "longitude"=> "11.24508",
                "price"=> 160.00,
                "image"=> "", 
                "visibility"=> "1",
            ],
            //9a
            [
                "user_id" => "5",
                "title" => "Easygoing Life",
                "description" => " Perfetto per una famiglia che cerca un'esperienza confortevole e accogliente. Gli interni sono arredati con colori caldi e tessuti morbidi, creando un ambiente rilassante e familiare. La zona living include un ampio divano e una cucina completamente attrezzata, mentre la camera da letto principale dispone di un letto matrimoniale e una grande armadio. La seconda camera da letto è dotata di due letti singoli, ideale per i bambini. Il bagno è dotato di una vasca da bagno e di una doccia. L'appartamento si trova in una posizione tranquilla e riservata, vicino a numerosi parchi e aree verdi.",
                "rooms" => "2",
                "beds" => "4",
                "bathrooms" => "1",
                "mq" => "80",
                "address" => "via dei Fori Imperiali, 1, 00186, Roma, RM",
                "latitude" => "41.894939",
                "longitude" => "12.484137",
                "price" => 250.00,
                "image" => "",
                "visibility" => "1",
            ],
            //8c
            [
                "user_id" => "5",
                "title" => "Plaza Executive",
                "description" => " Questo appartamento si trova nel cuore della città vecchia, in un palazzo storico completamente ristrutturato. Gli interni sono arredati in stile moderno e minimalista, creando un ambiente confortevole e accogliente. La zona living include un comodo divano-letto e un angolo cottura completamente attrezzato, mentre la camera da letto dispone di un letto matrimoniale. L'appartamento si trova in una posizione strategica, a pochi passi dalle principali attrazioni turistiche della città.",
                "rooms" => "3",
                "beds" => "7",
                "bathrooms" => "2",
                "mq" => "70",
                "address" => "Piazzale Angelo Moratti, 20151 Milano MI",
                "latitude" => "45.48122825769107",
                "longitude" => "9.12519998617078",
                "price" => 360.00,
                "image" => "",
                "visibility" => "1",
            ],
            //10a
            [
                "user_id" => "5",
                "title" => "Residenza la Riviera",
                "description" => " Progettato dal celebre designer Robert Riviera, perfetto per coloro che apprezzano l'architettura moderna e minimalista. Gli interni sono caratterizzati da linee pulite e mobili minimalisti, creando un'atmosfera elegante e contemporanea. La zona living è composta da un ampio divano e una cucina completamente attrezzata, mentre la camera da letto dispone di un letto matrimoniale e un armadio a muro. Il bagno è dotato di una grande doccia a pioggia. L'appartamento si trova in una posizione centrale, vicino a numerosi negozi di design e ristoranti di tendenza.",
                "rooms" => "1",
                "beds" => "3",
                "bathrooms" => "2",
                "mq" => "90",
                "address" => "Piazza Castello, 20121 Milano MI",
                "latitude" => "45.47295873762749",
                "longitude" => "9.177989838881677",
                "price" => 100.00,
                "image" => "",
                "visibility" => "1",
            ],

        ];

        foreach ($apartments as $apartment) {
            Apartment::create([
                "user_id" => $apartment["user_id"],
                "title" => $apartment["title"],
                "description" => $apartment["description"],
                "rooms" => $apartment["rooms"],
                "beds" => $apartment["beds"],
                "bathrooms" => $apartment["bathrooms"],
                "mq" => $apartment["mq"],
                "address" => $apartment["address"],
                "latitude" => $apartment["latitude"],
                "longitude" => $apartment["longitude"],
                "price" => $apartment["price"],
                "image" => $apartment["image"],
                'slug' => Str::slug($apartment['title']),
                "visibility" => $apartment["visibility"],
            ]);
        };
    }
}