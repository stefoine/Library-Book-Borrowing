<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookCopy extends Model
{
    protected $table = 'book_copies'; // 🔥 FORCE CORRECT TABLE NAME

    protected $fillable = [
        'book_id',
        'status'
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function borrowRecords()
    {
        return $this->hasMany(Borrow_Record::class, 'copy_id');
    }
}