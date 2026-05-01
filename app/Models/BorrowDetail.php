<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BorrowDetail extends Model
{
    protected $fillable = ['user_id', 'book_id', 'borrowed_at', 'returned_at'];

    // Eager loading helper: Belongs to a User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Eager loading helper: Belongs to a Book
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}