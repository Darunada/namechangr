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
                    <li class="disabled">
                        <a href="#personal" data-toggle="tab" title="Your Personal Information">
                            <span class="round-tabs two">
                                <i class="fa fa-drivers-license"></i>
                            </span>
                        </a>
                    </li>
                    <li class="disabled">
                        <a href="#change" data-toggle="tab" title="Your Change">
                            <span class="round-tabs three">
                                <i class="fa fa-child"></i>
                            </span>
                        </a>
                    </li>
                    <li class="disabled">
                        <a href="#settings" data-toggle="tab" title="blah blah">
                           <span class="round-tabs four">
                               <i class="glyphicon glyphicon-comment"></i>
                           </span>
                        </a>
                    </li>
                    <li class="disabled">
                        <a href="#doner" data-toggle="tab" title="completed">
                            <span class="round-tabs five">
                                <i class="glyphicon glyphicon-ok"></i>
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
                            <li><button type="button" class="btn btn-primary next-step">Next</button></li>
                        </ul>
                    </div>
                </div>
                <div class="tab-pane fade" id="personal">
                    <div class="col-xs-12">
                        <h3 class="head text-center">Your Personal Information <small>dun dun dunn....</small></h3>
                        @include('states.UT.partials.personal-information')

                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                            <li><button type="button" class="btn btn-primary next-step">Next</button></li>
                        </ul>
                    </div>

                </div>
                <div class="tab-pane fade" id="change">
                    <div class="col-xs-12">
                        <h3 class="head text-center">Change Info</h3>
                        @include('states.UT.partials.change-information')

                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                            <li><button type="button" class="btn btn-primary next-step">Next</button></li>
                        </ul>
                    </div>
                </div>
                <div class="tab-pane fade" id="settings">
                    <div class="col-xs-12">
                        <h3 class="head text-center">Drop comments!</h3>
                        <p class="narrow text-center">
                            Lorem ipsum dolor sit amet, his ea mollis fabellas principes. Quo mazim facilis tincidunt ut, utinam
                            saperet facilisi an vim.
                        </p>

                        <p class="text-center">
                            <a href="" class="btn btn-success btn-outline-rounded green"> start using bootsnipp <span
                                        style="margin-left:10px;" class="glyphicon glyphicon-send"></span></a>
                        </p>

                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                            <li><button type="button" class="btn btn-primary next-step">Next</button></li>
                        </ul>
                    </div>
                </div>
                <div class="tab-pane fade" id="doner">
                    <div class="col-xs-12">
                        <div class="text-center">
                            <i class="img-intro icon-checkmark-circle"></i>
                        </div>
                        <h3 class="head text-center">thanks for staying tuned! <span style="color:#f48260;">♥</span> Bootstrap
                        </h3>
                        <p class="narrow text-center">
                            Lorem ipsum dolor sit amet, his ea mollis fabellas principes. Quo mazim facilis tincidunt ut, utinam
                            saperet facilisi an vim.
                        </p>

                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                            <li><button type="button" class="btn btn-primary btn-info-full next-step">Submit</button></li>
                        </ul>

                    </div>
                </div>
                <div class="clearfix"></div>
            </div>

        </div>
    </form>



@endsection