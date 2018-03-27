$(function() {
  $('#formLogin').validate({
    rules: {
      form_login_email: {
        'required': true,
        'email': true
      },
      form_login_password: {
        'required': true,
        'minlength': 5
      }
    },

    messages: {
      form_login_email:{
        'required': 'Completa este campo/ Enter this field',
        'email': 'Ingrese un correo válido/ Enter a valid email address'
      },
      form_login_password:{
        'required': 'Completa este campo/ Enter this field',
        'minlength': 'Completa al menos 5 caracteres/ Enter at least 5 characters'
      }
    }
  });
});

$(function() {
  $("#form_register_explorer").validate({
    rules: {
      form_register_full_name: {
        'required': true,
      },
      form_register_email: {
        'required': true,
        'email': true
      },
      form_register_password: {
        'required': true,
        'minlength': 5
      },
      form_register_confirm_password: {
        'required': true,
        'minlength': 5
      },
      form_register_year: {
        'required': true
      },
      form_register_month: {
        'required': true
      },
      form_register_day: {
        'required': true
      }
    },

    messages: {
      form_register_full_name:{
        'required': 'Completa este campo/ Enter this field'
      },
      form_register_email:{
        'required': 'Completa este campo/ Enter this field',
        'email': 'Ingrese un correo válido/ Enter a valid email address'
      },
      form_register_password: {
        'required': 'Completa este campo/ Enter this field',
        'minlength': 'Completa al menos 5 caracteres/ Enter at least 5 characters'
      },
      form_register_confirm_password: {
        'required': 'Completa este campo/ Enter this field',
        'minlength': 'Completa al menos 5 caracteres/ Enter at least 5 characters'
      },
      form_register_year: {
        'required': 'Completa/ Enter'
      },
      form_register_month: {
        'required': 'Completa/ Enter'
      },
      form_register_day: {
        'required': 'Completa/ Enter'
      }
    }
  });
});

$(function() {
  $("#form_validate_explorer").validate({
    rules: {
      form_mobile: {
        'required': true,
        'digits': true,
        'minlength': 10,
        'maxlength': 10
      },
      form_mobile_code: {
        'required': true,
        'digits': true,
        'minlength': 4,
        'maxlength': 4
      },
      form_email_code: {
        'required': true,
        'digits': true,
        'minlength': 4,
        'maxlength': 4
      }
    },

    messages: {
      form_mobile: {
        'required': 'Completa este campo/ Enter this field',
        'digits': 'Solo números/ Only numbers',
        'minlength': 'Solo 10 dígitos/ Only 10 digits',
        'maxlength': 'Solo 10 dígitos/ Only 10 digits'
      },
      form_mobile_code: {
        'required': 'Completa este campo/ Enter this field',
        'digits': 'Solo números/ Only numbers',
        'minlength': 'Solo 4 dígitos/ Only 4 digits',
        'maxlength': 'Solo 4 dígitos/ Only 4 digits'
      },
      form_email_code: {
        'required': 'Completa este campo/ Enter this field',
        'digits': 'Solo números/ Only numbers',
        'minlength': 'Solo 4 dígitos/ Only 4 digits',
        'maxlength': 'Solo 4 dígitos/ Only 4 digits'
      }
    }
  });
});