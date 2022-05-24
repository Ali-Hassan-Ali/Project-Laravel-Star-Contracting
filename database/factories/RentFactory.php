<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' =>  rand(1,100),
            'apartment_id' => rand(1,100),
            'status' =>  random_int(0, 2),
            'Rented' =>random_int(0, 1)
            //
        ];
    }
}
