<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required',
            'details' => 'required'
        ]);

        Contact::create($request->all());

        return response()->json(['success' => 'Thank you for contacting us. we will contact you shortly.']);
    }
}
