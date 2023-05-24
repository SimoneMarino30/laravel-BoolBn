<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

// MODELS
use App\Models\Sponsor;
use App\Models\Apartment;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $apartment_id = $request->query('apartment_id');
        
        $sponsors = Sponsor::all();

        return view('admin.sponsors.index', compact('sponsors', 'apartment_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function show(Sponsor $sponsor, Request $request)
    {
        $apartment_id = $request->query('apartment_id');
        
        $user = Auth::user();
        
        $today = Carbon::today();

        if ($apartment_id == null) {

            $apartments = Apartment::where('user_id', $user->id)
            ->whereDoesntHave('sponsors', function ($query)  use ($today) {
                $query->where('expiring_date', '>', $today)
                ->orWhereNull('expiring_date');
            })->get();

            return view('admin.sponsors.show', compact('apartments', 'sponsor'));
        }
        
        else {

            $apartment = Apartment::findOrFail($apartment_id);

            $sponsor = Sponsor::findOrFail($sponsor->id);
            
            // Controllo apartment_id nell'url
            if($user->id === $apartment->user_id){
                return view('admin.sponsors.show', compact('apartment', 'sponsor'));
             }   abort(403, "accesso non autorizzato");
 
        }  
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function edit(Sponsor $sponsor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sponsor $sponsor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sponsor $sponsor)
    {
        //
    }
}