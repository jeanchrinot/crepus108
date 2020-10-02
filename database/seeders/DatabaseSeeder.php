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

        \App\Models\Servicecategory::factory()->count(5)->create();
        \App\Models\Servicesubcategory::factory()->count(10)->create();
        \App\Models\Service::factory()->count(20)->create(); 

     //    $this->call([
	    //     ServicesubcategorySeeder::class,
	    // ]);
    }
}
