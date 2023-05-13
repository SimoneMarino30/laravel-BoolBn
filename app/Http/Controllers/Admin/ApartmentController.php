<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

// MODELS
use App\Models\Apartment;

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

         if(Arr::exists($data, 'link')) {
            $path = Storage::put('uploads/apartments', $data['image']);
            $data['image'] = $path;
        }

        $apartment = new Apartment();
        $apartment->fill($data);
        $apartment->save();

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
        return view('admin.apartments.form', compact('apartment'));
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

        $apartment->update($data);
        
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
        //
    }

    private function validation($data) 
    {
        $validator = Validator::make(
            $data,
            [
            'title' => 'required|string|max:100',
            'address' => 'required|string',
            'rooms' => 'required|integer',
            'beds' => 'required|integer',
            'bathrooms' => 'required|integer',
            'mq' => 'required|integer',
            'price' => 'required|numeric|max:9999.99',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg',
            
        ],
        [
            'title.required' => 'il nome è obbligatorio',
            'title.string' => 'il nome deve essere una stringa',
            'title.max' => 'il nome deve avere al massimo 100 catteri',

            'address.required' => 'l\' indirizzo è obbligatorio',
            'address.string' => 'l\' indirizzo deve essere una stringa',

            'rooms.required' => 'il numero di stanze è obbligatorio',
            'rooms.integer' => 'il numero di stanze deve essere un numero',

            'beds.required' => 'il numero di letti è obbligatorio',
            'beds.integer' => 'il numero di letti deve essere un numero',

            'bathrooms.required' => 'il numero di bagni è obbligatorio',
            'bathrooms.integer' => 'il numero di bagni deve essere un numero',

            'mq.required' => 'il numero di mq è obbligatorio',
            'mq.integer' => 'i mq devono essere un numero',

            'price.required' => 'il prezzo è obbligatorio',
            'price.numeric' => 'il prezzo deve essere un numero',
            'price.max' => 'il prezzo deve non può superare 9999.99',

            'description.required' => 'la descrizione è obbligatoria',
            'description.string' => 'la descrizione deve essere una stringa',

            'image.image' => 'devi caricare un\' immagine',
            'image.mimes' => 'le estensioni accettate sono: jpg, png, jpeg',


        ])->validate();

        return $validator;
    }
}