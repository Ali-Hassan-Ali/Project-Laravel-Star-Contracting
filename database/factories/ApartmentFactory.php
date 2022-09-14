<?php

namespace Database\Factories;
use App\Models\apartment;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApartmentFactory extends Factory
{
    protected $model = Apartment::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'        => $this->faker->name,
            'type'         => $this->faker->word,
            'floor'        => $this->faker->randomDigit,
            'city'         => $this->faker->name,
            'state'        => $this->faker->name,
            'dimensions'       => random_int(30, 2000),
            'small_room'       => random_int(0, 5),
            'medium_room'      => random_int(0, 3),
            'large_room'       => random_int(0, 2),
            'extra_large_room' => random_int(0, 1),
            'street'       =>  random_int(1, 220),
            'description'  => $this->faker->sentence,
            'price'        => random_int(20, 2000),
            'avilibalty'   => random_int(0,1),
            'available_at' => $this->faker->date(),
            'class'        => $this->faker->randomElement([1, 2,3]),
            'views'        => random_int(0, 30000)
        ];
    }
}
