<div class="row form-row">
    <div class="col-sm-6">

        <legend>Contact Information</legend>
        <p>This is used in the letterhead of your court documents</p>

        @component('partials.form-input-row', [
            'label'=>'Full Legal Name',
            'name'=>'data[current_legal_name]',
            'value'=>'',
            'help'=>'Your full and current legal name, including middle name'
        ])@endcomponent

        @component('partials.form-address-row', [
            'label'=>'Your Current Address',
            'name'=>'data[current_address]',
            'states'=>$states,
            'value'=>'',
            'help'=>'You must be able to receive mail at this address'
        ])@endcomponent

        @component('partials.form-phone-row', [
            'label'=>'Phone Number',
            'name'=>'data[current_phone]',
            'value'=>'',
            'help'=>''
        ])@endcomponent

        @component('partials.form-email-row', [
            'label'=>'Email Address',
            'name'=>'data[current_email]',
            'value'=>'',
            'help'=>''
        ])@endcomponent
    </div>
    <div class="col-sm-6">
        <legend>Sex Offender Certification</legend>
        <div class="callout callout-info">
            <h4>Certification Regarding Sex Offender Registry</h4>
            <p>The Certification Regarding Sex Offender Registry form is mailed to the Utah BCI and returned with a signature indicating whether or not you are listed on the sex offender registry.  It is required that you submit this form to the court with your name/gender change petition.</p>
            <span class="label label-danger">Notice!</span> If you are listed as a sex offender, you may wish to seek legal counsel.  Name changes for registered sex offenders are forbidden by the state.
        </div>
        @component('partials.form-date-row', [
            'label'=>'Date of Birth',
            'name'=>'data[date_of_birth]',
            'value'=>'',
            'help'=>'MM/DD/YYYY format please!'
        ])@endcomponent

        @component('partials.form-input-row', [
            'label'=>'Driver\'s License/ID Number',
            'name'=>'data[drivers_license_number]',
            'value'=>'',
            'help'=>''
        ])@endcomponent

        @component('partials.form-select-row', [
            'label'=>'Driver\'s License/ID Issuing State',
            'name'=>'data[drivers_license_state]',
            'values'=>$states,
            'help'=>'An ID or driver\'s license is required for this form.  I am not sure what to do if you do not have one; please let me know!'
        ])@endcomponent
    </div>
</div>