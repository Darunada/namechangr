
@section('title', 'Start Your Application')
@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Start Your Application</div>

                <div class="panel-body">
                    <form role="form" method="POST" action="{{ route('start') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('state_id') ? ' has-error' : '' }}">
                            <label for="state-id" class="control-label">State</label>

                            <select id="state-id" class="form-control" name="state_id" autofocus>
                                <option value="">Select a State</option>
                                @foreach ($states as $stateId => $stateName)
                                    <option value="{{ $stateId }}">{{ $stateName }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('state_id'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('state_id') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="control-label">Form Options</label>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="name_change" value="1" checked="checked"> Name Change
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="gender_change" value="1" checked="checked"> Gender Change
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            {!! app('captcha')->display(); !!}
                        </div>

                        <div class="form-group">
                            <div class="controls">
                                <button type="submit" class="btn btn-large btn-primary">Get Started!</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
