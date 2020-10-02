<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\Servicecategory::factory()->count(5)->create();
        // \App\Models\Servicesubcategory::factory()->count(10)->create();
        // \App\Models\Service::factory()->count(20)->create(); 
        // \App\Models\Slider::factory()->count(3)->create(); 
        // \App\Models\Testimonial::factory()->count(5)->create(); 
        \App\Models\Contact::factory()->create(); 
        \App\Models\Brand::factory()->count(10)->create();
        \App\Models\About::factory()->create(); 
        \App\Models\Social::factory()->create();
        \App\Models\Condition::factory()->create();

     //    $this->call([
	    //     ServicesubcategorySeeder::class,
	    // ]);
    }
}
