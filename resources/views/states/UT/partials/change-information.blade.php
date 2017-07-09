<div class="row form-row">
    <div class="col-sm-6">
        <div class="callout callout-info">
            <h4>Past Legal Names</h4>
            <p>
                I heard someone had trouble getting an updated Utah birth certificate
                because their maiden name was not listed on their court order, so I added this section.
            </p>
            <p><span class="label label-danger">Notice!</span> If you have previous legal names, due to marriage or otherwise, list them here in order from most recent to oldest.  You do not need to include your current legal name.</p>
        </div>

        <div class="form-group">
            <label class="form-label">Past Legal Names</label>
            <div class="controls">
                <div class="input-group duplicatable-input-group">
                    <input class="form-control" name="data[past_legal_names][]" type="text" placeholder="Past Legal Name" />
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Your Requested Name</label>
            <div class="controls">
                <div class="input-group lovely">
                    <input class="form-control" name="data[requested_legal_name]" type="text" placeholder="Check the spelling! :-)" />
                    <div class="input-group-addon">
                        <span class="text-very-muted"><i class="fa fa-remove"></i></span>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-sm-6">
        <legend>Gender Change</legend>

        @component('partials.form-input-row', [
            'label'=>'Full Legal Name',
            'name'=>'garbage',
            'value'=>'',
            'help'=>'Your full and legal name, including middle name'
        ])@endcomponent

    </div>
</div>