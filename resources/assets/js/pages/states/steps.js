$(document).ready(function () {
    
    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

        var $target = $(e.target);

        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });

    $(".next-step").click(function (e) {

        var curStep = $(this).closest('.tab-pane'),
            curInputs = curStep.find('input, select'),
            isValid = true;

        if (window.validator !== undefined) {
            for (var i = 0; i < curInputs.length; i++) {
                if (!window.validator.element(curInputs[i])) {
                    isValid = false;
                }
            }
        }

        if (isValid) {
            var $active = $('.board .nav-tabs li.active');
            $active.next().removeClass('disabled');
            nextTab($active);
        }

    });

    $(".prev-step").click(function (e) {

        var $active = $('.board .nav-tabs li.active');
        prevTab($active);

        var $btn = $(this);
        var callback = $btn.data('callback');
        if(callback != undefined) {
            $btn.button('loading');
            var result = {callback}($btn);
            $btn.button('reset');

            if(result === false) {
                return false;
            }
        }

    });
});

function nextTab(elem) {
    $(elem).next().find('a[data-toggle="tab"]').click();
}

function prevTab(elem) {
    $(elem).prev().find('a[data-toggle="tab"]').click();
}