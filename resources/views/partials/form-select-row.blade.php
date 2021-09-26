@php
    if(!isset($value)):
        $value = '';
    endif
@endphp
<div class="form-group">
    <label class="form-label">{{ $label }}</label>
    <div class="controls">
        <select name="{{ $name }}" class="form-control">
            <option value="">Select...</option>
            @foreach($values as $id=>$name)
                <option value="{{ $id }}" {{ $id==$value?'selected="selected"':'' }}>{{ $name }}</option>
            @endforeach
        </select>
        <p class="help-block">{{ $help }}</p>
    </div>
</div>
