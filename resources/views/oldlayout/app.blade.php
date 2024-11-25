<!-- resources/views/layouts/app.blade.php -->
@vite(['resources/sass/app.scss', 'resources/js/app.js'])
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="">
    <style>
        /* CSS de base pour le layout */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        header {
            background-color: #3490dc;
            color: white;
            text-align: center;
            padding: 20px 0;
        }

        header h1 {
            margin: 0;
            font-size: 2.5em;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        footer p {
            margin: 0;
        }
    </style>

    <!-- Bootstrap CDN (si tu n'utilises pas npm) -->
{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">--}}


</head>
<body>
<header>
    <h1>@yield('title')</h1>
    <a href="{{ url('/') }}" class="btn btn-secondary" style="float: left; margin-top: -25px; margin-left: 5px">
        <i class="bi bi-arrow-left"></i> Home
    </a>
</header>

<div class="mx-5">
    @yield('content')
</div>

<footer>
    <p>© 2024 - Mon Site Laravel. Tous droits réservés.</p>
</footer>
</body>
</html>
