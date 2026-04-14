<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('copies.borrowRecords')->get();

        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'genre' => 'nullable',
        ]);

        Book::create($request->only('title', 'author', 'genre'));

        return redirect()->route('books.index')
            ->with('success', 'Book created successfully!');
    }

    public function show($id)
    {
        $book = Book::with('copies.borrowRecords')->findOrFail($id);

        return view('books.show', compact('book'));
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);

        return view('books.edit', compact('book'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'genre' => 'nullable',
        ]);

        $book = Book::findOrFail($id);

        $book->update($request->only('title', 'author', 'genre'));

        return redirect()->route('books.index')
            ->with('success', 'Book updated successfully!');
    }

    public function destroy($id)
    {
        Book::findOrFail($id)->delete();

        return redirect()->route('books.index')
            ->with('success', 'Book deleted successfully!');
    }
}