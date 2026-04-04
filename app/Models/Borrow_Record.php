<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['copy_id', 'student_profile_id', 'borrow_date', 'return_date'])]

class Borrow_Record extends Model
{
    //RELATIONSHIPS
    public function book_copy(): BelongsTo
    {
        return $this->belongsTo('App\Models\Book_Copy', 'copy_id');
    }

    public function student_profile(): BelongsTo
    {
        return $this->belongsTo('App\Models\Student_Profile', 'student_profile_id');
    }   
}
