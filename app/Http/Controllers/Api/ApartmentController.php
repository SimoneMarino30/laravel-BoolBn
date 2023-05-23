<?php

namespace App\Http\Controllers\Api;
use App\Models\Apartment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ! NO FILTRI
        // Recupero gli ID degli appartamenti sponsorizzati
        $sponsored_apartments_id = Apartment::whereHas('sponsors', function ($query) {
            $query->where('expiring_date', '>=', Date('Y-m-d H:m:s'));
        })->pluck('id');

        // Creo un nuovo array per poter utilizzare metodo in_array successivamento qunado aggiungo chiave sponsored = true, visto che non riconosce sponsored_apartments_id
        $id_array = [];
        foreach($sponsored_apartments_id as $item) {
            $id_array[] = $item;
        }

        if (request()->input('address')) {

            $address = request()->input('address');

            $apartments = Apartment::leftJoin('apartment_sponsor', 'apartments.id', '=', 'apartment_sponsor.apartment_id')
                ->select('apartments.*')
                ->with(['sponsors' => function ($query) {
                    $query->where('expiring_date', '>=', Date('Y-m-d H:m:s'))->orderBy('expiring_date', 'asc');
                }])
                ->with('services')
                ->where('address', 'like', '%'.$address.'%')
                ->where("visibility", "1")
                // CASE WHEN - THEN - ELSE - END
                ->orderByRaw('CASE WHEN apartment_sponsor.expiring_date >= ? THEN 0 ELSE 1 END, apartment_sponsor.expiring_date ASC', [Date('Y-m-d H:m:s')])
                ->orderBy('updated_at', 'DESC')
                // PAGINAZIONE DA REINSERIRE DOPO AVER RISOLTO BUG FILTRI
                ->paginate(8);
                // ->get();
                
        } else {
                  
            // ---- QUERY SQL ---- //
            // SELECT *
            // FROM `apartments`
            // LEFT JOIN `apartment_sponsor` ON `apartments`.`id` = `apartment_sponsor`.`apartment_id`
            // WHERE `apartment_sponsor`.`expiring_date` >= NOW()
            // ORDER BY `apartments`.`updated_at` DESC ;
            // -------- //

            // Query appartamenti
            $apartments = Apartment::leftJoin('apartment_sponsor', 'apartments.id', '=', 'apartment_sponsor.apartment_id')
                ->select('apartments.*')
                ->with(['sponsors' => function ($query) {
                    $query->where('expiring_date', '>=', Date('Y-m-d H:m:s'))
                        ->orderBy('expiring_date', 'asc');
                }])
                ->with('services')
                ->where("visibility", "1")
                // CASE WHEN - THEN - ELSE - END
                ->orderByRaw('CASE WHEN apartment_sponsor.expiring_date >= ? THEN 0 ELSE 1 END, apartment_sponsor.expiring_date ASC', [Date('Y-m-d H:m:s')])
                ->orderBy('updated_at', 'DESC')
                // PAGINAZIONE DA REINSERIRE DOPO AVER RISOLTO BUG FILTRI
                ->paginate(8);
                // ->get();

        }

        // Aggiungo parametro true e false per sponsored al singolo appartamento
        foreach ($apartments as $apartment) {
            $apartment->image = $apartment->getImageUri();
            if (in_array($apartment['id'], $id_array))
                $apartment['sponsored'] = true;
            else
                $apartment['sponsored'] = false;
        }
         
        return response()->json($apartments);


        // ! LOGICA COORDINATE E RAGGIO
        // funzione distanza raggio
        // function distance($lat1, $lon1, $lat2, $lon2)
        // {
        //     if (($lat1 == $lat2) && ($lon1 == $lon2)) {
        //         return 0;
        //     } else {
        //         $theta = $lon1 - $lon2;
        //         $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        //         $dist = acos($dist);
        //         $dist = rad2deg($dist);
        //         $kilometers = $dist * 60 * 1.1515 * 1.609344;
        //         return $kilometers;
        //     }
        // }

        // $lat = n;
        // $lon = n;
        // $radius = 20;

        // if (
        //     request()->input('lat') &&
        //     request()->input('lon')
        // ) {
        //     $lat = request()->input('lat');
        //     $lon = request()->input('lon');
        // }
        // if (request()->input('radius'))
        //     $radius = request()->input('radius');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $apartment = Apartment::where('slug', $slug)->with('services')->first();

        $apartment->image = $apartment->getImageUri();

        if(! $apartment) return response(null, 404);

        return response()->json($apartment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // Funzione per recuperare appartamenti sponsorizzati
    public function sponsoredApartments() {

        $apartments = Apartment::whereHas('sponsors', function ($query) {
            $query->where('expiring_date', '>=', Date('Y-m-d H:m:s'));
        })->paginate(4);

        foreach($apartments as $apartment) {
            $apartment->image = $apartment->getImageUri();
            // Aggiungo chiave sponsored così da poter ordinare per appartamenti sponsorizzati
            $apartment['sponsored'] = true;
        }

        $response = [
            'success' => true,
            'code' => 200,
            'message' => 'Lista appartamenti sponsorizzati',
            'apartments' => $apartments
        ];

        return response()->json($response);
    }
}