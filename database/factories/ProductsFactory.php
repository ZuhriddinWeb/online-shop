<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = \Faker\Factory::create();

        return [
            'section_id' => '605436819',
            'blog_id' => '605436820',
            'lesson_id' => 1,
            'quetion_id' => 1,
            'answer_check' => 1,
            'answer' => $faker->text(30),
        ];
    }
}
