
@extends('layouts.bookstore')

@section('title', 'Inventory Reports')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">
            Inventory Reports
        </h1>

        <p class="text-gray-500 mt-2">
            Generate and filter your bookstore inventory reports.
        </p>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-6">

        <h2 class="text-lg font-semibold mb-5">
            Report Filters
        </h2>

        <form action="{{ route('reports.index') }}" method="GET">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                <!-- Report Type -->
                <div>
                    <label class="block text-sm font-medium mb-2">
                        Report Type
                    </label>

                    <select name="report_type"
                        class="w-full border-gray-300 rounded-lg">

                        <option value="all"
                            {{ request('report_type', 'all') == 'all' ? 'selected' : '' }}>
                            All Books
                        </option>

                        <option value="available"
                            {{ request('report_type') == 'available' ? 'selected' : '' }}>
                            Available Books
                        </option>

                        <option value="unavailable"
                            {{ request('report_type') == 'unavailable' ? 'selected' : '' }}>
                            Unavailable Books
                        </option>

                        <option value="category"
                            {{ request('report_type') == 'category' ? 'selected' : '' }}>
                            Books by Category
                        </option>

                        <option value="price_list"
                            {{ request('report_type') == 'price_list' ? 'selected' : '' }}>
                            Book Price List
                        </option>

                    </select>
                </div>

                <!-- Category -->
                <div>
                    <label class="block text-sm font-medium mb-2">
                        Category
                    </label>

                    <select name="category"
                        class="w-full border-gray-300 rounded-lg">

                        <option value="">All Categories</option>

                        @foreach (['Fiction', 'Nonfiction', 'Academic', "Children's Books"] as $category)

                            <option value="{{ $category }}"
                                {{ request('category') == $category ? 'selected' : '' }}>
                                {{ $category }}
                            </option>

                        @endforeach

                    </select>
                </div>

                <!-- Availability -->
                <div>
                    <label class="block text-sm font-medium mb-2">
                        Availability Status
                    </label>

                    <select name="availability_status"
                        class="w-full border-gray-300 rounded-lg">

                        <option value="">All Statuses</option>

                        <option value="Available"
                            {{ request('availability_status') == 'Available' ? 'selected' : '' }}>
                            Available
                        </option>

                        <option value="Unavailable"
                            {{ request('availability_status') == 'Unavailable' ? 'selected' : '' }}>
                            Unavailable
                        </option>

                    </select>
                </div>

            </div>

            <!-- Buttons -->
            <div class="flex flex-wrap gap-3 mt-6">

                <button type="submit"
                    class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
                    Apply Filters
                </button>

                <a href="{{ route('reports.index') }}"
                    class="bg-gray-200 text-gray-700 px-5 py-2 rounded-lg hover:bg-gray-300">
                    Reset Filters
                </a>

            </div>

        </form>

    </div>

    <!-- Report Results -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">

        <div class="p-6 border-b flex justify-between items-center">

            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    {{ match(request('report_type', 'all')) {
                        'available' => 'Available Books Report',
                        'unavailable' => 'Unavailable Books Report',
                        'category' => 'Books by Category Report',
                        'price_list' => 'Book Price List',
                        default => 'Complete Book Inventory'
                    } }}
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Total Matching Records: {{ $books->count() }}
                </p>
            </div>

        <div class="flex flex-wrap gap-2">

    <a href="{{ route('reports.pdf', request()->query()) }}"
       class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
        Export PDF
    </a>

    <a href="{{ route('reports.excel', request()->query()) }}"
       class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
        Export Excel
    </a>

</div>
                </div>

        <!-- Results Table -->
        <div class="overflow-x-auto">

            <table class="w-full text-left">

                <thead class="bg-gray-100 text-gray-600 text-sm uppercase">

                    <tr>
                        <th class="px-6 py-4">Book Title</th>
                        <th class="px-6 py-4">Author</th>
                        <th class="px-6 py-4">Category</th>
                        <th class="px-6 py-4">Unit Price</th>
                        <th class="px-6 py-4">Availability</th>
                    </tr>

                </thead>

                <tbody class="divide-y">

                    @forelse($books as $book)

                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4 font-medium">
                                {{ $book->title }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $book->author }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $book->category }}
                            </td>

                            <td class="px-6 py-4">
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

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5"
                                class="text-center py-10 text-gray-500">

                                No records match your selected filters.

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
