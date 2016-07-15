// Initialize when page loads
jQuery( function() {
	BaseFormValidation.init();
});

var BaseFormValidation = function() {

  var initValidation_login = function(){
    jQuery('.js-validation-login').validate({
        errorClass: 'help-block animated fadeInDown',
        errorElement: 'div',
        errorPlacement: function( error, e ) {
            jQuery(e).parents( '.form-group > div' ).append( error );
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
            'txt-username': {
                required: true
            },
            'txt-password': {
                required: true
            }
        },
        messages: {
          'txt-username': {
              required: 'กรุณากรอกชื่อบัญชีผู้ใช้หรืออีเมล!'
          },
          'txt-password': {
              required: 'กรุณากรอกรหัสผ่าน!'
          }
        }
    });
  };


  return {
        init: function () {
            // Init Bootstrap Forms Validation for form log in
            initValidation_login();
        }
    };
}();
