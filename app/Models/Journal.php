<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;

    public function reader(){
        return $this->belongsTo(Reader::class);
    }
    public function book(){
        return $this->belongsTo(Book::class);
    }

    protected $fillable
        = [
            'book_id',
            'reader_id',
            'date_take',
            'date_return',
            'status',

        ];
}
