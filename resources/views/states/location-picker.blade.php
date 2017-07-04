
<div class="form-group">
    <label for="county-id" class="control-label">County</label>
    <select id="county-id" class="form-control" name="data[county_id]">
        <option value="">Select a County</option>
        @foreach ($counties as $countyId => $countyName)
            <option value="{{ $countyId }}">{{ $countyName }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="district-id" class="control-label">District</label>
    <select id="district-id" class="form-control" name="data[district_id]">
    </select>
</div>

<legend>Court Locations</legend>
<div class="form-group">
    <div class="controls">
        <div class="col-md-12">
            <div class="locations-container"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>