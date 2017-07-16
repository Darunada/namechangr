/**
 * Created by Lea on 7/4/2017.
 */

require('./steps.js');
require('./location-picker.js');

window.delete_file = function(file_id) {
    var $btn = $('.delete-file-btn[data-file-id="'+file_id+'"]');
    $btn.button('loading');

    axios.delete('/applications/'+window.Laravel.application.id+'/delete/'+file_id).then(function (response) {
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

function pollForGenerationStatus(seconds, tries) {
    console.log('starting interval for '+seconds+' seconds.  Try '+tries);

    setTimeout(function() {
        console.log('checking!');
        axios.get('/applications/'+window.Laravel.application.id)
            .then(function (response) {
                console.log(response.data);
                if(response.data.success == true) {
                    if(response.data.application.is_generating_documents) {
                        var time = 15; // seconds
                        if(tries > 12) {
                            time = 60;
                        }
                        pollForGenerationStatus(time, tries+1);
                    } else {
                        $('#generated-documents-section').html(response.data.html);
                        $('#documents-generating-row').hide();
                        $('.generate-application-btn[disabled]').removeClass('disabled').removeAttr('disabled').html('<i class="fa fa-envelope-o"></i> Email my Docs');
                    }
                } else {
                    console.log('error polling for generation status', response);
                }
            }).catch(function (error) {
            });


    }, seconds*1000);

}

function saveApplication(e) {
    var $form = $('#application-form');

    var data = $('#application-form').serialize();
    axios.put('/applications/'+window.Laravel.application.id, data)
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

        axios.get('/applications/'+window.Laravel.application.id+'/generate/'+$btn.data('type'))
            .then(function (response) {
                window.Laravel.application = response.data.application;
                if(response.data.success == true) {
                    $('#documents-generating-row').show();
                    $('#documents-error-row').hide();

                    $btn.html('<i class="fa fa-spinner fa-spin"></i> Documents are generating...');

                    pollForGenerationStatus(5);
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


