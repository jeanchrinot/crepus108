<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use App\Models\Servicecategory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        // Get all service categories
        $menu_service_categories = Servicecategory::all();
        $about = \App\Models\About::where('id',1)->get('about_short')->first();
        $social = \App\Models\Social::find(1);
        $header_contact = \App\Models\Contact::where('id',1)->get(['phone','email'])->first();
        View::share('menu_service_categories', $menu_service_categories);
        View::share('about', $about);
        View::share('social', $social);
        View::share('header_contact', $header_contact);
    }
}
