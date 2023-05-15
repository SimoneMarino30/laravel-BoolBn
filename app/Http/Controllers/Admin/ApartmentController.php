<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

// MODELS
use App\Models\Apartment;
use App\Models\Service;

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

        $apartments = Apartment::where('user_id', $user->id)->get();

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
        $apartment->save();
        // dd($data);

        if(Arr::exists($data, "services")) $apartment->services()->attach($data["services"]);
        
        // dd($data);
        return redirect()->route('admin.apartments.show', $apartment);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        return view('admin.apartments.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        $services = Service::all();
        $apartment_services = $apartment->services->pluck('id')->toArray();
        return view('admin.apartments.form', compact('apartment', 'services', 'apartment_services'));
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
        $apartment->save($data);

        if(Arr::exists($data, "services")) 
            $apartment->services()->sync($data["services"]);
        else 
            $apartment->services()->detach();

        
        return redirect()->route('admin.apartments.show', $apartment);
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
        return redirect()->route('admin.apartments.index');
    }

    private function validation($data) 
    {
        $validator = Validator::make(
            $data,
            [
            'title' => 'required|string|max:100',
            'address' => 'required|string',
            'rooms' => 'required|integer| max:10',
            'beds' => 'required|integer|max:20',
            'bathrooms' => 'required|integer|max:8',
            'mq' => 'required|integer',
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

            'rooms.required' => 'il numero di stanze è obbligatorio',
            'rooms.integer' => 'il numero di stanze deve essere un numero',
            'rooms.max' => 'le stanze non possono essere maggiori di 10',

            'beds.required' => 'il numero di letti è obbligatorio',
            'beds.integer' => 'il numero di letti deve essere un numero',
            'beds.max' => 'i letti non possono essere maggiori di 20',

            'bathrooms.required' => 'il numero di bagni è obbligatorio',
            'bathrooms.integer' => 'il numero di bagni deve essere un numero',
            'bathrooms.max' => 'i bagni non possono essere maggiori di 8',

            'mq.required' => 'il numero di mq è obbligatorio',
            'mq.integer' => 'i mq devono essere un numero',

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

}