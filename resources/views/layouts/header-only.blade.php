<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
@include('partials.header')

<header class="border-bottom py-3 color-bg-tertiary">
    <div class="container-xl p-responsive clearfix py-3">
        <div class="d-flex flex-wrap flex-items-start flex-md-items-center my-3">
            <div class="flex-1">
                <h1 class="h2 lh-condensed">
                    Programs and Projects
                </h1>
            </div>
        </div>
    </div>
</header>

<main class="mx-auto">
    <div class="container-xl">
        @yield('content')
    </div>
</main>

@stack('scripts')
</body>
</html>
