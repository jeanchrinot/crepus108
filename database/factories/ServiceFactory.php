<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\Servicesubcategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'servicesubcategory_id'=>Servicesubcategory::inRandomOrder()->first()->id,
            'name'=>$this->faker->sentence(3,true),
            'slug'=>$this->faker->slug,
            'details'=>$this->faker->paragraph(3,true),
            'price'=>$this->faker->numerify('##.###'),
            'duration'=>120
        ];
    }
}
