<?php

// app/Livewire/Payment/PaymentForm.php
namespace App\Livewire\Payment;

use Livewire\Component;
// use App\Models\Payment;
use App\Models\PaymentInfo as Payment;
use App\Settings\SiteSetting;
use Google\Service\AdSensePlatform\Site;
use Lahza\PaymentGateway\Facades\Lahza;
use Lahza\PaymentGateway\Exceptions\PaymentValidationException;
use Lahza\PaymentGateway\Exceptions\ErrorCodes;

class PaymentForm extends Component
{
    public $full_name;
    public $email;
    public $mobile;
    public $address;
    public $purpose;
    public $classification; // Fixed typo
    public $amount;
    public $contact_before_payment = false;
    public bool $checkout_enabled = false;
    protected $rules = [
        'full_name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'mobile' => 'required|string|max:20',
        'address' => 'required|string|max:255',
        'purpose' => 'required|string|max:255',
        'classification' => 'required|string|max:255', // Fixed typo
        'amount' => 'required|numeric|min:1',
        'contact_before_payment' => 'boolean',
    ];

    // app/Livewire/Payment/PaymentForm.php
    public function submit()
    {
        try {
            $this->validate();

            // Generate human-readable reference first
            $reference = Payment::generateReference();

            $currency = Lahza::getDefaultCurrency();

            // Create payment record with reference
            $payment = Payment::create([
                'reference' => $reference,
                'full_name' => $this->full_name,
                'email' => $this->email,
                'mobile' => $this->mobile,
                'address' => $this->address,
                'purpose' => $this->purpose,
                'classification' => $this->classification,
                'amount' => $this->amount,
                'contact_before_payment' => $this->contact_before_payment,
                'status' => 'pending',
                'currency' => $currency
            ]);

            // Initialize transaction through package
            $response = Lahza::initializeTransaction([
                'reference' => $reference,
                'amount' => $this->amount,
                'email' => $this->email,
                'mobile' => $this->mobile,
                'currency' => $currency,
                'callback_url' => Lahza::getCallbackUrl(),
            ]);

            // Verify API accepted our reference
            if ($response->reference !== $reference) {
                throw new \Exception('Reference mismatch with payment gateway');
            }

            $payment->update(['api_response' => $response->toArray()]);

            return redirect()->away($response->authorizationUrl);
        } catch (PaymentValidationException $e) {
            // Handle package API validation errors
            $this->handleValidationErrors($e);
        } catch (\Exception $e) {
            // Handle other errors
            $this->handleGeneralErrors($e, $payment ?? null);
        }
    }
  

    public function mount(){
        
        $settings = app(SiteSetting::class);

        $this->checkout_enabled  = $settings->checkout_enabled;
    }
     

    public function render()
    {
    
        return view('livewire.payment.payment-form');
    }


    protected function handleValidationErrors(PaymentValidationException $e): void
    {
        // Get all validated fields from package rules
        $packageFields = [
            'email',
            'amount',
            'currency',
            'reference',
            'callback_url',
            'metadata'
        ];

        // Add main error message
        $this->addError('payment', $e->getMessage());

        // Add individual field errors
        foreach ($e->getContext()['errors'] as $field => $messages) {
            if (in_array($field, $packageFields)) {
                foreach ($messages as $message) {
                    $this->addError("payment.$field", $message);
                }
            }
        }
    }


    protected function handleGeneralErrors(\Exception $e, ?Payment $payment): void
    {
        if ($payment) {
            $payment->update(['status' => 'failed']);
        }

        $this->addError('payment', __('Payment failed: ') . $e->getMessage());

        // Log full error details for sysadmin
        logger()->error('Payment Error: ' . $e->getMessage(), [
            'exception' => $e,
            'payment' => $payment?->toArray()
        ]);
    }
}
