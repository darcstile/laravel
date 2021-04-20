<?php

namespace Database\Factories;

use App\Models\book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'author' => $this -> faker ->name,
            'name' => $this -> faker ->text(10),
            'picture' => $this -> faker ->text(20),
            'reader_id' => $this->faker->unique()->numberBetween(1,5),
            'shelf_id' => $this->faker->numberBetween(1,5)

        ];
    }
}
