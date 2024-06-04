<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentCallbackController extends Controller
{
    public function __invoke(Request $request)
    {
        $paymentData =  $this->validateResponse($request);

        $this->performPaymentUpdate($paymentData);

        //$this->sendOrderEmail($order, $client);
        
        $this->preformRedirect();
    }


    protected function validateResponse(Request $request): array
    {
        return [];
    }

    protected function performPaymentUpdate(array $paymentData): Payment
    {
        $payment = Payment::find($paymentData['payment_id']);

        $payment->update([
            'response_time' => $paymentData['reponse_time'],
            'success' => $paymentData['status']
        ]);
        return $payment;
    }

    public function sendOrderEmail($order, $client)
    {
    }

    protected function preformRedirect(array $data = [])
    {
        return redirect()->route('payment.success')->with('data', $data);
    }
}
