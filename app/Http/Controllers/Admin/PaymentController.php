<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

// * MODELS
use App\Models\ApartmentSponsor;
use App\Models\Sponsor;

// * BRAINTREE
use Braintree\Gateway;
use Braintree\Transaction;
use Carbon\Carbon;
// * SUPPORT
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function clientToken()
    {

        if (request()->input('apartment_id') && request()->input('sponsor_id')) {
            $apartment_id = request()->input('apartment_id');
            $sponsor_id = request()->input('sponsor_id');
            // dd($apartment_id);
            $gateway = new Gateway([
                'environment' => env('BRAINTREE_ENV'),
                'merchantId' => env("BRAINTREE_MERCHANT_ID"),
                'publicKey' => env("BRAINTREE_PUBLIC_KEY"),
                'privateKey' => env("BRAINTREE_PRIVATE_KEY")
            ]);

            $clientToken = $gateway->clientToken()->generate([
                // "customerId" => $aCustomerId
            ]);

            return view('admin.payment.index', ['token' => $clientToken]);
        } else {
            return redirect()->back()->with('message_content', 'Siamo spiacenti, la pagina non esiste')->with('message_type', 'danger');
        }
    }

    public function make(Request $request)
    {

        $payload = $request->input("payload", false);
        $nonce = $payload["nonce"];

        $sponsor_id =  request()->input('sponsor');
        $apartment_id =  request()->input('apartment');

        $sponsor = Sponsor::where('id', $sponsor_id)->first();


        $status = Transaction::sale([
            "amount" => $sponsor->price,
            "paymentMethodNonce" => $nonce,
            "options" => [
                "submitForSettlement" => True
            ]
        ]);

        $now = date("Y-m-d H:i:s");
        if ($status) {
            $sponsored_apartment = new ApartmentSponsor();
            $sponsored_apartment->apartment_id = $apartment_id;
            $sponsored_apartment->sponsor_id = $sponsor_id;
            $sponsored_apartment->expiring_date = date("Y-m-d H:i:s", strtotime('+' . $sponsor->duration . 'hours', strtotime($now)));
            $sponsored_apartment->save();
        }
        // $sponsored_apartment->fill();
        return response()->json($status);
    }
}