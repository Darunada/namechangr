@section('title', "Dashboard")
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

                    <div class="row">
                        <ul id="applications-list">
                            @php
                                $colors = ['blue', 'green', 'yellow', 'orange', 'purple'];
                            @endphp

                            @foreach ($applications AS $application)
                                <li class="fa-border">
                                    <a href="{{ route('states.'.$application->state->code(), ['application'=>$application]) }}">
                                        <div class="application-icon">
                                            <span class="fa-stack fa-5x">
                                                <i class="fa fa-file-text-o fa-stack"></i>
                                            </span>
                                        </div>
                                        <div class="application-desc">{{ $application->state->code() }}</div>

                                        <div class="overlay {{ $colors[$loop->index % count($colors)] }}">
                                            <div class="text">
                                                <strong>{{ $application->state->name }}</strong><br/>
                                                @if($application->name_change)
                                                    <i class="fa fa-fw fa-check"></i> Name Change<br/>
                                                @endif
                                                @if($application->gender_change)
                                                    <i class="fa fa-fw fa-check"></i> Gender Change<br/>
                                                @endif
                                                @if($application->exists)
                                                    <small><i class="fa fa-fw fa-calendar"></i> Created {{ $application->created_at->format('m/d/Y') }}</small><br/>
                                                @else
                                                    <small><i class="fa fa-fw fa-remove"></i> Not Saved</small><br/>
                                                @endif
                                                <br/></br/>
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <button class="btn btn-default" href="{{route('dashboard')}}">Edit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                </li>
                            @endforeach


                            @if(count($applications) > 0 && Auth::guest())
                                <li>
                                    <a href="{{ route('start') }}">
                                        <div class="application-icon">
                                            <span class="fa-stack fa-5x">
                                                <i class="fa fa-ellipsis-h fa-stack"></i>
                                            </span>
                                        </div>
                                        <div class="application-desc">New Application</div>
                                        <div class="overlay red">
                                            <div class="text">
                                                <strong>New Application</strong><br/>
                                                <strong>Warning</strong> Your old application will be deleted
                                                <br/></br/>
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <button class="btn btn-default btn-confirm" href="{{ route('start') }}">Start</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('start') }}" class="green new-application">
                                        <div class="application-icon">
                                            <span class="fa-stack fa-5x">
                                                <i class="fa fa-plus-circle fa-stack"></i>
                                            </span>
                                        </div>
                                        <div class="application-desc">New Application</div>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
