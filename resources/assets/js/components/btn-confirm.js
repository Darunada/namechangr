/**
 * Adds a .btn-confirm class that will prompt for confirmation before completing an action
 * Attributes:
 *      data-confirm-text: the message displayed in the confirmation dialog
 *      data-after-confirm: the js that will be evaled after successful confirmation
 *
 * Example
 * <a href="/profile"
 *    class="btn btn-confirm"
 *    data-confirm-text="Are you sure you want to delete your account?"
 *    data-after-confirm="document.getElementById('destroy-account-form').submit();">
 *      Destroy my Account
 * </a>
 * <a href="">Destroy my Account</a>
 */
$('.btn-confirm').on('click', function (e) {
    e.preventDefault();
    var $btn = $(this);

    var text = $btn.data('confirm-text');
    if (text === undefined || text.length == 0) {
        text = "Are you sure?";
    }

    var callback = $btn.data('after-confirm')
    if(callback == undefined && $btn.has('href')) {
        callback = 'window.location = "'+$btn.attr('href')+'";';
    }

    window.bootbox.confirm(text, function (result) {
        if (result == true) {
            eval(callback);
        }
    });
});