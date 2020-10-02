<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>'Crépus108',
            'phone'=>$this->faker->e164PhoneNumber,
            'phone2'=>$this->faker->e164PhoneNumber,
            'email'=>'contact@crepus108.com',
            'email2'=>'crepus108@gmail.com',
            'address'=>$this->faker->address,
            'address2'=>$this->faker->address
        ];
    }
}
