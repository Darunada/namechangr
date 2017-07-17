
function setDistrictState(state) {
    switch(state) {
        case 'reset':
            setLocationState('reset');
            $districtIdSelect.html('<option>Select a County First</option>').prop('disabled', true);
            break;
        case 'loading':
            setLocationState('reset');
            $districtIdSelect.html('<option>Loading...</option>').prop('disabled', true);
            break;
        case 'active':
            $districtIdSelect.prop('disabled', false);
            break;
    }
}

function setLocationState(state) {
    switch(state) {
        case 'reset':
            $locations.html('Select a district first...');
            break;
        case 'loading':
            $locations.html('<i class="fa fa-spinner fa-spin"></i> Loading...');
            break;
        case 'active':

            break;
    }
}

$(function() {

    $countyIdSelect = $('#county-id');
    $districtIdSelect = $('#district-id');
    $locations = $('.locations-container');


    // when a county is selected load districts
    $countyIdSelect.change(function(e, defaults) {
        setDistrictState('loading');

        var countyId = $('#county-id option:selected').val();

        axios.get('/counties/'+countyId)
            .then(function(response) {
                var districts = response.data.districts;
                var options = '<option value="">Select a District</option>';
                for(let i = 0; i < districts.length; i++) {
                    options += '<option value="'+districts[i].id+'">'+districts[i].name+'</option>';
                }
                $districtIdSelect.html(options);
                setDistrictState('active');

                if(defaults != undefined) {
                    if (defaults.district_id) {
                        $('#district-id option:selected').removeProp('selected');
                        $('#district-id option[value="' + defaults.district_id + '"]').prop('selected', 'selected');
                    }

                    if (defaults.location_id) {
                        $('#district-id').trigger('change', defaults);
                    }
                }
            }).catch(function (error) {
                setDistrictState('reset');
            });
    });

    $districtIdSelect.change(function(e, defaults) {
        setLocationState('loading');

        var countyId = $('#county-id option:selected').val();
        var districtId = $('#district-id option:selected').val();

        if(defaults == undefined) {
            defaults = {location_id:null};
        }

        axios.get('/locations', {
                params: {
                    county_id: countyId,
                    district_id: districtId
                }
            })
            .then(function(response) {
                var locations = response.data;

                var html = '<div class="help-block">Remember to double check these with another source!</div>';
                for(var i in locations) {
                    var location = locations[i];
                    html += '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 location-block">' +
                        '<label class="radio">' +
                        '<input type="radio" class="court-location" name="data[location_id]" value="'+location.id+'" '+(defaults.location_id==location.id?'checked="checked"':'')+'/>' +
                        '<address>' +
                        '<pre>'+location.address+'<br/><a href="https://www.google.com/maps/place/'+encodeURIComponent(location.address)+'" target="_blank" rel="noopener"><i class="fa fa-map-marker"></i> View On Map</a></pre>' +
                        '</address>' +
                        '</label>' +
                        '</div>';

                }

                $locations.html(html);
                setLocationState('active');
            }).catch(function (error) {
                setLocationState('reset');
            });
    });
});
