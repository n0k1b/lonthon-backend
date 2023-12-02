<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Log;
use GuzzleHttp\Client;

class PaymentController extends Controller
{
    //
    public function initiatePayment(Request $request)
    {
        $store_id = 'nokib5fa913a013777';
        $store_password = 'nokib5fa913a013777@ssl';

        $client = new Client();

        // Prepare payment data
        $paymentData = [
            'store_id' => $store_id,
            'store_passwd' => $store_password,
            'total_amount' => 100,
            'currency' => 'BDT',
            'tran_id' => 'REF123',
            'success_url' => 'http://127.0.0.1:8080/success',
            'fail_url' => 'http://127.0.0.1:8080/fail',
            'cancel_url' => 'http://127.0.0.1:8080/cancel',
            'cus_name' => 'Customer Name',
            'cus_email' => 'cust@yahoo.com',
            'cus_add1' => 'Dhaka',
            'cus_add2' => 'Dhaka',
            'cus_city' => 'Dhaka',
            'cus_state' => 'Dhaka',
            'cus_postcode' => '1000',
            'cus_country' => 'Bangladesh',
            'cus_phone' => '01711111111',
            'cus_fax' => '01711111111',
            'ship_name' => 'Customer Name',
            'ship_add1' => 'Dhaka',
            'ship_add2' => 'Dhaka',
            'ship_city' => 'Dhaka',
            'ship_state' => 'Dhaka',
            'ship_postcode' => '1000',
            'ship_country' => 'Bangladesh',
            'multi_card_name' => 'mastercard,visacard,amexcard',
            'value_a' => 1,
            'value_b' => 'ref002_B',
            'value_c' => 'ref003_C',
            'value_d' => 'ref004_D',
            'shipping_method' => 'No',
            'product_name' => 'Test',
            'product_category' => 'test',
            'product_profile' => 'general',
            'product_id' => 1,
        ];

        try {
            $response = $client->post('https://sandbox.sslcommerz.com/gwprocess/v4/api.php', [
                'form_params' => $paymentData,
            ]);

            $responseData = json_decode($response->getBody(), true);

            // Handle the SSLCommerz response
            // Log::info($responseData);

            return $this->successJsonResponse('test', ['redirectUrl' => $responseData['GatewayPageURL']]);
            // Redirect the user to the payment gateway
            //  return redirect($responseData['GatewayPageURL']);
        } catch (\Exception $e) {
            // Handle exceptions
            Log::error('Error initiating payment: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to initiate payment'], 500);
        }
    }

    public function success(Request $request)
    {

        Log::info($request->all());
        return redirect('http://localhost:3000/content/14');

        // Extract necessary data from the callback
        // $transactionId = $request->input('tran_id');
        // $status = $request->input('status');

        // // Perform any additional logic based on the success callback
        // if ($status === 'VALID') {
        //     // Payment was successful
        //     // Add your logic here, e.g., update the database, send email, etc.
        //     return view('success'); // Display a success view
        // } else {
        //     // Payment was not successful
        //     return view('error'); // Display an error view
        // }
    }
}
