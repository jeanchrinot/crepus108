<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicecategory;
use App\Models\Servicesubcategory;

class ServiceController extends Controller
{
    public function index()
    {
        $service_categories = Servicecategory::paginate(4);
    	// show service categories
    	return view('service',compact('service_categories'));
    }

    public function show($slug)
    {
        // get service category of the specific (slug)
        $service_category = Servicecategory::where('slug',$slug)->firstOrFail();

        // get all subcategories belonging to the specific category
        $service_subcategories = $service_category->servicesubcategories;

    	// Show single category subcategories page
    	return view('single-service-category',compact(['service_category','service_subcategories']));
    }

    public function reservation()
    {
    	return view('reservation');
    }

    public function condition()
    {
        // Show terms and condition 
        return view('condition');
    }
}
