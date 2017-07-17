@section('title', 'Utah Application')

@push('objects')
<script type="text/javascript">
    window.Laravel.application = {!! $application->toJson() !!};
</script>
@endpush

@push('scripts')
<script src="{{ mix('js/UT.js') }}"></script>
@endpush

@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <form role="form" method="POST" action="{{ route('states.UT.save', $application->id) }}" id="application-form">
                {{ csrf_field() }}

                <div class="board">
                    <div class="board-inner">
                        <ul class="nav nav-tabs" id="application-tabs">
                            <div class="liner"></div>

                            <li class="active">
                                <a href="#court-location" data-toggle="tab" title="Court Location">
                                    <span class="round-tabs one">
                                        <i class="fa fa-map-pin"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="">
                                <a href="#personal" data-toggle="tab" title="Your Personal Information">
                                    <span class="round-tabs two">
                                        <i class="fa fa-drivers-license"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="">
                                <a href="#change" data-toggle="tab" title="Change Info">
                                    <span class="round-tabs three">
                                        <i class="fa fa-child"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="">
                                <a href="#documents" data-toggle="tab" title="Get Your Documents">
                                   <span class="round-tabs four">
                                       <i class="fa fa-download"></i>
                                   </span>
                                </a>
                            </li>
                            <li class="">
                                <a href="#judges" data-toggle="tab" title="Judges">
                                    <span class="round-tabs five">
                                        <i class="fa fa-gavel"></i>
                                    </span>
                                </a>
                            </li>

                        </ul>
                    </div>

                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="court-location">
                            <div class="col-xs-12">
                                <h3 class="head text-center">Court Location</h3>
                                @include('states.location-picker')

                                <ul class="list-inline pull-right">
                                    <li>
                                        <button type="button" class="btn btn-primary next-step">Next</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="personal">
                            <div class="col-xs-12">
                                <h3 class="head text-center">Your Personal Information
                                    <small>dun dun dunn....</small>
                                </h3>
                                @include('states.UT.partials.personal-information')

                                <ul class="list-inline pull-right">
                                    <li>
                                        <button type="button" class="btn btn-default prev-step">Previous</button>
                                    </li>
                                    <li>
                                        <button type="button" class="btn btn-primary next-step">Next</button>
                                    </li>
                                </ul>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="change">
                            <div class="col-xs-12">
                                <h3 class="head text-center">Change Info</h3>
                                @include('states.UT.partials.change-information')

                                <ul class="list-inline pull-right">
                                    <li>
                                        <button type="button" class="btn btn-default prev-step">Previous</button>
                                    </li>
                                    <li>
                                        <button type="button" class="btn btn-primary next-step">Next</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="documents">
                            <div class="col-xs-12">
                                <h3 class="head text-center">Get your Documents!</h3>
                                @include('states.UT.partials.documents')

                                <ul class="list-inline pull-right">
                                    <li>
                                        <button type="button" class="btn btn-default prev-step">Previous</button>
                                    </li>
                                    <li>
                                        <button type="button" class="btn btn-primary next-step">Next</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="judges">
                            <div class="col-xs-12">
                                <h3 class="head text-center">Your Judge</h3>
                                @include('states.UT.partials.judges')

                                <ul class="list-inline pull-right">
                                    <li>
                                        <button type="button" class="btn btn-default prev-step">Previous</button>
                                    </li>
                                    {{--<li><button type="button" class="btn btn-primary btn-info-full next-step">Submit</button></li>--}}
                                </ul>

                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                </div>
            </form>
        </div>
    </div>



@endsection