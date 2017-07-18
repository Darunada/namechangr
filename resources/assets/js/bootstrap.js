
/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */
try {
    window.$ = window.jQuery = require('jquery');
    window._ = window.Underscore = require('underscore');

    require('bootstrap-sass');

} catch (e) {}

/**
 * Load in jquery validator and set some common sense defaults
 */
require('jquery-validation');

jQuery.validator.setDefaults({
    errorClass: "text-danger help-block",
    errorElement: "p",
    validClass: "",
    errorPlacement: function (error, element) {
        element.closest('.form-group').find('.text-danger').remove();
        element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
        var formGroup = $(element).closest('.form-group');
        formGroup.find('.form-control-feedback').remove();
        formGroup.addClass("has-error");
    },
    unhighlight: function (element, errorClass, validClass) {
        var formGroup = $(element).closest('.form-group');
        formGroup.find('.form-control-feedback, .text-danger').remove();
        formGroup.removeClass("has-error");
    }
});

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.baseURL = '/api/v1';

// Add a response interceptor
window.axios.interceptors.response.use(function (response) {
    return response;
}, function (error) {
    if(error.response.status == 401) {
        bootbox.dialog({
            // boy would it be great to put a login form here!
            message: "Your session has expired.  Please log in to continue.",
            onEscape: false,
            backdrop: true,
            closeButton: false,
            buttons: {
                okButton : {
                    label: 'Ok',
                    className: "btn-primary",
                    callback: function(result) {
                        window.location = '/login';
                    }
                }
            }
        });
    }

    // Do something with response error
    return Promise.reject(error);
});

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */
let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });
