<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('partials.favicons')
    <title>{{ config('app.name', 'Laravel') }} &mdash; @yield('title', "Name And Gender Changes Made Easy")</title>
    <meta name="description"
          content="@yield('description', "Changing your legal name or gender has never been easier.  Sign up and generate your required paperwork for free.")">
    <meta name="keywords"
          content="@yield('keywords', "legal aid, how to change your name, how to legally change your name, social security name change, name change, legal name change, gender change, legal gender change, name and gender change, legal name and gender change, utah name change, utah gender change, transsexual, transgender, utah")">

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
