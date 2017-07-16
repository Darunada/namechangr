@php
    // ew
    if(!isset($value)):
        $value = ['address1'=>'', 'city'=>'', 'state_id'=>'', 'zipcode'=>''];
    endif;
@endphp

<div class="address">
    @component('partials.form-input-row', [
        'label'=>$label,
        'name'=>$name.'[address1]',
        'value'=>$value['address1'],
        'help'=>$help
    ])@endcomponent
    <div class="row form-row">
        <div class="col-lg-4">
            @component('partials.form-input-row', [
                'label'=>'City',
                'name'=>$name.'[city]',
                'value'=>$value['city'],
                'help'=>''
            ])@endcomponent
        </div>
        <div class="col-lg-4">
            @component('partials.form-select-row', [
                'label'=>'State',
                'name'=>$name.'[state_id]',
                'values'=>$states,
                'value'=>$value['state_id'],
                'help'=>''
            ])@endcomponent
        </div>
        <div class="col-lg-4">
            @component('partials.form-input-row', [
                'label'=>'Zipcode',
                'name'=>$name.'[zipcode]',
                'value'=>$value['zipcode'],
                'help'=>''
            ])@endcomponent
        </div>
    </div>
</div>