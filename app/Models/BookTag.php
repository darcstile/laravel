<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookTag extends Model
{
    use HasFactory;

    protected $table = 'Book_Tag';
    protected $fillable
        = [
            'tag_id',
        ];
}
