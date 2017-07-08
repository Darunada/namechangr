<div class="row form-row">

    @if($application->name_change)
        <div class="col-sm-6">
            <legend>Name Change</legend>

        </div>
    @endif
    @if($application->gender_change)
        <div class="col-sm-6">
            <legend>Gender Change</legend>

            @component('partials.form-input-row', [
                'label'=>'Full Legal Name',
                'name'=>'garbage',
                'value'=>'',
                'help'=>'Your full and legal name, including middle name'
            ])@endcomponent

        </div>
    @endif
</div>