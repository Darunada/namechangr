/**
 * Created by Lea on 7/4/2017.
 */

require('./steps.js');
require('./location-picker.js');

$(document).ready(function () {
    window.validator = $( "#application-form" ).validate({
        debug:true,
        rules: {
            'data[county_id]': {
                required: true
            },
            'data[district_id]': {
                required: true
            },
            'data[location_id]': {
                required: true
            }

        }

    });


    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
        saveApplication(e);
    });
});

function saveApplication($e) {
    var $form = $('#application-form');

    var data = $('#application-form').serialize();
    axios.post($form.attr('action'), data)
        .then(function (response) {
            console.log('saved');
            //console.log(response);
        }).catch(function (error) {
            //console.log(error);
            console.log('error saving');
        });
}