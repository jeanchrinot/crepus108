<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicecategory;
use App\Models\Servicesubcategory;

class HomeController extends Controller
{
    public function index()
    {
    	// get all service categories
    	$service_subcategories = Servicesubcategory::all();

    	// Show home page
    	return view('index',compact('service_subcategories'));
    }
}
