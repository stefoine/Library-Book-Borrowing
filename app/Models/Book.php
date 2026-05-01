<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    protected $fillable = ['title', 'author', 'isbn', 'stock'];

    // Relationship: A book can be in many borrowing records
    public function borrowDetails(): HasMany
    {
        return $this->hasMany(BorrowDetail::class);
    }
}