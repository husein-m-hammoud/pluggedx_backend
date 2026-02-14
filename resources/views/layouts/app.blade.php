<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Bridgevise PDF Manager') }}</title>

    {{-- Bootstrap CSS (via CDN for simplicity) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Optional: custom styles for brand colors --}}
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #163041;
        }
        .navbar .navbar-brand,
        .navbar .nav-link,
        .navbar .nav-link:focus,
        .navbar .nav-link:hover {
            color: #fff;
        }
        .btn-primary {
            background-color: #3797a0;
            border-color: #3797a0;
        }
        .btn-primary:hover {
            background-color: #2d7f87;
            border-color: #2d7f87;
        }
    </style>

    @stack('styles')
</head>
<body>
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('storage/assets/bridgevise_logo.png') }}" alt="Bridgevise Logo" height="30">
                Bridgevise PDF Manager
            </a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="{{ route('pdfs.index') }}" class="nav-link">All PDFs</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('pdfs.create') }}" class="nav-link">Add PDF</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Main content --}}
    <main class="py-4">
        @yield('content')
    </main>

    {{-- Bootstrap JS (for components like modals, dropdowns) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>
