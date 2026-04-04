<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['title', 'author', 'genre'])]

class Book extends Model
{
    //RELATIONSHIPS
    public function bookCopies(): HasMany
    {
        return $this->hasMany('App\Models\Book_Copy');
    }
}
