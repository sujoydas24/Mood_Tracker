<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Mood Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    {{-- Header --}}
    <header class="bg-primary text-white text-center py-3">
        <h1>Mood Tracker 🧠</h1>
        <p class="mb-0">Track your mood. Improve your day.</p>
    </header>

    @yield('main')

    {{-- Footer --}}
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <p class="mb-0">&copy; {{ now()->year }} Mood Tracker App. All rights reserved.</p>
    </footer>

</body>
</html>
