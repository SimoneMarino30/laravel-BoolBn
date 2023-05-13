<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Message;
use App\Models\Apartment;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    // * Funzione per visualizzare lista messaggi inviati dai visitatori
    public function index(Request $request, Apartment $apartment)
    {
        $user = Auth::user();

        $apartment_id = $request->input('apartment_id');

        $messages = Message::whereHas('apartment', function ($query) use ($user) {
            $query->where('user_id', '=', $user->id)
                ->orderBy('created_at', 'desc');
        });
        
         if ($apartment_id) {
             $messages = $messages->where('apartment_id', $apartment_id);
         }

         $messages = $messages->get();

        return view('admin.messages.index', compact('messages'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}