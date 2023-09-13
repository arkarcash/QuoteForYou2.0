<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\BookAuthor;
use App\Models\BookCategory;
use Database\Factories\BookCategoryFactory;
use Database\Factories\BookFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        BookAuthor::factory()->count(4)->create();
        BookCategory::factory()->count(4)->create();
        Book::factory()->count(1500)->create();
    }
}
