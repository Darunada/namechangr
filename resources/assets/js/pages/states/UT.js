/**
 * Created by Lea on 7/4/2017.
 */

require('./steps.js');
require('./location-picker.js');

window.delete_file = function(file_id) {
    var $btn = $('.delete-file-btn[data-file-id="'+file_id+'"]');
    $btn.button('loading');

    axios.delete($btn.attr('href')).then(function (response) {
        if(response.data.success == true) {
            $btn.closest('tr').remove();
        } else {
            console.log('error deleting file!');
            $btn.button('reset');
        }
    }).catch(function (error) {
        console.log('error deleting file! exception');
        $btn.button('reset');
    });
};

function showGenerationError(returned) {
    console.log('failed generating documents.  Returned: '+returned);
    $('#documents-generating-row').hide();
    $('#documents-error-row').show();
}

function saveApplication(e) {
    var $form = $('#application-form');

    var data = $('#application-form').serialize();
    axios.post($form.attr('action'), data)
        .then(function (response) {
            window.Laravel.application = response.data.application;
        }).catch(function (error) {
        });
}

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

    $('#application-form .generate-application-btn').click(function(e) {
        e.preventDefault();
        var $btn = $(this);
        $btn.button('loading');

        var data = $('#application-form').serialize();
        data += '&type='+$btn.data('type');

        axios.post($btn.attr('href'), data)
            .then(function (response) {
                window.Laravel.application = response.data.application;
                if(response.data.success == true) {
                    $('#documents-generating-row').show();
                    $('#documents-error-row').hide();

                    $btn.html('<i class="fa fa-spinner fa-spin"></i> Documents are generating...');
                } else {
                    showGenerationError(true);
                    $btn.button('reset');
                }
            }).catch(function (error) {
                showGenerationError(false);
                $btn.button('reset');
            });
    });
});


