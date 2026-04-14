<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\BorrowRecord;

#[Fillable(['student_id', 'grade_level', 'section'])]

class Student_Profile extends Model
{
    //RELATIONSHIPS
    public function student(): BelongsTo
    {
        return $this->belongsTo('App\Models\Student');
    }

    public function borrowRecords()
    {
        return $this->hasMany('App\Models\BorrowRecord');
    }
}
