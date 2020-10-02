<?php

namespace Database\Factories;

use App\Models\About;
use Illuminate\Database\Eloquent\Factories\Factory;

class AboutFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = About::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>'Crépus Valo abmin\'ny zato',
            'about_short'=>'CREPUS 108 ou CREPUS "Valo ambiny zato", est une coiffeuse a domicile spécialisée pour l\'entretien des cheveux naturels (crépu, bouclés, frisés, lisses).'
        ];
    }
}
