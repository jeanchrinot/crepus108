<?php

namespace Database\Factories;

use App\Models\Servicecategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServicecategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Servicecategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->sentence(2,true),
            'slug'=>$this->faker->slug,
            'details'=>$this->faker->paragraph(3,true)
        ];
    }
}
