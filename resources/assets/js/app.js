
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes jquery, bootstrap, axios, other libraries.
 *
 * These are the main core big deal libraries
 */
require('./bootstrap');

/**
 * Other libraries
 */
window.bootbox = require('bootbox');
require('jquery-steps/build/jquery.steps.js');

/**
 * Components
 */
require('./components/btn-confirm.js');
require('./components/duplicatable-input-group.js');
require('./components/lovely.js');

$(function() {
    $('[data-toggle="popover"]').popover();
    $('[data-toggle="tooltip"]').tooltip();
});