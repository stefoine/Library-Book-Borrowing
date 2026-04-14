<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BorrowRecord;
use App\Models\BookCopy;
use Illuminate\Support\Facades\Auth;
use App\Models\Borrow_Record; 

class BorrowRecordController extends Controller
{
    /**
     * Borrow a book copy
     */
    public function store(Request $request)
    {
        $request->validate([
            'copy_id' => 'required|exists:book_copies,id',
        ]);

        // prevent duplicate borrowing (same copy not borrowed twice)
        $alreadyBorrowed = Borrow_Record::where('copy_id', $request->copy_id)
            ->whereNull('return_date')
            ->first();

        if ($alreadyBorrowed) {
            return back()->with('error', 'This book copy is already borrowed.');
        }

        Borrow_Record::create([
            'copy_id' => $request->copy_id,
            'student_profile_id' => Auth::user()->studentProfile->id,
            'borrow_date' => now(),
        ]);

        return back()->with('success', 'Book borrowed successfully!');
    }

    /**
     * Return a book copy
     */
    public function returnBook($id)
    {
        $borrow = Borrow_Record::findOrFail($id);

        $borrow->update([
            'return_date' => now(),
        ]);

        return back()->with('success', 'Book returned successfully!');
    }
}