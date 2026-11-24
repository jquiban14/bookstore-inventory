
@extends('layouts.bookstore')

@section('content')

<div class="max-w-4xl mx-auto py-10 px-6">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">
            Add New Book
        </h1>

        <p class="text-gray-500 mt-2">
            Enter the book information below.
        </p>
    </div>

    <div class="bg-white shadow-md rounded-xl p-8">

        <form action="{{ route('books.store') }}" method="POST">

            @csrf

            <!-- Book Title -->
            <div class="mb-5">
                <label class="block font-medium text-gray-700 mb-2">
                    Book Title
                </label>

                <input type="text" name="title"
                    value="{{ old('title') }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm"
                    placeholder="Enter book title">

                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Author -->
            <div class="mb-5">
                <label class="block font-medium text-gray-700 mb-2">
                    Author
                </label>

                <input type="text" name="author"
                    value="{{ old('author') }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm"
                    placeholder="Enter author's name">

                @error('author')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Category -->
            <div class="mb-5">
                <label class="block font-medium text-gray-700 mb-2">
                    Category
                </label>

                <select name="category"
                    class="w-full border-gray-300 rounded-lg shadow-sm">

                    <option value="">Select Category</option>

                    @foreach (['Fiction', 'Nonfiction', 'Academic', "Children's Books"] as $category)
                        <option value="{{ $category }}"
                            {{ old('category') == $category ? 'selected' : '' }}>
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
                <label class="block font-medium text-gray-700 mb-2">
                    Unit Price (₱)
                </label>

                <input type="number" name="unit_price"
                    value="{{ old('unit_price') }}"
                    min="0" step="0.01"
                    class="w-full border-gray-300 rounded-lg shadow-sm"
                    placeholder="0.00">

                @error('unit_price')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-5">
                <label class="block font-medium text-gray-700 mb-2">
                    Description
                </label>

                <textarea name="description" rows="4"
                    class="w-full border-gray-300 rounded-lg shadow-sm"
                    placeholder="Enter book description">{{ old('description') }}</textarea>

                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Availability -->
            <div class="mb-6">
                <label class="block font-medium text-gray-700 mb-2">
                    Availability Status
                </label>

                <select name="availability_status"
                    class="w-full border-gray-300 rounded-lg shadow-sm">

                    <option value="">Select Status</option>

                    <option value="Available"
                        {{ old('availability_status') == 'Available' ? 'selected' : '' }}>
                        Available
                    </option>

                    <option value="Unavailable"
                        {{ old('availability_status') == 'Unavailable' ? 'selected' : '' }}>
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
                    class="px-5 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                    Cancel
                </a>

                <button type="submit"
                    class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Save Book
                </button>

            </div>

        </form>

    </div>

</div>

@endsection
