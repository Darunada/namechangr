<div class="form-group">
    <label class="form-label">{{ $label }}</label>
    <div class="controls">
        <select name="{{ $name }}" class="form-control">
            <option value="">Select...</option>
            @foreach($values as $value=>$name)
                <option value="{{ $value }}">{{ $name }}</option>
            @endforeach
        </select>
        <p class="help-block">{{ $help }}</p>
    </div>
</div>