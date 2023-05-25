<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

// * MODELS
use App\Models\ApartmentSponsor;
use App\Models\Sponsor;

// * BRAINTREE
use Braintree\Gateway;
use Braintree\Transaction;

// * SUPPORT
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    // Funzione per recuperare token braintree e passarlo alla vista che si occuperà del pagamento
    public function clientToken()
    {
        // SE mi arrivano i parametri apartment_id e sponsor_id
        if (request()->input('apartment_id') && request()->input('sponsor_id')) {
            // Assegno i parametri che mi arrivano a due variabili
            $apartment_id = request()->input('apartment_id');
            $sponsor_id = request()->input('sponsor_id');

            // Identifico l'user autenticato
            $user = Auth::user();

            // Recupero quello specifico appartamento
            $apartment = $user->apartments->where('id', $apartment_id);

            // SE gli id degli sponsor non rientrano tra 1 e 3 e nessun appartamento passa il controllo
            if ($sponsor_id > 3 || $sponsor_id <= 0 || $apartment->isEmpty()) {
                return redirect()->route('admin.sponsors.index')->with('message_content', 'Siamo spiacenti, la pagina non esiste')->with('message_type', 'danger');
            }

            // ALTRIMENTI, se passa il controllo, istanzi nuovo Gateway
            $gateway = new Gateway([
                'environment' => env('BRAINTREE_ENV'),
                'merchantId' => env("BRAINTREE_MERCHANT_ID"),
                'publicKey' => env("BRAINTREE_PUBLIC_KEY"),
                'privateKey' => env("BRAINTREE_PRIVATE_KEY")
            ]);

            // Generi il token
            $clientToken = $gateway->clientToken()->generate();

            // Ritorni la vista passando il token
            return view('admin.payment.index', ['token' => $clientToken]);

            // ALTRIMENTI se non ricevi nessun input nell'url
        } else {
            return redirect()->back()->with('message_content', 'Siamo spiacenti, la pagina non esiste')->with('message_type', 'danger');
        }
    }

    // Funzione che gestisce il pagamento
    public function make(Request $request)
    {

        // Creo variabile payload e nonce
        $payload = $request->input("payload", false);
        $nonce = $payload["nonce"];

        // Recupero sponsor_id e apartment_id
        $sponsor_id =  request()->input('sponsor');
        $apartment_id =  request()->input('apartment');

        // Recupero lo sponsor associato a quello sponsor_id
        $sponsor = Sponsor::where('id', $sponsor_id)->first();

        // Creo transazione
        $status = Transaction::sale([
            "amount" => $sponsor->price,
            "paymentMethodNonce" => $nonce,
            "options" => [
                "submitForSettlement" => True
            ]
        ]);

        // Recupero data odierna
        $now = date("Y-m-d H:i:s");

        // SE la transazione è avvenuta correttamente istanzio ApartmentSponsor e prolungo expiring_date 
        if ($status) {
            $sponsored_apartment = new ApartmentSponsor();
            $sponsored_apartment->apartment_id = $apartment_id;
            $sponsored_apartment->sponsor_id = $sponsor_id;
            $sponsored_apartment->expiring_date = date("Y-m-d H:i:s", strtotime('+' . $sponsor->duration . 'hours', strtotime($now)));
            $sponsored_apartment->save();
        }

        // Ritorno la transazione
        return response()->json($status);
    }
}