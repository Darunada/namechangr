@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">

                    <div class="callout callout-info">
                        <h4>Welcome to NameChangr!</h4>
                        <p>Currently we only support <strong>Utah</strong>, but I hope to add more states soon</p>
                        <p><small>Please review all generated files and instructions for accuracy</small></p>
                    </div>

                    <strong>You have no saved applications!</strong><br/>
                    <a href="" class="btn btn-default">Start Application</a>
                </div>
            </div>
        </div>
    </div>
@endsection
