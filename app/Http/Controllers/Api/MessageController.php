<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Message;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // Funzione per salvare dati ricevuti dal frontend
    public function store(Request $request)
    {
        $data = $this->validation($request->all());

        $message = new Message();
        
        $message->fill($data);
        $message->save();

        return response()->json([
            'succes' => 'true',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    // * FUNZIONI DI SUPPORTO

    // Funzione per la validazione dei dati
    private function validation($data) 
    {
        $validator = Validator::make(
            $data,
            [
                'apartment_id' => 'required|integer|exists:apartments,id',
                'name' => 'required|string|max:100',
                'surname' => 'required|string|max:100',
                'email' => 'required|string|max:100|email',
                'text' => 'required|string|max:65535',
            ],
            [
                'apartment_id.required' => "L'ID dell'appartamento è obbligatorio",
                'apartment_id.integer' => "L'ID dell'appartamento deve essere un numero intero",


               'name.required' => "Il nome del mittente è obbligatorio", 
               'name.string' => "Il nome del mittente deve essere una stringa",
               'name.max' => "Il nome del mittente può contenere massimo 100 caratteri",
    
               'surname.required' => "Il cognome del mittente è obbligatorio", 
               'surname.string' => "Il cognome del mittente deve essere una stringa",
               'surname.max' => "Il cognome del mittente può contenere massimo 100 caratteri",
    
               'email.required' => "L'indirizzo email è obbligatorio", 
               'email.string' => "L'indirizzo email deve essere una stringa",
               'email.max' => "L'indirizzo email può contenere massimo 100 caratteri",
               'email.email' => "L'indirizzo email deve per forza essere un indirizzo email valido",
    
               'text.required' => "Il testo del messaggio è obbligatorio", 
               'text.string' => "Il testo del messaggio deve essere un testo",
               'text.max' => "Il testo del messaggio può contenere massimo 65535 caratteri",
            ])->validate();

        return $validator;
    }
}