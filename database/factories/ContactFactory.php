<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contact;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            
            'first_name' =>$this->faker->firstName,
            'last_name' =>$this->faker->lastName,
            'phone' =>$this->faker->phoneNumber,
            'email' =>$this->faker->email,
            'adress' =>$this->faker->address,
            'user_id' =>User::factory(),
            'company_id' =>Company::pluck('id')->random(),
            


        ];
    }
}
