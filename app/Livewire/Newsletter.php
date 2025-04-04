<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;
// use NZTim\Mailchimp\Mailchimp;
use NZTim\Mailchimp\MailchimpFacade as Mailchimp;

class Newsletter extends Component
{
    #[Validate('required|email')]
    public string $email;

    protected string $listId = '78523cf050';
    public function render()
    {
        return view('livewire.newsletter');
    }

    public function subscribe()
    {
        if (empty($this->email) || is_null($this->email)) return;

        if (!env('MAILCHIMP_API_KEY')) {
session()->flash('error', __('Error: Mailchimp API key is not set. Please contact the site administrator for more information or to report this issue.'));            return back();
        }

        Mailchimp::subscribe($this->listId, $this->email, $merge = [], $confirm = true);

        session()->flash('message', __('Subscribed'));

        // check if is subscribed befoe
        // Mailchimp::check()
    }
}
