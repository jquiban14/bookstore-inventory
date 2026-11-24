
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Bookstore Inventory')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">

    <!-- Navigation -->
    <nav class="bg-gray-900 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <h1 class="text-xl font-bold">
                Bookstore Inventory
            </h1>

            <div class="flex items-center gap-5">

                <span class="text-sm">
                    {{ Auth::user()->name }}
                </span>

                <a href="{{ route('reports.index') }}"
    class="text-white hover:text-blue-300">
    Reports
</a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button type="submit"
                        class="bg-red-600 px-4 py-2 rounded-lg hover:bg-red-700">
                        Logout
                    </button>
                </form>

            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="max-w-7xl mx-auto py-8 px-6">

        @yield('content')

    </main>

</body>
</html>
