/**
 * When the change event is fired on a lovely box,
 *  - it will show a spinner for 1.5 seconds
 *  - then it will show a heart for 0.5 seconds
 *  - then it will scroll the word "LOVELY" in from the side
 *
 * TODO: turn this into a jquery plugin like bootstrap components?
 *
 * Attributes:
 *  - none yet!
 *
 * Example
 * <div class="form-group">
 *     <label class="form-label">Your Requested Name</label>
 *     <div class="controls">
 *         <div class="input-group lovely">
 *             <input class="form-control" name="data" type="text"/>
 *             <div class="input-group-addon">
 *                 <span class="text-muted"><i class="fa fa-remove"></i></span>
 *             </div>
 *         </div>
 *     </div>
 * </div>
 */

function makeLovely($icon) {
    var lovely = '<span class="text-lovely">'+
        '    <i class="fa fa-heart"></i>'+
        '</span>'+
        '<span class="text-lovely-slider closed">'+
        '    &nbsp;&nbsp;'+
        '    <span class="text-lovely-l">Ｌ</span>'+
        '    <span class="text-lovely-o">Ｏ</span>'+
        '    <span class="text-lovely-v">Ｖ</span>'+
        '    <span class="text-lovely-e">Ｅ</span>'+
        '    <span class="text-lovely-l2">Ｌ</span>'+
        '    <span class="text-lovely-y">Ｙ</span>';
    '</span>';

    $icon.html(lovely);
    setTimeout(function() {
        $icon.find('.text-lovely-slider:first').removeClass('closed');
    }, 100);
}

$(function() {

    $('.lovely').each(function(index, input) {
        var $input = $(input).find('input:last');
        var $icon = $(input).find('.input-group-addon:first');

        if($(this).hasClass('lovely-open')) {
            makeLovely($icon, 0);
        }

        $input.change(function() {
            $icon.html('<span class=""><i class="fa fa-spinner fa-spin"></i></span>');
            setTimeout(function() {
                makeLovely($icon, 100);
            }, 1000);
        });
    });
});
