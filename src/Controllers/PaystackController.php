<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Payments;

use Illuminate\Support\Facades\Http;


class PaystackController extends Controller
{
    public function handleGatewayCallback(Request $request)
    {
        $reference = $request->reference;
        $secret_key = env('PAYSTACK_SECRET_KEY');


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . $reference,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $secret_key",
                "Cache-Control: no-cache",
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response);

        if (isset($response->data)) {
            $meta_data = $response->data->metadata->custom_fields;

            //save to database
            if ($response->data->status == 'success') {
                $payment = new Payments;
                $payment->payment_id = $reference;
                $payment->payment_for = $meta_data[0]->payment_type;
                $payment->payment_from = $response->data->customer->email;
                $payment->amount = $response->data->amount / 100;
                $payment->currency = $response->data->currency;
                $payment->payment_method = $response->data->channel;

                $payment->save();


                return redirect('/')->with('success', 'Payment was successful');
            } elseif ($response->data->status == 'failed') {
                return redirect()->back()->with('error', 'Payment was cancelled');
            }
        } else {
            return redirect('/')->with('error', 'Invalid Transaction');
        }
    }
}
