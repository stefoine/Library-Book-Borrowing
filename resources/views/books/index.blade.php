<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="row mb-4">
        <div class="col">
            <h1>Books List</h1>
        </div>

        <div class="col text-end">
            <a href="{{ route('books.create') }}" class="btn btn-primary">
                Add New Book
            </a>
        </div>
    </div>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- ERROR MESSAGE --}}
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">

            <table class="table table-striped table-hover">

                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Genre</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($books as $book)

                    @php
                        // Check if ANY copy of this book is currently borrowed
                        $isBorrowed = $book->copies->contains(function ($copy) {
                            return $copy->borrowRecords->whereNull('return_date')->count() > 0;
                        });
                    @endphp

                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->genre }}</td>

                        <td class="d-flex gap-1 align-items-center">

                            {{-- VIEW --}}
                            <a href="{{ route('books.show', $book->id) }}"
                               class="btn btn-sm btn-info">
                                View
                            </a>

                            {{-- EDIT + DELETE (ADMIN ONLY) --}}
                            @if(auth()->check() && auth()->user()->role === 'admin')

                                <a href="{{ route('books.edit', $book->id) }}"
                                   class="btn btn-sm btn-warning">
                                    Edit
                                </a>

                                <form action="{{ route('books.destroy', $book->id) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Delete this book?')">
                                        Delete
                                    </button>

                                </form>

                            @endif

                            {{-- BORROW BUTTON --}}
                            @if($isBorrowed)
                                <button class="btn btn-sm btn-secondary" disabled>
                                    Borrowed
                                </button>
                            @else
                                <form action="{{ route('borrow.store') }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf

                                    {{-- IMPORTANT: replace later with book copy selection UI --}}
                                    <input type="hidden" name="copy_id"
                                           value="{{ $book->copies->first()->id ?? '' }}">

                                    <button class="btn btn-sm btn-success">
                                        Borrow
                                    </button>

                                </form>
                            @endif

                        </td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="4" class="text-center">
                            No books found.
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>
    </div>

</div>

</body>
</html>