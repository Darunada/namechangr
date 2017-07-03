@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Get Started
                </div>
                <div class="panel-body">
                    <form role="form" method="POST" action="{{ route('start') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="state-id" class="control-label">State</label>

                            <select id="state-id" class="form-control" name="state_id" required autofocus>
                                <option>Select a State</option>
                                @foreach ($states as $stateId => $stateName)
                                    <option value="{{ $stateId }}">{{ $stateName }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="county-id" class="control-label">County</label>
                            <select id="county-id" class="form-control" name="county_id" required>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="district-id" class="control-label">District</label>
                            <select id="district-id" class="form-control" name="district_id" required>
                            </select>
                        </div>


                        <div class="form-group">
                            <div class="controls">
                                <button class="btn btn-large btn-primary">Get Started!</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
