<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Log;
use GuzzleHttp\Client;
use App\Models\DownloadedContent;
use App\Models\TransactionDetails;
use App\Models\Content;

class PaymentController extends Controller
{
    //
    public function initiatePayment(Request $request)
    {

        $userId = auth('api')->user()->id;
        $store_id = 'nokib5fa913a013777';
        $store_password = 'nokib5fa913a013777@ssl';
        $contentId = $request->contentId;
        $content = Content::where('id', $contentId)->first();
        $price = $content->price;
        $client = new Client();
        $transationId = $userId . str_pad(mt_rand(1, 99999999), 8, '0', STR_PAD_LEFT);
        $paymentData = [
            'store_id' => $store_id,
            'store_passwd' => $store_password,
            'total_amount' => $price,
            'currency' => 'BDT',
            'tran_id' => $transationId,
            'success_url' => env('APP_URL') . 'success',
            'fail_url' => env('APP_URL') . 'fail',
            'cancel_url' => env('APP_URL') . 'cancel',
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
            'value_a' => $contentId,
            'value_b' => $userId,
            'value_c' => 'ref003_C',
            'value_d' => 'ref004_D',
            'shipping_method' => 'No',
            'product_name' => 'Test',
            'product_category' => 'test',
            'product_profile' => 'general',
            'product_id' => $contentId,
        ];

        try {
            $response = $client->post('https://sandbox.sslcommerz.com/gwprocess/v4/api.php', [
                'form_params' => $paymentData,
            ]);

            $responseData = json_decode($response->getBody(), true);

            return $this->successJsonResponse('test', ['redirectUrl' => $responseData['GatewayPageURL']]);

        } catch (\Exception $e) {
            // Handle exceptions
            Log::error('Error initiating payment: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to initiate payment'], 500);
        }
    }

    public function success(Request $request)
    {

        $contentId = (int) $request->value_a;
        $tranId = $request->tran_id;
        $amount = $request->amount;
        $transactionDate = $request->tran_date;
        $cardIssuer = $request->card_issuer;
        $cardBrand = $request->card_brand;
        $storeAmount = $request->store_amount;
        $cardType = $request->card_type;
        $userID = $request->value_b;

        $transactionDetail = new TransactionDetails();
        $transactionDetail->user_id = $userID;
        $transactionDetail->content_id = $contentId;
        $transactionDetail->tran_id = $tranId;
        $transactionDetail->amount = $amount;
        $transactionDetail->transaction_date = $transactionDate;
        $transactionDetail->card_issuer = $cardIssuer;
        $transactionDetail->card_brand = $cardBrand;
        $transactionDetail->store_amount = $storeAmount;
        $transactionDetail->card_type = $cardType;
        $transactionDetail->save();


        $downloadedContent = new DownloadedContent();
        $downloadedContent->user_id = $userID;
        $downloadedContent->content_id = $contentId;
        $downloadedContent->save();

        return redirect('http://localhost:3000/content/' . $contentId);

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
