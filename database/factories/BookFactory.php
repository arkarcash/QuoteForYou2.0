<?php

namespace Database\Factories;

use App\Models\BookAuthor;
use App\Models\BookCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'title' => $this->faker->name(),
            'description' => $this->faker->paragraph(),
            'photo' => 'fasdf',
            'is_premium' => random_int(0,1),
            'points' => random_int(20,100),
            'link' => 'sadfds',
            'e_book' => 'asdf',
            'book_category_id' => BookCategory::get()->random()->id,
            'book_author_id' => BookAuthor::get()->random()->id,

        ];
    }
}
