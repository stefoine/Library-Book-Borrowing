<?php

namespace App\Http\Controllers;

use App\Models\BorrowDetail;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowDetailController extends Controller
{
    public function index()
    {
        // Requirement 1: Use Eager Loading (with user and book)
        $query = BorrowDetail::with(['user', 'book']);

        // Requirement 2: Only authenticated users access their own entities
        if (!Auth::user()->is_admin) {
            $query->where('user_id', Auth::id());
        }

        $borrows = $query->latest()->get();
        return view('borrows.index', compact('borrows'));
    }

    public function store(Request $request)
    {
        $request->validate(['book_id' => 'required|exists:books,id']);

        $book = Book::findOrFail($request->book_id);
        
        if ($book->stock <= 0) {
            return back()->with('error', 'Book is out of stock.');
        }

        BorrowDetail::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'borrowed_at' => now(),
        ]);

        $book->decrement('stock');

        return redirect()->route('borrows.index')->with('success', 'Book borrowed!');
    }

    public function destroy(BorrowDetail $borrow)
    {
        // Only admin or the owner can delete
        if (Auth::user()->is_admin || Auth::id() == $borrow->user_id) {
            $borrow->book->increment('stock');
            $borrow->delete();
            return back()->with('success', 'Record deleted.');
        }
        abort(403);
    }
}