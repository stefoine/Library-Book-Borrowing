<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasMany;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'genre',
    ];

    // Book has many copies
    public function copies()
    {
        return $this->hasMany(\App\Models\BookCopy::class, 'book_id');
    }
}