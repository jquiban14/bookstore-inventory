
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <title>Bookstore Inventory Report</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #333;
            margin: 25px;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
        }

        .header h1 {
            color: #1e293b;
            margin-bottom: 5px;
            font-size: 22px;
        }

        .header p {
            color: #64748b;
            font-size: 10px;
        }

        .summary {
            margin-bottom: 15px;
            padding: 10px;
            background-color: #f1f5f9;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #1e293b;
            color: white;
            padding: 10px 7px;
            text-align: left;
        }

        td {
            border: 1px solid #ddd;
            padding: 9px 7px;
        }

        tr:nth-child(even) {
            background-color: #f8fafc;
        }

        .available {
            color: #15803d;
            font-weight: bold;
        }

        .unavailable {
            color: #dc2626;
            font-weight: bold;
        }

        .footer {
            margin-top: 25px;
            text-align: right;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <!-- Report Header -->
    <div class="header">

        <h1>BOOKSTORE INVENTORY</h1>

        <p>Inventory Management System</p>

        <p>
            Generated on:
            {{ now()->format('F d, Y h:i A') }}
        </p>

    </div>

    <!-- Report Summary -->
    <div class="summary">

        <strong>Total Matching Records:</strong>
        {{ $books->count() }}

    </div>

    <!-- Book Records -->
    <table>

        <thead>
            <tr>
                <th>Book Title</th>
                <th>Author</th>
                <th>Category</th>
                <th>Unit Price</th>
                <th>Availability</th>
            </tr>
        </thead>

        <tbody>

            @forelse($books as $book)

                <tr>

                    <td>{{ $book->title }}</td>

                    <td>{{ $book->author }}</td>

                    <td>{{ $book->category }}</td>

                    <td>
                        PHP {{ number_format($book->unit_price, 2) }}
                    </td>

                    <td class="{{ $book->availability_status == 'Available' ? 'available' : 'unavailable' }}">
                        {{ $book->availability_status }}
                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="5" style="text-align:center;">
                        No records match your selected filters.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

    <!-- Footer -->
    <div class="footer">

        Total Books: {{ $books->count() }}

    </div>

</body>
</html>
