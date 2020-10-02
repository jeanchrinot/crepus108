<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
    	// get contact
    	$contact = Contact::find(1);

    	// show contact us page
    	return view('contact',compact('contact'));
    }
}
