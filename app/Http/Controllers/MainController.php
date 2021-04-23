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
        $books = Book::all();
        return view('home',compact('books'));
    }

    public function newbook()
    {
        $books = Book::all();
        $shelves = Shelf::all();
        return view('newbook',compact('shelves'));
    }
}
