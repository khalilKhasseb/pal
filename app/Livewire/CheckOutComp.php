<?php

namespace App\Livewire;

use App\Models\Payment;
use App\Models\Order;
use App\Settings\GateWaySettings;
use Livewire\Component;
use App\Livewire\Forms\CheckOutForm;
use App\Settings\SiteSetting;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Renderless;

class CheckOutComp extends Component
{
    // form bindings

    public CheckOutForm  $form;

    public $auth_url;
    #[Renderless]
    public $cap;
    protected int $payment_id;

    protected SiteSetting $settings;
    public function mount()
    {
        $this->settings = app(SiteSetting::class);
        $this->auth_url = $this->getGateWaySettings('autorize_url');

        $this->checkoutEnabled();
    }
    public function render()
    {
        return view('livewire.check-out-comp');
    }

    public function deletePayment(int $id): void
    {
        Payment::find($id)->delete();
        $this->form->reset();
    }
    public function proccessPayment()
    {
        // $this->validateRecpatcha();
        $this->validate();

        $payment = $this->createPayment($this->form->all());

        $this->payment_id = $payment->id;

        return $payment;

        // $this->handelRedirectToPaymentPage($payment);
    }

    public function sendTokenToValidate($token)
    {
        $this->dispatch('cap-confirmed', $this->cap);
        $this->skipRender();
    }
    #[RenderLess]
    public function virify($token)
    {
        $response = $this->virifyRecap($token);


        if ($response['success'] && $response['score'] > 0.3) {

            return $this->dispatch('cap-confirmed', [
                'message' => __('You had confirem and validate Recpatcha check wait to redirect to checkout page...'),
                "success" => $response['success']
            ]);
        }
        if (!is_null($this->getPaymentId())) :

            Payment::find($this->payment_id)->deleteOrFail();
        endif;
        $this->dispatch('cap-confirmed', [
            'message' => __('Refresh the page and try again'),
            "success" => $response['success']
        ]);
        $this->form->reset();
    }

    public function checkoutEnabled(): bool
    {
        // get seettings to check if are filled;
        $unFilledSettings = array_filter($this->getGateWaySettings()->toArray(), fn ($option) => is_null($option));


        // checkout correctly enabled
        $enabled = empty($unFilledSettings) && $this->settings->checkout_enabled;

        // log un filed options;

        if (!$enabled) {

            file_put_contents(base_path('unfield.json'), json_encode($unFilledSettings));
        }

        return $enabled;

        // check settings if enabled
    }
    protected function virifyRecap($token)
    {
        $virify_url = 'https://www.google.com/recaptcha/api/siteverify';

        $response = Http::asForm()->post($virify_url, [
            'secret' => config('google.cap.site_secret'),
            'response' => $token,
        ]);
        return $response->json();
    }

    protected function createPayment(array $payment): Payment
    {

        $payment['currency'] = $this->getGateWaySettings()['currency_code'];
        $payment['status'] = 'unprocessed';


        $payment = Payment::create($payment);

        $orderTitle = $payment->first_name . " " . $payment->payment_type . " " . $payment->amount;
        $order = Order::create([
            'title' => Str::of($orderTitle)->title(),
            'order_generated_id' => (string) Str::uuid()
        ]);
        $payment->order()->save($order);

        $this->form->inputParam = $this->inputs($payment);

        $this->dispatch('paymentCreated', [
            'payment' => $payment,
            'inputs' => $this->inputs($payment)
        ]);

        return $payment;
    }

    protected function inputs(Payment|Collection $payment): array
    {

        $signature = base64_encode(
            pack(
                'H*',
                sha1(
                    $this->getSignatureValues($payment->order->order_generated_id, $payment->amount)
                )
            )
        );
        $inputs = [
            'Version' => $this->getGateWaySettings('version'),
            'MerID'   => $this->getGateWaySettings('merchant_id'),
            'AcqID'   => $this->getGateWaySettings('acquire_id'),
            'MerRespURL'   => $this->getGateWaySettings('callback_url'),
            'PurchaseAmt'   => $this->getGateWaySettings('acquire_id'),
            'PurchaseCurrency'   => $this->getGateWaySettings('currency_code'),
            'PurchaseCurrencyExponent'   => $this->getGateWaySettings('currency_exp'),
            'OrderID'   => $payment->order->order_generated_id,
            "CaptureFlag" => $this->getGateWaySettings('capture_flag'),
            "Signature" => $signature,
            "SignatureMethod" => $this->getGateWaySettings('signture_method'),
        ];

        return $inputs;
    }

    protected function getGateWaySettings($key = null): Collection | string
    {

        $gatWaySettings = app(GateWaySettings::class)->toCollection();
        if (!is_null($key) && isset($gatWaySettings[$key])) :
            return $gatWaySettings[$key];
        endif;
        return  $gatWaySettings;
    }

    private function getSignatureValues($order_id, $amount): string
    {
        // $password.$merchantID.$acquireID.$orderID.$purchaseAmt.$PurchaseCurrency;
        $settings = [
            $this->getGateWaySettings('merchant_password'),
            $this->getGateWaySettings('merchant_id'),
            $this->getGateWaySettings('acquire_id'),
            $order_id,
            $amount,
            $this->getGateWaySettings('currency_code')
        ];
        return implode($settings);
    }
    protected function setPaymentId(int $id)
    {
        $this->payment_id = $id;
    }

    public function getPaymentId(): int | null
    {
        return isset($this->payment_id) && !is_null($this->payment_id)
            ? $this->payment_id
            : null;
    }
}
