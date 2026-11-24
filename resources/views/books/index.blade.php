
@extends('layouts.bookstore')

@section('title', 'Book Inventory')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- Header -->
    <div class="flex justify-between items-center mb-8">

        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                Book Inventory
            </h1>

            <p class="text-gray-500 mt-2">
                Manage your bookstore collection.
            </p>
        </div>

        <a href="{{ route('books.create') }}"
            class="bg-blue-600 text-white px-5 py-3 rounded-lg hover:bg-blue-700">
            + Add New Book
        </a>

    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- Book Table -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">

        <div class="p-6 border-b">
            <h2 class="text-lg font-semibold text-gray-800">
                All Books
            </h2>

            <p class="text-sm text-gray-500">
                Total Records: {{ $books->count() }}
            </p>
        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-left">

                <thead class="bg-gray-100 text-gray-600 text-sm uppercase">

                    <tr>
                        <th class="px-6 py-4">Book Title</th>
                        <th class="px-6 py-4">Author</th>
                        <th class="px-6 py-4">Category</th>
                        <th class="px-6 py-4">Price</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Actions</th>
                    </tr>

                </thead>

                <tbody class="divide-y">

                    @forelse($books as $book)

                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4 font-medium text-gray-800">
                                {{ $book->title }}
                            </td>

                            <td class="px-6 py-4 text-gray-600">
                                {{ $book->author }}
                            </td>

                            <td class="px-6 py-4 text-gray-600">
                                {{ $book->category }}
                            </td>

                            <td class="px-6 py-4 text-gray-800">
                                ₱{{ number_format($book->unit_price, 2) }}
                            </td>

                            <td class="px-6 py-4">

                                @if($book->availability_status == 'Available')

                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs">
                                        Available
                                    </span>

                                @else

                                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs">
                                        Unavailable
                                    </span>

                                @endif

                            </td>

                            <td class="px-6 py-4">

                                <div class="flex gap-3">

                                    <a href="{{ route('books.show', $book->id) }}"
                                        class="text-blue-600 hover:underline">
                                        View
                                    </a>

                                    <a href="{{ route('books.edit', $book->id) }}"
                                        class="text-yellow-600 hover:underline">
                                        Edit
                                    </a>

                                    <form action="{{ route('books.destroy', $book->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this book?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="text-red-600 hover:underline">
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6"
                                class="text-center py-10 text-gray-500">

                                No books found. Add your first book!

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
