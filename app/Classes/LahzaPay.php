<?php

namespace App\Classes;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LahzaPay
{
    private string $currency = 'ILS';
    private string $base_url = 'https://api.lahza.io/';
    private string $secret_key = 'sk_test_nkJovINrNTrEFAvxRKgmbQX1Mw1J0XO5P';

    protected PendingRequest | Http $client;


    public function __construct()
    {
        // Initialize the HTTP client with the base URL and headers
        $this->client = Http::baseUrl($this->base_url)
            ->withToken($this->secret_key)
            ->withHeaders([
                'Content-Type' => 'application/json',
            ]);
    }



    public function pay(string $amount, string $email, string $mobile, string $callbackUrl = null)
    {


        $amountInLowestUnit = $amount * 100;

        // Generate a unique transaction reference
        $reference = uniqid('txn_');

        // Prepare the request payload
        $payload = [
            'email' => $email,
            'mobile' => $mobile,
            'amount' => $amountInLowestUnit,
            'reference' => $reference,
        ];

        if ($callbackUrl) {
            $payload['callback_url'] = $callbackUrl;
        }

        // Send the POST request to initialize the transaction
        $response = $this->client->post('/transaction/initialize', $payload);

         return $response;    
    }

    public function handleCallback(Request $request)
    {
        $reference = $request->query('reference');

        if (!$reference) {
            return redirect('/')->withErrors(['message' => 'Transaction reference not found']);
        }

        try {
            // Verify the transaction status
            $response = $this->client->get('/transaction/verify/' . $reference);

            if ($response->successful()) {
                $responseData = $response->json();

                if ($responseData['status'] === true) {
                    // Update the payment record in the database
                    // $payment = Payment::where('reference', $reference)->first();

                    if (!isset($payment)) {
                        // return redirect('/')->withErrors(['message' => 'Payment record not found']);

                        //     $payment->update([
                        //         'status' => 'successful',
                        //     ]);

                        // Redirect to a success page or perform any other necessary actions
                        return redirect('/payment-success')->with('message', 'Payment successful');
                    } else {
                        return redirect('/')->withErrors(['message' => 'Payment record not found']);
                    }
                } else {
                    // Handle unsuccessful verification response
                    return redirect('/')->withErrors(['message' => $responseData['message']]);
                }
            } else {
                // Handle unsuccessful HTTP response
                return redirect('/')->withErrors(['message' => $response->json()['message'] ?? 'An error occurred']);
            }
        } catch (\Exception $e) {
            // Handle exceptions
            return redirect('/')->withErrors(['message' => $e->getMessage()]);
        }
    }
}
