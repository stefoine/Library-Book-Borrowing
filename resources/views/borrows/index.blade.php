<h1>My Borrowed Books</h1>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Book</th>
            <th>Borrow Date</th>
            <th>Return Date</th>
            <th>Status</th>
        </tr>
    </thead>

    <tbody>
        @foreach($borrows as $borrow)
            <tr>
                <td>{{ $borrow->copy->book->title }}</td>
                <td>{{ $borrow->borrow_date }}</td>
                <td>{{ $borrow->return_date ?? 'Not returned' }}</td>
                <td>
                    @if($borrow->return_date)
                        <span class="text-success">Returned</span>
                    @else
                        <span class="text-danger">Borrowed</span>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>