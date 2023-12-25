<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>@yield('title')</title>

  <!-- Fonts -->
  {{-- <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" /> --}}

  <!-- Styles -->
  @vite('resources/css/app.css')

  <!-- Scripts -->
  <script src="{{ asset('jquery.js') }}"></script>
    <script src="{{ asset('axios.js') }}"></script>

</head>

<body class="antialiased">

  <!-- Navbar -->
  <header>
    <nav class="bg-slate-800 py-4 pl-10 text-white">
      <a class="text-xl" href="/dashboard">Dashboard</a>
    </nav>
  </header>

  <!-- Content -->
  @yield('content')

  <!-- Scripts -->
  @stack('scripts')
</body>

</html>
