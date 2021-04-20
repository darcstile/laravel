<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reader;
use App\Models\Shelf;
use App\Models\Book;



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
        Book::factory(5)->create();
    }
}
