var BaseFormValidation = function() {

    // Init Material Forms Validation: https://github.com/jzaefferer/jquery-validation
    var initValidationMaterial = function() {
        jQuery( '.js-validation-material-project-regist' ).validate({
            errorClass: 'help-block text-right animated fadeInDown',
            errorElement: 'div',
            errorPlacement: function(error, e) {
                jQuery(e).parents( '.form-group .form-material' ).append( error );
            },
            highlight: function(e) {
                jQuery(e).closest( '.form-group' ).removeClass( 'has-error' ).addClass( 'has-error' );
                jQuery(e).closest( '.help-block' ).remove();
            },
            success: function(e) {
                jQuery(e).closest( '.form-group' ).removeClass( 'has-error' );
                jQuery(e).closest( '.help-block' ).remove();
            },
            rules: {
                'txt-projecttitle': {
                    required: true
                }
            },
            messages: {
              'txt-projecttitle': {
                  required: 'Please enter project title...'
              }
            }

        });
    };

    return {
        init: function () {
            // Init Meterial Forms Validation
            initValidationMaterial();
        }
    };
}();

// Initialize when page loads
jQuery( function() {
	BaseFormValidation.init();
});
