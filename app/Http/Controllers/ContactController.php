<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __invoke(Request $request) {

        Contact::create($request->all()) ;

        return redirect()->back()->with('Message' , __('Your message sent.'));
    }
}
