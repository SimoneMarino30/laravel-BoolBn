<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Braintree\Gateway;
use Braintree\Transaction;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function clientToken() {

    $gateway = new Gateway([
    'environment' => 'sandbox',
    'merchantId' => 'fgbw2z84c7rgg98z',
    'publicKey' => 'vvd5z9b53h9kypb4',
    'privateKey' => '69d1317dc1fcae117342889853e32272'
]);

$clientToken = $gateway->clientToken()->generate([
    // "customerId" => $aCustomerId
]);

    //   if(request()->input('apartment_id') && request()->input('sponsor_id')) {
    // $apartment_id = request()->input('apartment_id');
    // $sponsor_id = request()->input('sponsor_id');
    return view('admin.payment.index', compact('clientToken'));
        //   } else {
    //  return redirect()->back()->with('message_content', 'la pagina non esiste')->with( 'message_type', 'danger');
    //   }
    }

    public function make(Request $request) {

    $payload = $request->input("payload", false);
    $nonce = $payload["nonce"];
    $status = Transaction::sale([
                            "amount" => "10.00",
                            "paymentMethodNonce" => $nonce,
                            "options" => [
                                       "submitForSettlement" => True
                                         ]
              ]);
    return response()->json($status);
    }
}