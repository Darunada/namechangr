<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('partials.favicons')
    <title>{{ config('app.name', 'Laravel') }} &mdash; @yield('title', "Dashboard")</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Learn more about the creators! -->
    <link type="text/plain" rel="author" href="/humans.txt"/>

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token()
        ]) !!};
    </script>
    <script src="https://kit.fontawesome.com/bf314bb5d4.js"></script>
    @stack('objects')
</head>
<body data-controller="{{ $controller }}" data-action="{{ $action }}">
<div id="app">
    @include('partials.navbar')

    <div class="container">
        @include('partials.alerts')
        @yield('content')
        @include('partials.footer')
    </div>
</div>

<!-- Scripts -->
<script src="{{ mix('js/app.js') }}"></script>
@stack('scripts')

<!-- Google Analytics -->
@include('partials.google_analytics')
</body>
</html>
