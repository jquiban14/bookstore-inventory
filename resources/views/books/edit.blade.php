
@extends('layouts.bookstore')

@section('title', 'Edit Book')

@section('content')

<div class="max-w-4xl mx-auto py-6">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">
            Edit Book
        </h1>

        <p class="text-gray-500 mt-2">
            Update the book information below.
        </p>
    </div>

    <div class="bg-white shadow-md rounded-xl p-8">

        <form action="{{ route('books.update', $book->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <!-- Book Title -->
            <div class="mb-5">
                <label class="block font-medium mb-2">
                    Book Title
                </label>

                <input type="text" name="title"
                    value="{{ old('title', $book->title) }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm">

                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Author -->
            <div class="mb-5">
                <label class="block font-medium mb-2">
                    Author
                </label>

                <input type="text" name="author"
                    value="{{ old('author', $book->author) }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm">

                @error('author')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Category -->
            <div class="mb-5">
                <label class="block font-medium mb-2">
                    Category
                </label>

                <select name="category"
                    class="w-full border-gray-300 rounded-lg shadow-sm">

                    @foreach (['Fiction', 'Nonfiction', 'Academic', "Children's Books"] as $category)
                        <option value="{{ $category }}"
                            {{ old('category', $book->category) == $category ? 'selected' : '' }}>
                            {{ $category }}
                        </option>
                    @endforeach

                </select>

                @error('category')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Unit Price -->
            <div class="mb-5">
                <label class="block font-medium mb-2">
                    Unit Price (₱)
                </label>

                <input type="number" name="unit_price"
                    value="{{ old('unit_price', $book->unit_price) }}"
                    min="0" step="0.01"
                    class="w-full border-gray-300 rounded-lg shadow-sm">

                @error('unit_price')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-5">
                <label class="block font-medium mb-2">
                    Description
                </label>

                <textarea name="description" rows="4"
                    class="w-full border-gray-300 rounded-lg shadow-sm">{{ old('description', $book->description) }}</textarea>

                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Availability -->
            <div class="mb-6">
                <label class="block font-medium mb-2">
                    Availability Status
                </label>

                <select name="availability_status"
                    class="w-full border-gray-300 rounded-lg shadow-sm">

                    <option value="Available"
                        {{ old('availability_status', $book->availability_status) == 'Available' ? 'selected' : '' }}>
                        Available
                    </option>

                    <option value="Unavailable"
                        {{ old('availability_status', $book->availability_status) == 'Unavailable' ? 'selected' : '' }}>
                        Unavailable
                    </option>

                </select>

                @error('availability_status')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex justify-end gap-3">

                <a href="{{ route('books.index') }}"
                    class="bg-gray-200 px-5 py-2 rounded-lg">
                    Cancel
                </a>

                <button type="submit"
                    class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
                    Update Book
                </button>

            </div>

        </form>

    </div>

</div>

@endsection
