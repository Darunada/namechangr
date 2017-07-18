
<hr/>


<div class="row form-row">

    <div class="col-sm-12">
        <legend>Instructions and Cover Sheet</legend>

        <a href="{{ route('states.UT.instructions') }}" class="btn btn-lg btn-default" target="_blank">
            <i class="fa fa-book"></i> Download Instructions
        </a>

        <a href="{{ route('states.UT.cover_sheet') }}" class="btn btn-lg btn-default" target="_blank">
            <i class="fa fa-file-o"></i> Download Cover Sheet
        </a>

        <p>Sorry, you need to print and fill out the cover sheet separately from the generator.  I am working on it...</p>
    </div>
</div>

<div class="row form-row">
    <div class="col-sm-12">
        <legend>Your Document Package</legend>

        @if($application->is_generating_documents)
            <a href="#" class="btn btn-lg btn-primary generate-application-btn disabled" data-type="docx" disabled>
                <i class="fa fa-spinner fa-spin"></i> Documents are generating...
            </a>
        @else
            <a href="#" class="btn btn-lg btn-primary generate-application-btn" data-type="docx">
                <i class="fa fa-envelope-o"></i> Email my Docs
            </a>
        @endif

        {{--<a href="#" class="btn btn-lg btn-default generate-application-btn disabled" data-type="pdf" disabled>--}}
            {{--<i class="fa fa-file-pdf-o"></i> Download PDF--}}
        {{--</a>--}}

        {{--<a href="#" class="btn btn-lg btn-default generate-application-btn disabled" data-type="html" disabled>--}}
            {{--<i class="fa fa-html5"></i> Download HTML--}}
        {{--</a>--}}

    </div>
</div>

<div class="row form-row" id="documents-generating-row" {!! $application->is_generating_documents?'':'style="display:none;"' !!}>
    <div class="col-xs-12">
        <h4><i class="fa fa-spinner fa-spin"></i> Please wait...</h4>
        <p>Your documents are generating.  They will be emailed to you at {{ Auth::user()->email }} when they are ready!</p>
        <p>Of course, you will be able to see them here when they are ready, too!</p>
        <br/>
        <p><strong>Please feel free to continue to the next step...</strong></p>
    </div>
</div>

<div class="row form-row" id="documents-error-row" style="display:none;">
    <div class="col-xs-12">
        <h4><i class="fa fa-exclamation"></i> Uhoh!</h4>
        <p>There was a problem generating your documents.</p>
        <p>You'll probably want to <a href="mailto:hello@namechangr.com">contact me</a></p>
    </div>
</div>

<div id="generated-documents-section">
    @if($application->files->isNotEmpty())
        @include('states.UT.partials.generated-files')
    @endif
</div>