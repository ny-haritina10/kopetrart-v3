<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title> {{ env('APP_NAME', 'Primefit') }} </title>

        <link rel="stylesheet" type="text/css" href="/src/css/style.css" />
        <link rel="stylesheet" type="text/css" href="/lib/fa/css/all.min.css" />

        <link rel="stylesheet" type="text/css" href="/lib/toolkit/css/chart.toolkit.css" />
        <link rel="stylesheet" type="text/css" href="/lib/mdb5/css/mdb.min.css" />

        <script type="text/javascript" src="/lib/toolkit/js/chart.umd.js" defer></script>
        <script type="text/javascript" src="/lib/toolkit/js/chart.toolkit.js" defer></script>

        <script type="text/javascript" src="/lib/mdb5/js/mdb.umd.min.js" defer></script>
        <script type="text/javascript" src="/src/js/script.js" defer></script>

        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    </head>
    <body>
        <div id="container">
            <aside> @yield('aside') </aside>
            <main>
                <div> @yield('topbar') </div>
                <div class="container p-5"> @yield('content') </div>
            </main>
        </div>
    </body>
</html>
