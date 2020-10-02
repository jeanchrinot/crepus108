<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicecategory;
use App\Models\Servicesubcategory;
use App\Models\Slider;
use App\Models\Testimonial;
use App\Models\Contact;
use App\Models\Brand;

class HomeController extends Controller
{
    public function index()
    {
    	// Get all sliders
    	$sliders = Slider::all();
    	// get all service categories
    	$service_subcategories = Servicesubcategory::all();

    	// get all testimonials
    	$testimonials = Testimonial::all();

    	// get contact
    	$contact = Contact::find(1);

    	// get all brands 
    	$brands = Brand::where('status',true)->get();

    	// Show home page
    	return view('index',compact(['sliders','service_subcategories','testimonials','contact','brands']));
    }
}
