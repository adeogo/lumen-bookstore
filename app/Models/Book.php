<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Book extends Model
{
    protected $table = 'books';

    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany(BookCategory::class, 'book_category_assignments', 'book_id', 'category_id');
    }
    
    public function tags()
    {
        return $this->belongsToMany(BookTag::class, 'book_tag_assignments', 'book_id', 'tag_id');
    }
}