<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Braintree;

class PaymentsController extends Controller
{

    function make(Request $request)
    {
        $data = $request->all();
        $price = $data["price"];
        $payload = $request->input('payload', false);
        $nonce = $payload['nonce'];
        $status = Braintree\Transaction::sale([
            'amount' => $price,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => True
            ]
        ]);
        return response()->json($status);
    }
}
