/**
 * Adds a .duplicatable-input-group class that will allow an import-group to be duplicated with a + button on the right
 *
 * TODO: turn this into a jquery plugin like bootstrap components?
 *
 * Attributes:
 *      data-add-icon[fa fa-plus]: the add icon
 *      data-add-class[btn btn-success]: add btn class (coloring or whatever)
 *      data-remove-icon[fa fa-minus]: the remove icon
 *      data-remove-class[btn btn-danger]: remove btn class (coloring or whatever)
 *      data-animate[true]:set to false to turn off animations
 *      data-animation-speed[fast]:animate speed
 *      data-animation-easing[smooth]: animate easing
 *
 * Example
 * <div class="form-group">
 *     <label class="form-label">Past Legal Names</label>
 *     <div class="controls">
 *         <div class="input-group duplicatable-input-group"
 *                 data-add-icon="fa fa-plus"
 *                 data-add-class="btn btn-success"
 *                 data-remove-icon="fa fa-minus"
 *                 data-remove-class="btn btn-danger"
 *                 ...etc
 *                 >
 *             <input class="form-control" name="data[name_change][past_legal_names][]" type="text" placeholder="Past Legal Names" />
 *         </div>
 *     </div>
 * </div>
 */

function duplicatableInputGroupOptions(inputGroup) {
    var options = {
        add_icon:$(inputGroup).data('add-icon') || 'fa fa-plus',
        add_class:$(inputGroup).data('add-class') || 'btn btn-success',
        remove_icon:$(inputGroup).data('remove-icon') || 'fa fa-minus',
        remove_class:$(inputGroup).data('remove-class') || 'btn btn-danger',
        animate:$(inputGroup).data('animate') == null? true : $(inputGroup).data('animate'),
        animation_speed:$(inputGroup).data('animation-speed') || '400',
        animation_easing:$(inputGroup).data('animation-easing') || 'linear'
    };

    return options;
}

$(function() {
   $('.input-group.duplicatable-input-group').each(function(index, inputGroup) {
       var options = duplicatableInputGroupOptions(inputGroup);

       var btn = '<span class="input-group-btn">'+
           '    <button class="'+options.add_class+' btn-add" type="button">'+
           '        <i class="'+options.add_icon+'"></i>'+
           '    </button>'+
           '</span>';

       $(inputGroup).append(btn);
   });
});

$(document).on('click', '.duplicatable-input-group .btn-add', function(e) {
    e.preventDefault();

    var groupContainer = $(this).parents('.duplicatable-input-group:first').parent(),
        currentEntry = $(this).parents('.duplicatable-input-group:first'),
        newEntry = $(currentEntry.clone()).hide().appendTo(groupContainer);

    var options = duplicatableInputGroupOptions(currentEntry);

    if(options.animate) {
        newEntry.slideDown(options.animation_speed, options.animation_easing);
    } else {
        newEntry.show();
    }

    newEntry.find('input').val('');
    groupContainer.find('.duplicatable-input-group:not(:last) .btn-add')
        .removeClass('btn-add').addClass('btn-remove')
        .removeClass(options.add_class).addClass(options.remove_class)
        .html('<i class="'+options.remove_icon+'"></i>');
}).on('click', '.duplicatable-input-group .btn-remove', function(e) {
    e.preventDefault();
    $(this).parents('.duplicatable-input-group:first').remove();
    return false;
});
