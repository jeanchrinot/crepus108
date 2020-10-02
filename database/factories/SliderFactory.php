<?php

namespace Database\Factories;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Factories\Factory;

class SliderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Slider::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title_1'=>$this->faker->sentence(2,true),
            'title_2'=>$this->faker->sentence(2,true),
            'description'=>$this->faker->paragraph(2,true),
            'image'=>'slider1.jpg'
        ];
    }
}
