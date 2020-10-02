<?php

namespace Database\Factories;

use App\Models\Servicesubcategory;
use App\Models\Servicecategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServicesubcategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Servicesubcategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'servicecategory_id'=>Servicecategory::inRandomOrder()->first()->id,
            'name'=>$this->faker->sentence(2,true),
            'slug'=>$this->faker->slug,
            'details'=>$this->faker->paragraph(3,true)
        ];
    }
}
