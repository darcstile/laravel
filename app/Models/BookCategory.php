<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookCategory extends Model
{
    use HasFactory;
    public function books(){
        return $this->belongsToMany(Book::class);
    }
    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    protected $table = 'Book_Category';
    protected $fillable
        = [
            'category_id',
        ];
}
