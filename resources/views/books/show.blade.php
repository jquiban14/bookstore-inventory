
@extends('layouts.bookstore')

@section('title', 'Book Details')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="flex justify-between items-center mb-6">

        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                Book Details
            </h1>

            <p class="text-gray-500">
                View complete book information.
            </p>
        </div>

        <a href="{{ route('books.index') }}"
            class="bg-gray-200 px-4 py-2 rounded-lg">
            Back
        </a>

    </div>

    <div class="bg-white rounded-xl shadow-md p-8">

        <h2 class="text-2xl font-bold text-gray-800 mb-6">
            {{ $book->title }}
        </h2>

        <div class="space-y-5">

            <div>
                <p class="text-sm text-gray-500">Author</p>
                <p class="font-medium">{{ $book->author }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Category</p>
                <p class="font-medium">{{ $book->category }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Unit Price</p>
                <p class="font-medium">
                    ₱{{ number_format($book->unit_price, 2) }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Description</p>
                <p class="font-medium">{{ $book->description }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Availability</p>

                @if($book->availability_status == 'Available')
                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                        Available
                    </span>
                @else
                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                        Unavailable
                    </span>
                @endif

            </div>

            <div>
                <p class="text-sm text-gray-500">Date Added</p>
                <p class="font-medium">
                    {{ $book->created_at->format('F d, Y') }}
                </p>
            </div>

        </div>

        <div class="mt-8">
            <a href="{{ route('books.edit', $book->id) }}"
                class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
                Edit Book
            </a>
        </div>

    </div>

</div>

@endsection
