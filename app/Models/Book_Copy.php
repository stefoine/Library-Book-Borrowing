<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['book_id', 'copy_number', 'status'])]

class Book_Copy extends Model
{
    //RELATIONSHIPS
    public function book(): BelongsTo
    {
        return $this->belongsTo('App\Models\Book');
    }
}
