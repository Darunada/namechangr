
<div class="form-group">
    <label for="county-id" class="control-label">County</label>
    <select id="county-id" class="form-control" name="data[county_id]">
        <option value="">Select a County</option>
        @foreach ($counties as $countyId => $countyName)
            <option value="{{ $countyId }}" {{ array_key_exists('county_id', $application->data) && $application->data['county_id'] == $countyId ? 'selected="selected"':'' }}>{{ $countyName }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="district-id" class="control-label">District</label>
    <select id="district-id" class="form-control" name="data[district_id]">
        @foreach ($districts as $districtId => $districtName)
            <option value="{{ $districtId }}" {{ array_key_exists('district_id', $application->data) && $application->data['district_id'] == $districtId ? 'selected="selected"':'' }}>{{ $districtName }}</option>
        @endforeach
    </select>
</div>

<legend>Court Locations</legend>
<div class="form-group">
    <div class="controls">
        <div class="col-md-12">
            <div class="locations-container">
                @foreach($locations AS $location)
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 location-block">
                        <label class="radio">
                            <input type="radio" class="court-location" name="data[location_id]" value="{{ $location->id }}"
                                {{ array_key_exists('location_id', $application->data) && $application->data['location_id'] == $location->id ? 'checked="checked"':'' }}/>
                            <address>
                                <pre>{{ $location->address }}<br/><a href="https://www.google.com/maps/place/{{ urlencode($location->address) }}" target="_blank" rel="noopener"><i class="fa fa-map-marker"></i> View On Map</a></pre>
                            </address>
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>