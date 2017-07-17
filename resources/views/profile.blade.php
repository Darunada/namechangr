@section('title', "Your Profile")
@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Your Profile
                    <div class="pull-right">
                        <a href="/dashboard">Back</a>
                    </div>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/profile">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name"
                                       value="{{ $user->name }}" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email"
                                       value="{{ $user->email }}" required>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>

                    <div class="row">
                        <div class="col-md-8 col-md-offset-4">
                            @if($facebook)
                                <a href="/auth/facebook/deauthorize" onclick="event.preventDefault();
                                            document.getElementById('facebook-disconnect-form').submit();"
                                   class="btn btn-social btn-facebook">
                                    <span class="fa fa-facebook"></span> Disconnect From Facebook
                                </a>
                                <form id="facebook-disconnect-form" action="/auth/facebook/deauthorize" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            @else
                                <a href="/auth/facebook" class="btn btn-social btn-facebook">
                                    <span class="fa fa-facebook"></span> Link With Facebook
                                </a>
                            @endif

                            @if($twitter)
                                <a href="/auth/twitter/deauthorize"
                                   onclick="event.preventDefault();
                                            document.getElementById('twitter-disconnect-form').submit();"
                                   class="btn btn-social btn-twitter">
                                    <span class="fa fa-twitter"></span> Disconnect From Twitter
                                </a>
                                    <form id="twitter-disconnect-form" action="/auth/twitter/deauthorize" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                            @else
                                <a href="/auth/twitter" class="btn btn-social btn-twitter">
                                    <span class="fa fa-twitter"></span> Link With Twitter
                                </a>
                            @endif

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-4">
                            <hr/>
                            <p>The Danger Zone</p>
                            <a href="/profile" class="btn btn-danger btn-confirm btn-xs" data-after-confirm="document.getElementById('destroy-account-form').submit();">Destroy my Account</a>
                            <form id="destroy-account-form" action="/profile" method="POST" style="display: none;">
                                <input type="hidden" name="_method" value="DELETE"/>
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection