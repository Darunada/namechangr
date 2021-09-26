@section('title', 'Utah Name and Gender Change')
@section('description', "NameChangr helps you generate all the required paperwork to legally change your Name and Gender in Utah.")

@extends('layouts.front')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">How to Change your Name in Utah</div>
                <div class="panel-body">

                    <div class="pull-right">
                        <figure style="width:192px;">
                            <img src="{{ asset("images/ut.png") }}" title="Utah" alt="Utah"/>
                            <figcaption>The State of Utah has 8 court districts across 29 counties.</figcaption>
                        </figure>
                    </div>

                    <p>Changing your name in Utah has a few requirements.</p>
                    <ul>
                        <li>You must reside within in the same <strong>county</strong> for at least 1 year.</li>
                        <li>You must not be presently involved in any court action.</li>
                        <li>You must not be on probation or parole.</li>
                        <li>You must not be a registered sex offender.</li>
                        <li>You must not be changing your name to avoid creditors.</li>
                        <li>Your name change must not affect any right, title, interest, or anyone else.</li>
                    </ul>

                    <p>If you are also changing your gender, the process is slightly more complicated.
                        We recommend you include as much information as possible with your court petition when you file to change your
                        gender.
                        Try not to give them a reason to say no.
                    </p>
                    <ul>
                        <li>Judges do not always know what to do.</li>
                        <li>There are no state statutes governing how the court may change your gender</li>
                        <li>
                            Judges use their own discretion in granting gender changes and may ask for additional
                            documentation in addition to the name change requirements.
                            <strong>Frequently requested documents include the following:</strong>
                            <ol>
                                <li>
                                    A letter from your Therapist or Psychologist indicating you have been evaluated,
                                    on their official letterhead with contact information and their qualifications.
                                </li>
                                <li>
                                    A letter from your doctor indicating you have undergone medical transition,
                                    on their official letterhead with contact information and their qualifications.
                                    <br/>
                                    <span class="label label-info">Info!</span>
                                    <small>
                                        The State department has a good form letter for your doctor on their website.
                                        <a href="https://travel.state.gov/content/passports/en/passports/information/gender.html"
                                           target="_blank">View <i class="fa fa-link"></i></a>
                                    </small>
                                </li>
                            </ol>
                        </li>
                    </ul>

                    <h2>After Court...</h2>
                    <p>
                        When your name change is granted, you will be allowed to change your name easily everywhere.
                        If you are also changing your gender, of course, you have more work to do. Changing your
                        documents in a particular order will make the process go smoother.
                    </p>

                    <legend>Social Security</legend>
                    <p>
                        Changing your name at Social Security requires your court order and a few other things.
                        Changing your gender additionally requires <strong>either</strong> a letter from your doctor (the form letter
                        from above) <strong>or</strong> your court order changing gender. Why not bring both if you got em?
                        <small><a
                                href="https://faq.ssa.gov/link/portal/34011/34019/Article/2856/How-do-I-change-my-gender-on-Social-Security-s-records"
                                target="_blank">More Info<i class="fa fa-link"></i></a></small>
                    </p>

                    <legend>US Passport</legend>
                    <p>
                        Changing your name on your Passport is as easy as filing form DS-11 at the post office with your court order
                        changing name
                        plus the regularly required documents. If you are also changing your gender file with your new gender and include
                        your
                        doctor letter and court order.
                        <small><a href="https://travel.state.gov/content/passports/en/passports/information/gender.html" target="_blank">More
                                Info<i class="fa fa-link"></i></a></small>
                    </p>

                    <legend>Birth Certificate</legend>
                    <p>
                        Changing your gender on your Utah birth certificate requires a certified copy of your court order and a small fee.
                        The new copy will contain a permanent
                        amendment notification [unless you also include your order sealing case -rumor]
                        <small><a href="https://vitalrecords.utah.gov/certificates/amend-a-vital-record" target="_blank">More Info<i
                                    class="fa fa-link"></i></a></small>
                    </p>
                    <p>
                        <small>If you were born in another state, you'll need to look that up separately.</small>
                    </p>

                    <legend>Driver's License/State ID</legend>
                    <p>
                        Arguably the most important one for your daily life, changing the name on your driver's license or state ID in Utah
                        is possible with your order changing name.
                    </p>

                    <p>
                        <strong>Of course, if you're changing your gender, you'll run into some trouble.</strong>
                        To change your gender the DLD will require a US Passport <strong>or</strong> your amended
                        Birth Certificate <strong>with your gender already changed</strong>.
                    </p>

                    <p>
                        If you are unable to change your birth certificate because of your birth state law, you will
                        need to get an updated passport. They're expensive and take a long time to come, so this is a huge road block.
                        Some people have gotten by this requirement by getting lucky with a clerk who doesn't know the policy. Good luck!
                    </p>

                    <legend>Other Places...</legend>
                    <p>
                        You will likely need to update your records at several other places, so make sure you get
                        enough certified copies of your court order for you. Consider the following places you may need to update through
                        the mail:

                    <ul>
                        <li>The IRS</li>
                        <li>Your Bank</li>
                        <li>Credit Card Companies</li>
                        <li>Your Job</li>
                        <li>Mortgage/Land Lord/Utilities</li>
                        <li>...etc</li>
                    </ul>
                    </p>


                    <hr/>
                    <h2>NameChangr gets you ready!</h2>
                    <p>
                        When NameChangr generates your name and gender change petition, we include a detailed instruction sheet that
                        gives you in-depth guidance along every step of the way.
                    </p>

                    <h4>Ready to get started?</h4>
                    <p>
                        <a class="btn btn-primary" href="{{ route('register') }}">Register Now</a>
                        <a class="btn btn-default" href="{{ route('login') }}">Log In</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
