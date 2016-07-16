var BaseFormValidation = function() {

    // Init Material Forms Validation: https://github.com/jzaefferer/jquery-validation
    var initValidationMaterial = function() {
        jQuery( '.js-validation-material' ).validate({
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
                'txt-fname': {
                    required: true
                },
                'txt-lname': {
                    required: true
                },
                'txt-phone': {
                    required: true
                },
                'txt-email': {
                    required: true,
                    email: true
                },
                'txt-department': {
                    required: true
                },
                'txt-prefix': {
                    required: true
                }
            },
            messages: {
              'txt-fname': {
                  required: 'กรุณากรอกชื่อจริงของท่าน'
              },
              'txt-lname': {
                  required: 'กรุณากรอกนามสกุลของท่าน'
              },
              'txt-phone': {
                  required: 'กรุณากรอกหมายเลขโทรศัพท์ที่ติดต่อได้'
              },
              'txt-email': {
                  required: 'กรุณากรอกอีเมลของท่าน',
                  email: 'กรุณากรอกอีเมลให้ถูกต้อง'
              },
              'txt-department': {
                  required: 'กรุณาเลือกหน่วยงานหรือสาขาวิชาของท่าน'
              },
              'txt-prefix': {
                  required: 'กรุณาเลือกคำนำหน้าชื่อ'
              }
            }

        });
    };

    var initValidationMaterial_deptadd = function() {
        jQuery( '.js-validation-material-adddept' ).validate({
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
                'txt-deptadd': {
                    required: true
                }
            },
            messages: {
              'txt-deptadd': {
                  required: 'กรุณากรอกชื่อสาขาวิชา / ภาควิชา'
              }
            }

        });
    };

    return {
        init: function () {
            // Init Meterial Forms Validation
            initValidationMaterial();

            // Init Meterial Department add Forms Validation
            initValidationMaterial_deptadd();
        }
    };
}();

// Initialize when page loads
jQuery( function() {
	BaseFormValidation.init();
});
