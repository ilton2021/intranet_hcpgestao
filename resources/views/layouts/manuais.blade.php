<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <title>@yield('title') Manual</title>
</head>
<body>
    <header style="text-align: center;">
        <h1>@yield('titleHeader')</h1>
        @yield('menuNav')
    </header>
    <main>
        @yield('content')
    </main>
</body>
</html>