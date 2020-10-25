<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicecategory;
use App\Models\Servicesubcategory;
use App\Models\Condition;

class ServiceController extends Controller
{
    public function index()
    {
        // Get all service categories - Show 4 items at a time
        $service_categories = Servicecategory::paginate(4);

        // Page banner title
        $page_banner = ['Services',''];
        $breadcrumb = 'Services';

    	// show service categories
    	return view('service',compact(['page_banner','service_categories','breadcrumb']));
    }

    public function show($slug)
    {
        // get service category of the specific (slug)
        $service_category = Servicecategory::where('slug',$slug)->firstOrFail();

        // get all subcategories belonging to the specific category
        $service_subcategories = $service_category->servicesubcategories;

        // Page banner title
        $page_banner = ['Services',$service_category->name];

        $breadcrumb = 'Services / '.$service_category->name;

    	// Show single category subcategories page
    	return view('single-service-category',compact(['page_banner','service_category','service_subcategories','breadcrumb']));
    }

    public function reservation()
    {
        $breadcrumb = 'Services / Réservation';
    	return view('reservation',compact(['breadcrumb']));
    }

    public function condition()
    {
        $breadcrumb = 'Conditions';
        $condition = Condition::findOrFail(1);

        // Show terms and condition 
        return view('condition',compact(['breadcrumb','condition']));
    }
}
