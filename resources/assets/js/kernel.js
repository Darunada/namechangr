NAMECHANGR = {
    common: {
        init: function() {
            // site-wide code
         }
     },
    ProfileController: {
        init: function() {
            // controller-wide code
        },
        index: function() {
            require('./components/btn-confirm.js');
        }
    },
    DashboardController: {
        init: function() {

        },
        index: function() {
            require('./components/btn-confirm.js');
        }
    }
};

KERNEL = {
    exec: function( controller, action ) {
        var ns = NAMECHANGR, action = ( action === undefined ) ? "init" : action;

        if ( controller !== "" && ns[controller] && typeof ns[controller][action] == "function" ) {
            ns[controller][action]();
        }
    },
    init: function() {
        var body = document.body, controller = body.getAttribute( "data-controller" ), action = body.getAttribute( "data-action" );
        KERNEL.exec( "common" );
        KERNEL.exec( controller );
        KERNEL.exec( controller, action );
    }
};

$( document ).ready( KERNEL.init );
