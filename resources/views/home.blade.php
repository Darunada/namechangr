
@extends('layouts.home')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Welcome to NameChangr!</strong>
                    <span class="pull-right"><small>Published 6/26/2017</small></span>
                </div>
                <div class="panel-body">
                    <p>Hi there, my name is Lea.</p>
                    <p>I think changing your legal name is way too difficult, so I made this tool to help you along the process.  This platform has been designed with trans people in mind, but it should work for anyone changing their legal name and/or gender!</p>

                    <h2>Ready to get started?</h2>
                    <p><a class="btn btn-primary" href="{{ route('register') }}">Register Now</a></p>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Uhoh...</strong>
                    <span class="pull-right"><small>Published 7/7/2017</small></span>
                </div>
                <div class="panel-body">
                    <p>Utah is such a funny place.</p>
                    <p>The Salt Lake Tribune picked up a case about a denied gender change.  Apparently they are taking it to the Utah Supreme Court, which means their ruling will affect all of us Utahn's.</p>

                    <p>This judge is definitely not the first one to deny a gender change, but as I understand it most people have no problems at all.</p>
                    <p><a href="http://www.sltrib.com/news/5470281-155/two-utahns-denied-legal-sex-designation">Read the article.</a></p>

                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Some Quick Answers...</strong>
                    <span class="pull-right"><small>Published 6/26/2017</small></span>
                </div>
                <div class="panel-body">
                    <legend>Why use your tool?</legend>
                    <p>I've helped a number of trans people with their legal name and gender change paperwork in Utah and everyone has had success.  My original paperwork packet was published to the Utah Transgender facebook group and I know tons of people have used it without even telling me!</p>

                    <legend>What states do you support?</legend>
                    <p>Only Utah right now.</p>

                    <legend>Are you qualified to provide this?</legend>
                    <p>Nope.  This site is provided for your convenience, but if you have any additional questions you should consult a friend who has done it before or seek legal counsel.</p>

                    <legend>How can I get more help?</legend>
                    <p>I can't really offer any personalized assistance, but if you notice a problem with this site or the paperwork/instructions it creates, please open a <a href="https://github.com/Darunada/namechangr/issues">github issue</a>.  This is very important because requirements are changing all the time and I can't keep up with them on my own!</p>

                    <legend>Can you recommend an attorney?</legend>
                    <p>I hope to be able to soon!  If you know an attorney who would be willing to review my work [for free], please get them in touch with me!</p>

                    <legend>Why do you only support some states?</legend>
                    <p>Name and gender change is handled at the state level, so every state has a different procedure.  Please, if you have basic development skills  or want to help me design a process for another state, hook up with me on <a href="https://github.com/Darunada/namechangr">github</a>.</p>

                    <legend>Wow this is great!</legend>
                    <p>Thank you so much!  I hope it helps you!</p>

                </div>

            </div>
        </div>
    </div>
@endsection
