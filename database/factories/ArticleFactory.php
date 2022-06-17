<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'subject' => $this->faker->sentence(mt_rand(3,5), false),
            'content' => $this->faker->paragraphs(mt_rand(5, 15), true),
            'category_id' => mt_rand(2,4)
        ];
    }
}
