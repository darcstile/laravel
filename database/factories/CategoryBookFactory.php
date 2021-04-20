<?php

namespace Database\Factories;

use App\Models\CategoryBook;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryBookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CategoryBook::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'Category_id' =>$this->faker->numberBetween(1,5),
            'Book_id' =>$this->faker->numberBetween(1,5)
        ];
    }
}
