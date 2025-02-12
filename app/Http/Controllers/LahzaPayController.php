<?php

namespace App\Http\Controllers;

use App\Models\PaymentInfo as Payment;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Lahza\PaymentGateway\Facades\Lahza;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentSuccess;
class LahzaPayController extends Controller
{
    public function handleCallback(Request $request)
    {
        // 1. Validate reference exists in request
        $reference = $request->input('reference');

        if (!$reference) {
            logger()->error('Callback missing reference parameter', $request->all());
            abort(400, 'Invalid callback request');
        }

        // 2. Find payment by reference
        $payment = Payment::where('reference', $reference)->first();

        if (!$payment) {
            logger()->error('Payment not found for reference', ['reference' => $reference]);
            abort(404, 'Payment record not found');
        }

        try {
            // 3. Verify transaction through package
            $verification = Lahza::verifyTransaction($reference);

            // 4. Update payment record
            $payment->update([
                'status' => $verification->status,
                'api_response' => array_merge(
                    $payment->api_response ?? [],
                    ['verification' => $verification->toArray()]
                )
            ]);

            // 5. Redirect based on status test staging or live

            if($verification->status === 'success') {
                Mail::to($payment->email)->send(new PaymentSuccess($payment));
            }
            return $verification->status === 'success'
                ? redirect()->route('payment.success', $payment)
                : redirect()->route('payment.failure', $payment);
        } catch (\Exception $e) {
            // 6. Handle verification errors
            $payment->update(['status' => 'failed']);
            logger()->error('Payment verification failed', [
                'reference' => $reference,
                'error' => $e->getMessage()
            ]);
            return redirect()->route('payment.failure', $payment);
        }
    }

    public function downloadReceipt(Payment $payment)
    {
        if ($payment->status !== 'success') {
            abort(403, 'Receipt unavailable for incomplete payments');
        }
    
        $pdf = PDF::loadView('lahza.recipent', [
            'payment' => $payment,
            'rtl' => app()->getLocale() === 'ar'
        ])->setOption('defaultFont', 'Noto Sans Arabic');
    
        return $pdf->download("receipt-{$payment->reference}.pdf");
    }
}
