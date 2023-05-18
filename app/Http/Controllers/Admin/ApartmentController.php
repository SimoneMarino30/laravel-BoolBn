<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

// MODELS
use App\Models\Apartment;
use App\Models\Service;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $apartments = Apartment::where('user_id', $user->id)->orderBy('updated_at', 'DESC')->paginate(5);
        
        return view('admin.apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Apartment $apartment)
    {
        $apartment = new Apartment();
        $services = Service::all();
        
        

        return view('admin.apartments.form', compact('apartment', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validation($request->all());
        

         if(Arr::exists($data, 'image')) {
            $path = Storage::put('uploads/apartments', $data['image']);
            $data['image'] = $path;
        }

         $user = Auth::user();
         $data[ 'user_id'] = $user->id;

        $apartment = new Apartment();
        
        $apartment->fill($data);
        // dd($data);
        $apartment->visibility = $request->has('visibility') ? 1 : 0;
        $apartment->slug = Apartment::generateUniqueSlug($apartment->title);
        $apartment->save();
        // dd($data);

        if(Arr::exists($data, "services")) $apartment->services()->attach($data["services"]);
        
        // dd($data);
        return redirect()->route('admin.apartments.show', $apartment)->with('message_content', 'Nuovo appartamento aggiunto con successo');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Apartment $apartment, User $user)
    {  
        $user=Auth::user();

         if($user->id === $apartment->user_id){
           return view('admin.apartments.show', compact('apartment'));
        }   abort(403, "accesso non autorizzato");

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment, User $user)
    {
        
        $services = Service::all();
        $apartment_services = $apartment->services->pluck('id')->toArray();
         $user=Auth::user();

         if($user->id === $apartment->user_id){
          return view('admin.apartments.form', compact('apartment', 'services', 'apartment_services'));
        }   abort(403, "accesso non autorizzato");
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment)
    {
      
        $data = $this->validation($request->all());

            if(Arr::exists($data, 'image')) {
                if($apartment->image) Storage::delete($apartment->image);
            $path = Storage::put('uploads/apartments', $data['image']);
            $data['image'] = $path;
        }

        $apartment->fill($data);
        $apartment->visibility = $request->has('visibility') ? 1 : 0;
        $apartment->slug = Apartment::generateUniqueSlug($apartment->title);
        $apartment->save($data);

        if(Arr::exists($data, "services")) 
            $apartment->services()->sync($data["services"]);
        else 
            $apartment->services()->detach();

        
        return redirect()->route('admin.apartments.show', $apartment)->with('message_content', 'Appartamento modificato con successo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        if($apartment->image) Storage::delete($apartment->image);
        $apartment->delete();
        return redirect()->route('admin.apartments.index')->with('message_content', 'Appartamento eliminato con successo')
        ->with('message_type', 'danger');
    }

    // * FUNZIONI DI SUPPORTO

    // Funzione per la validazione dei dati
    private function validation($data) 
    {
        $validator = Validator::make(
            $data,
            [
            'title' => 'required|string|max:100',
            'address' => 'required|string',
            'latitude' => 'required|string',
            'longitude' => 'required|string',
            'rooms' => 'required|integer| max:10|min:1',
            'beds' => 'required|integer|max:20|min:1',
            'bathrooms' => 'required|integer|max:8|min:1',
            'mq' => 'required|integer|min:20',
            'price' => 'required|numeric|max:9999.99',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg',
            'services' =>  'nullable|exists:services,id'
            
        ],
        [
            'title.required' => 'il nome è obbligatorio',
            'title.string' => 'il nome deve essere una stringa',
            'title.max' => 'il nome deve avere al massimo 100 catteri',

            'address.required' => 'l\' indirizzo è obbligatorio',
            'address.string' => 'l\' indirizzo deve essere una stringa',

            'latitude.required' => 'l\' indirizzo deve essere completo',
            'latitude.string' => 'la latitudine deve essere una stringa',
            'latitude.max' => 'la latitudine deve avere al massimo 100 catteri',

            'longitude.required' => '',
            'longitude.string' => 'la longitudine deve essere una stringa',
            'longitude.max' => 'la longitudine deve avere al massimo 100 catteri',

            'rooms.required' => 'il numero di stanze è obbligatorio',
            'rooms.integer' => 'il numero di stanze deve essere un numero',
            'rooms.max' => 'le stanze non possono essere maggiori di 10',
            'rooms.min' => 'le stanze non possono essere minori di 1',

            'beds.required' => 'il numero di letti è obbligatorio',
            'beds.integer' => 'il numero di letti deve essere un numero',
            'beds.max' => 'i letti non possono essere maggiori di 20',
            'beds.min' => 'i letti non possono essere minori di 1',

            'bathrooms.required' => 'il numero di bagni è obbligatorio',
            'bathrooms.integer' => 'il numero di bagni deve essere un numero',
            'bathrooms.max' => 'i bagni non possono essere maggiori di 8',
            'bathrooms.min' => 'i bagni non possono essere minori di 1',

            'mq.required' => 'il numero di mq è obbligatorio',
            'mq.integer' => 'i mq devono essere un numero',
            'mq.min' => 'i mq non possono essere minori di 20',

            'price.required' => 'il prezzo è obbligatorio',
            'price.numeric' => 'il prezzo deve essere un numero',
            'price.max' => 'il prezzo deve non può superare 9999.99',

            'description.required' => 'la descrizione è obbligatoria',
            'description.string' => 'la descrizione deve essere una stringa',

            'image.image' => 'devi caricare un\' immagine',
            'image.mimes' => 'le estensioni accettate sono: jpg, png, jpeg',
        

            'services.exists' => 'I servizi selezionati non sono validi'

        ])->validate();

        return $validator;
    }

    /**
     * Delete the image from storage.
     *
     * @param  \App\Models\Shoe  $shoe
     * @return \Illuminate\Http\Response
     */

    // * Funzione che elimina l'immagine nel form
    public function deleteimage(Apartment $apartment)
    {
        if ($apartment->image) Storage::delete($apartment->image);

        $apartment->image = null;
        $apartment->save();

        return redirect()->back()->with('message_content', 'Immagine eliminata con successo!')
            ->with('message_type', 'danger');
    }

}