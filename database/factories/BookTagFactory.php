<?php

namespace Database\Factories;

use App\Models\BookTag;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookTagFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BookTag::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'Tag_id' =>$this->faker->numberBetween(1,5),
            'Book_id' =>$this->faker->numberBetween(1,5)
        ];
    }
}
