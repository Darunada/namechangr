<hr/>
<div class="callout callout-info">
    <h4>Name Change Form</h4>
    <p>The Name Change form is the key to it all, and it's used as the base document for both name and gender changes.</p>
</div>

<div class="row form-row">
    <div class="col-sm-6">
        <div class="form-group">
            <label class="form-label">Past Legal Names</label>
            <div class="controls">
                <div class="input-group duplicatable-input-group">
                    <input class="form-control" name="data[past_legal_names][]" type="text" placeholder="Past Legal Name"/>
                </div>
            </div>
            <div class="help-block">
                NOT IMPLEMENTED YET!!! Required if previously married or had a past name change.
                <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Why do I need this?"
                   data-content="Someone told me they had trouble getting a Utah birth certificate because they did not list their maiden name.  If you have any previous legal names, list them here, if you want."><i
                        class="fa fa-question-circle"></i></a>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label class="form-label">Your Requested Name</label>
            <div class="controls">
                <div class="input-group lovely {{ !empty($application->data['requested_legal_name'])?'lovely-open':'' }}">
                    <input class="form-control" name="data[requested_legal_name]" type="text" placeholder="Check the spelling! :-)"
                           value="{{ array_key_exists('requested_legal_name', $application->data)?$application->data['requested_legal_name']:'' }}"/>
                    <div class="input-group-addon">
                        <span class="text-very-muted"><i class="fa fa-remove"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<hr/>
<div class="callout callout-info">
    <h4>Gender Change Form</h4>
    <p>A gender change form is a modified version of the name change form, with just a few extra clauses added.</p>
    <p><span class="label label-info">Info!</span> For the 'reason' I used, "It is a much better match for my identity." and that worked for
        me. Other people wrote much more and that worked for them.</p>
</div>

<div class="row form-row">
    <div class="col-sm-6">
        <div class="form-group">
            <div class="col-xs-6 col-sm-12 col-md-6">
                <label class="form-label">Current Legal Gender</label>
                <div class="controls">
                    <label class="radio">
                        <input type="radio" name="data[current_gender]"
                               value="male" {{ array_key_exists('current_gender', $application->data) && $application->data['current_gender'] == 'male'?'checked="checked"':'' }}/>
                        Male
                    </label>
                    <label class="radio">
                        <input type="radio" name="data[current_gender]"
                               value="female" {{ array_key_exists('current_gender', $application->data) && $application->data['current_gender'] == 'female'?'checked="checked"':'' }}/>
                        Female
                    </label>
                    <label class="radio">
                        <label for="current-gender-other" class="sr-only">Other</label>
                        <input type="radio" name="data[current_gender]" value="other"
                               {{ array_key_exists('current_gender', $application->data) && $application->data['current_gender'] == 'other'?'checked="checked"':'' }} id="current-gender-other"/>

                        <label for="current-gender-other-desc" class="sr-only">Explain</label>
                        <input type="text" id="current-gender-other-desc" class="form-control" name="data[current_gender_other]"
                               value="{{ array_key_exists('current_gender_other', $application->data)?$application->data['current_gender_other']:'' }}"
                               placeholder="Other"/>
                    </label>
                </div>
            </div>
            <div class="col-xs-6 col-sm-12 col-md-6">
                <label class="form-label">Requested Gender</label>
                <div class="controls">
                    <label class="radio">
                        <input type="radio" name="data[requested_gender]"
                               value="male" {{ array_key_exists('requested_gender', $application->data) && $application->data['requested_gender'] == 'male'?'checked="checked"':'' }}/>
                        Male
                    </label>
                    <label class="radio">
                        <input type="radio" name="data[requested_gender]"
                               value="female" {{ array_key_exists('requested_gender', $application->data) && $application->data['requested_gender'] == 'female'?'checked="checked"':'' }}/>
                        Female
                    </label>
                    <label class="radio">
                        <label for="requested-gender-other" class="sr-only">Other</label>
                        <input type="radio" name="data[requested_gender]" value="other"
                               {{ array_key_exists('requested_gender', $application->data) && $application->data['requested_gender'] == 'other'?'checked="checked"':'' }} id="current-gender-other"/>

                        <label for="current-gender-other" class="sr-only">Explain</label>
                        <input type="text" class="form-control" name="data[requested_gender_other]"
                               value="{{ array_key_exists('requested_gender_other', $application->data)?$application->data['requested_gender_other']:'' }}"
                               placeholder="Other"/>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row form-row">
    <div class="col-sm-6">
        <div class="form-group">
            <label class="control-label">Reason</label>
            <div class="controls">
                <textarea class="form-control"
                          name="data[gender_change_reason]">{{ array_key_exists('gender_change_reason', $application->data)?$application->data['gender_change_reason']:'' }}</textarea>
            </div>
        </div>
    </div>
</div>
