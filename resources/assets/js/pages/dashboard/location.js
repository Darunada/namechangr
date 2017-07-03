
$stateIdSelect = $('#state-id');
$countyIdSelect = $('#county-id');
$districtIdSelect = $('#district-id');

function init() {
    setCountyState('reset');
}

function setCountyState(state) {
    switch(state) {
        case 'reset':
            setDistrictState('reset');
            $countyIdSelect.html('<option>Select a State First</option>').prop('disabled', true);
            break;
        case 'loading':
            setDistrictState('reset');
            $countyIdSelect.html('<option>Loading...</option>').prop('disabled', true);
            break;
        case 'active':
            $countyIdSelect.prop('disabled', false);
            break;
    }
}

function setDistrictState(state) {
    switch(state) {
        case 'reset':
            $districtIdSelect.html('<option>Select a County First</option>').prop('disabled', true);
            break;
        case 'loading':
            $districtIdSelect.html('<option>Loading...</option>').prop('disabled', true);
            break;
        case 'active':
            $districtIdSelect.prop('disabled', false);
            break;
    }
}

// when a state is selected load counties
$stateIdSelect.change(function(e) {
    setCountyState('loading');

    var stateId = $('#state-id option:selected').val();

    axios.get('/states/'+stateId+'/counties')
        .then(function(response) {
            var counties = response.data;
            var options = '<option>Select a County</option>';
            for(let i = 0; i < counties.length; i++) {
                options += '<option value="'+counties[i].id+'">'+counties[i].name+'</option>';
            }

            $countyIdSelect.html(options);
            setCountyState('active');
        }).catch(function (error) {
            setCountyState('reset');
        });
});

// when a state is selected load counties
$countyIdSelect.change(function(e) {
    setDistrictState('loading');

    var stateId = $('#state-id option:selected').val();
    var countyId = $('#county-id option:selected').val();

    axios.get('/states/'+stateId+'/counties/'+countyId)
        .then(function(response) {
            var districts = response.data.districts;
            var options = '<option>Select a District</option>';
            for(let i = 0; i < districts.length; i++) {
                options += '<option value="'+districts[i].id+'">'+districts[i].name+'</option>';
            }
            $districtIdSelect.html(options);
            setDistrictState('active');
        }).catch(function (error) {
            setDistrictState('reset');
        });
});



init();



// when a county is selected narrow districts
// when a district is selected narrow counties
// when a district is selected show locations