<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">


    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token()
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        @include('partials.navbar')

        <div class="container">
            @include('partials.alerts')
            @yield('content')

            <footer class="footer">
                    <div class="row">
                        <div class="col-sm-8">
                            Made with <3 by <a href="https://twitter.com/Darunada">@darunada</a>.  Want to help me support more states?  <a href="https://github.com/Darunada/namechangr">Join me on Github</a>
                        </div>
                        <div class="col-sm-4">
                            <div class="pull-right">
                                <a href="{{ route('privacy') }}">Privacy Policy</a> | <a href="{{ route('terms') }}">Terms of Service</a>
                            </div>
                        </div>
                    </div>
            </footer>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    @include('partials.google_analytics')
</body>
</html>
