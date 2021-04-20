<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reader;
use App\Models\Shelf;
use App\Models\Book;
use App\Models\Category;
use App\Models\Tag;
use App\Models\CategoryBook;
use App\Models\TagBook;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        //Reader::factory(5)->create();
        //Shelf::factory(5)->create();
       // Category::factory(5)->create();
       // Tag::factory(5)->create();
        CategoryBook::factory(5)->create();
        TagBook::factory(5)->create();
    }
}
