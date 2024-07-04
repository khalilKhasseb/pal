<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class CheckOutForm extends Form
{
    #[Validate('required')]
    public  $first_name;
    #[Validate('required')]
    public  $mid_name;
    #[Validate('required')]
    public  $last_name;
    #[Validate('required')]
    public  $email;
    #[Validate('required')]
    public  $phone;

    #[Validate('required')]
    public  $address;

    #[Validate('required')]
    public  $payment_type;
    #[Validate('required')]
    public  $payment_purpose;
    #[Validate('required')]
    public  $contact_before;

    public  $amount;
    public  $currency;

    public  $payment_details;

    public  $inputParam  = [];
}
