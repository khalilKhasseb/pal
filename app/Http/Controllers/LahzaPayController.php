<?php

namespace App\Http\Controllers;

use App\Models\PaymentInfo as Payment;
use Illuminate\Http\Request;
use Lahza\PaymentGateway\Facades\Lahza;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentSuccess;
use Mpdf\Mpdf;

class LahzaPayController extends Controller
{
    public function handleCallback(Request $request)
    {
        // Existing callback code remains unchanged
        $reference = $request->input('reference');

        if (!$reference) {
            logger()->error('Callback missing reference parameter', $request->all());
            abort(400, 'Invalid callback request');
        }

        $payment = Payment::where('reference', $reference)->first();

        if (!$payment) {
            logger()->error('Payment not found for reference', ['reference' => $reference]);
            abort(404, 'Payment record not found');
        }

        try {
            $verification = Lahza::verifyTransaction($reference);

            $payment->update([
                'status' => $verification->status,
                'api_response' => array_merge(
                    $payment->api_response ?? [],
                    ['verification' => $verification->toArray()]
                )
            ]);
            
            if($verification->status === 'success') {
                Mail::to($payment->email)->send(new PaymentSuccess($payment));
            }

            
            return $verification->status === 'success'
                ? redirect()->route('payment.success', $payment)
                : redirect()->route('payment.failure', $payment);
                
        } catch (\Exception $e) {
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
        
        try {
            // Create temporary directory if it doesn't exist
            $tempDir = storage_path('app/temp');
            if (!file_exists($tempDir)) {
                mkdir($tempDir, 0755, true);
            }
            
            // Copy fonts to public directory if they don't exist
            $fontSourceDir = resource_path('fonts');
            $fontDestDir = public_path('fonts');
            
            if (!file_exists($fontDestDir)) {
                mkdir($fontDestDir, 0755, true);
            }
            
            // Copy Arabic fonts if they don't exist in public directory
            if (file_exists($fontSourceDir . '/NotoSansArabic-Regular.ttf') && !file_exists($fontDestDir . '/NotoSansArabic-Regular.ttf')) {
                copy($fontSourceDir . '/NotoSansArabic-Regular.ttf', $fontDestDir . '/NotoSansArabic-Regular.ttf');
            }
            
            if (file_exists($fontSourceDir . '/NotoSansArabic-Bold.ttf') && !file_exists($fontDestDir . '/NotoSansArabic-Bold.ttf')) {
                copy($fontSourceDir . '/NotoSansArabic-Bold.ttf', $fontDestDir . '/NotoSansArabic-Bold.ttf');
            }
            
            // If the source fonts don't exist, log a warning
            if (!file_exists($fontSourceDir . '/NotoSansArabic-Regular.ttf')) {
                logger()->warning('NotoSansArabic font not found in resources/fonts directory.');
            }
            
            // Use mPDF instead of DomPDF for better Arabic support
            $mpdf = new Mpdf([
                'mode' => 'utf-8',
                'format' => 'A4',
                'margin_left' => 10,
                'margin_right' => 10,
                'margin_top' => 10,
                'margin_bottom' => 10,
                'tempDir' => $tempDir,
                'default_font' => 'CustomArabic'
            ]);
            
            $isRtl = app()->getLocale() === 'ar';
            
            // Set direction
            if ($isRtl) {
                $mpdf->SetDirectionality('rtl');
            }
            
            // Generate view content
            $html = view('lahza.recipent', [
                'payment' => $payment,
                'rtl' => $isRtl
            ])->render();
            
            // Load HTML content
            $mpdf->WriteHTML($html);
            
            // Set the filename
            $filename = "receipt-{$payment->reference}.pdf";
            
            // Output PDF as download
            return response($mpdf->Output($filename, 'S'))
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', "attachment; filename=\"$filename\"");
        } 
        catch (\Exception $e) {
            // Log any errors
            logger()->error('PDF generation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            abort(500, 'PDF generation failed: ' . $e->getMessage());
        }
    }
}