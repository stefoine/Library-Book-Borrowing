@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Books</h1>
    
    @if(auth()->user()->is_admin)
        <a href="{{ route('books.create') }}" class="btn btn-primary mb-3">Add New Book</a>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
            <tr>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->stock }}</td>
                <td>
                    {{-- Users can Borrow --}}
                    @if($book->stock > 0)
                        <form action="{{ route('borrows.store') }}" method="POST" style="display:inline;">
                            @csrf
                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                            <button class="btn btn-sm btn-success">Borrow</button>
                        </form>
                    @endif

                    {{-- REQUIREMENT: Hide Edit/Delete for non-admins --}}
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection