<?php

namespace Database\Factories;

use App\Models\BookCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BookCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'Category_id' =>$this->faker->numberBetween(1,5),
            'Book_id' =>$this->faker->unique()->numberBetween(1,5)
        ];
    }
}
