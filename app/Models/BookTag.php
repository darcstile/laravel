<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookTag extends Model
{
    use HasFactory;
    public function books(){
        return $this->belongsToMany(Book::class);
    }
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }


    protected $table = 'Book_Tag';
    protected $fillable
        = [
            'tag_id',
        ];
}
