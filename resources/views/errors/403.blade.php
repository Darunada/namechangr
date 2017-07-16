<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.favicons')

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" crossorigin="anonymous">
    <style type="text/css">
        body { background-image: url(https://subtlepatterns.com/patterns/symphony.png)}
        .error-template {padding: 40px 15px;text-align: center;}
        .error-actions {margin-top:15px;margin-bottom:15px;}
        .error-actions .btn:not(:last-child) { margin-right:10px; }
    </style>
    <title>{{ config('app.name', 'Laravel') }} &mdash; 403 Forbidden</title>
</head>
<body>
<div id="app">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="error-template">
                    <h1>Oops!</h1>
                    <h2>403 Forbidden</h2>
                    <div class="error-details">
                        Sorry, you're not supposed to be here!
                    </div>
                    <div class="error-actions">
                        <a href="{{ url()->previous() }}" class="btn btn-primary btn-lg">
                            <i class="fa fa-back"></i> Go Back
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@include('partials.google_analytics')
</body>
</html>




