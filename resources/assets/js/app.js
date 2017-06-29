
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

$(function () {
    $('.btn-confirm').on('click', function (e) {
        e.preventDefault();
        var $btn = $(this);

        var text = $btn.data('confirm-text');
        if (text === undefined || text.length == 0) {
            text = "Are you sure?";
        }

        var callback = $btn.data('after-confirm')

        window.bootbox.confirm(text, function (result) {
            if (result == true) {
                eval(callback);
            }
        });
    });
});