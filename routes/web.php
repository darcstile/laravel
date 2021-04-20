<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $test = 'Hi';
    return view('home', compact('test'));
});

Route::get('/about', function () {
    return view('home');
});

//$categories = \App\Models\Category\all();
//$books = \App\Models\Book::all();
//foreach ($books as $book){
//    echo 'Book:' .$book['name'].'<br>';
//    echo '<b>Category:</b><br>';
//    foreach ($book->category as $category){
//        echo $category['category'].'<br>';
//    }
//}
//$books = \App\Models\Book::all();
//$categories = \App\Models\Category::all();
//foreach ($books as $book){
//    echo 'Book:' .$book['name'].'<br>';
//    echo '<b>Category:</b><br>';
//    foreach ($book->categories as $category){
//        echo $category['category'].'<br>';
//    }
//}
//foreach ($categories as $category){
//    echo 'category:' .$category['category'].'<br>';
//    echo '<b>Category:</b><br>';
//    foreach ($category->books as $book){
//        echo $book['name'].'<br>';
//    }
//}
