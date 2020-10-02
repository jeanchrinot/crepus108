<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Servicesubcategory;

class ServicesubcategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Servicesubcategory::factory()->count(10)->create();
    }
}
