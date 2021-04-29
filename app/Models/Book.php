<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{


    use HasFactory;

    public function reader(){
        return $this->belongsTo(reader::class);
    }
    public function shelf(){
        return $this->belongsTo(shelf::class);
    }
    public function categories(){
        return $this->belongsToMany(Category::class);
    }
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    protected $fillable
        = [
            'name',
            'author',
            'category',
            'shelf_id',
            'tag',
            'reader_id',
            'date_take',
            'picture',
            'book_id',
        ];
}
