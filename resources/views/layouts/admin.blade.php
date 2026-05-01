<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - PluggedX</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background:#f4f6f9;">

<nav class="navbar navbar-dark bg-dark px-4">
    <a class="navbar-brand fw-bold" href="{{ route('plugins.index') }}">PluggedX Admin</a>
    <div class="d-flex gap-3">
        <a href="{{ route('plugins.index') }}"
           class="nav-link text-white {{ request()->routeIs('plugins.*') ? 'border-bottom border-primary fw-semibold' : '' }}">
            Plugins
        </a>
        <a href="{{ route('hosting-categories.index') }}"
           class="nav-link text-white {{ request()->routeIs('hosting-categories.*') ? 'border-bottom border-primary fw-semibold' : '' }}">
            Hosting Categories
        </a>
        <a href="{{ route('hosting-plans.index') }}"
           class="nav-link text-white {{ request()->routeIs('hosting-plans.*') ? 'border-bottom border-primary fw-semibold' : '' }}">
            Hosting Plans
        </a>
    </div>
</nav>

<div class="container py-4">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
