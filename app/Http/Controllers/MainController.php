<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\Shelf;
use App\Models\Reader;

class MainController extends Controller
{
    public function index()
    {
        //$categories = Сategory::all();
        $books = Book::all();
        foreach ($books as $book) {
            $book->category;
            $book->tag;
            $book->shelf;
            $book->reader;

        }
        return view('home',compact('books'));
    }
}
