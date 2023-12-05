 "use strict";
var formlogin = $('#formlogin');

$(function() {
    Login.init();
    Login.events();
});

var Login = {
    init: function() {

        /////////////////////////////
        $("#ingUsuario").val("");
        $("#ingPassword").val("");
        sessionStorage.setItem('forgotPasswordStep', '1');
        var codeClient = location.search.split('code=')[1];
        /////////////////////////////
        $('#formlogin').validate({
            debug: true,
            rules: {
                ingUsuario: {
                    required: true,
                    email: true
                },
                ingPassword: {
                    required: true
                }
            },
            messages: {
                ingUsuario: {
                    required: "Please enter a email or username.",
                    email: "Your email address must be in the format of name@domain.com"
                },
                ingPassword: {
                    required: "Please enter a password."
                }

            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

        $("#form_forgot_password_firs_step").validate({
            debug: true,
            rules: {
                forgot_password_email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                forgot_password_email: {
                    required: "We need your email address to contact you",
                    email: "Your email address must be in the format of name@domain.com"
                }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

        $("#form_forgot_password_second_step").validate({
            rules: {
                forgot_password_code: {
                    required: true,
                    digits: true,
                    minlength: 6,
                    maxlength: 6
                }
            },
            messages: {
                forgot_password_code: {
                    required: "Please enter a Code",
                    minlength: "Your code must be at least 6 characters long"
                }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

        $("#form_forgot_password_third_step").validate({
            rules: {
                forgot_password_password: {
                    required: true,
                    minlength: 8
                },
                forgot_password_confirm: {
                    required: true,
                    minlength: 8,
                    equalTo: "#forgot_password_password"
                }
            },
            messages: {
                forgot_password_code: {
                    required: "Please enter a Password",
                    minlength: "Your password must be at least 8 characters long"
                },
                forgot_password_code: {
                    required: "Please enter a Password",
                    minlength: "Your password must be at least 8 characters long",
                    equalTo: "Please enter the same password as above"
                }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
        
        if (codeClient !== undefined){
            preloader('show');
            $.post("../model/login_model.php", {'method':"activateClient", 'code_client':codeClient}, function(response) {
                if (response.code == 200) {
                    var data = response.data;
                    $("#ingUsuario").val(data[0].email)
                    preloader('hide', 'your email was successfully validated ', 'success');
                }
                if (response.code == 204) {
                    preloader('hide', response.message, 'error');
                }
            }, 'json');
        }

    },
    events: function() {

        $("#m_login_signin_submit").click(function(e) {
            var validation = Array.prototype.filter.call(formlogin, function(form) {
                if (formlogin.valid()) {
                    preloader('show');
                    var dt = {
                        method: "login",
                        ingUsuario: $("#ingUsuario").val(),
                        ingPassword: $("#ingPassword").val()
                    }
                     $.post("../model/login_model.php", {
                            "method": 'login',
                            "ingUsuario": $('#ingUsuario').val(),
                            "ingPassword": $('#ingPassword').val()
                        },
                        function(response) {
                            if (response.code == 440) {
                                loginTimeout(response.message);
                                return;
                            }
                            if (response.code == 200) {
                                var data = response.data;
                                preloader('hide');
                                setTimeout(() => {
                                    window.location.href = '../view/index.php';
                                }, 1000);

                            }
                            if (response.code == 204) {
                                preloader('hide', response.message, 'error');
                                $("#ingUsuario").val("");
                                $("#ingPassword").val("");
                            }
                        },
                        "json"
                    );
                }
                form.classList.add('was-validated');
            });
        });

        $("#forgot_password_submit").click(function(e) {
            var step = sessionStorage.getItem('forgotPasswordStep');
            if (step == 1){
                if ($("#form_forgot_password_firs_step").valid()) {
                    preloader('show');
                    $.post('../model/login_model.php', {
                            method: "forgotPasswordFirsStep",
                            email: $("#forgot_password_email").val()
                        },
                        function(data) {
                            if (data.code == 440) {
                                loginTimeout(data.message);
                                return;
                            }
                            if (data.code == 204) {
                                preloader('hide', data.message, 'error');
                                $("#forgot_password_email").val("");
                            }
                            if (data.code == 200) {
                                preloader('hide', data.message, 'success');
                                sessionStorage.setItem('forgotPasswordStep', '2');
                                $('#form_forgot_password_firs_step').hide();
                                $('#form_forgot_password_second_step').show();
                                $("#forgot_password_submit").text("validate Code");
                            }
                        },
                        "json"
                    );
                }

            } else if(step == 2) {
                if ($("#form_forgot_password_second_step").valid()) {
                    preloader('show');
                    $.post('../model/login_model.php', {
                            method: "forgotPasswordSecondStep",
                            email: $("#forgot_password_email").val(),
                            code: $("#forgot_password_code").val()
                        },
                        function(data) {
                            if (data.code == 440) {
                                loginTimeout(data.message);
                                return;
                            }
                            if (data.code == 204) {
                                preloader('hide', data.message, 'error');
                                $("#forgot_password_code").val("");
                            }
                            if (data.code == 200) {
                                preloader('hide', data.message, 'success');
                                sessionStorage.setItem('forgotPasswordStep', '3');
                                $('#form_forgot_password_second_step').hide();
                                $('#form_forgot_password_third_step').show();
                                $("#forgot_password_submit").text("Change Password");
                            }
                        },
                        "json"
                    );
                }

            } else if(step == 3) {
                if ($("#form_forgot_password_third_step").valid()) {
                    preloader('show');
                    $.post('../model/login_model.php', {
                            method: "forgotPasswordThirdStep",
                            email: $("#forgot_password_email").val(),
                            new_password: $("#forgot_password_password").val()
                        },
                        function(data) {
                            if (data.code == 440) {
                                loginTimeout(data.message);
                                return;
                            }
                            if (data.code == 204) {
                                preloader('hide', data.message, 'error');
                                $("#forgot_password_password").val("");
                                $("#forgot_password_confirm").val("");
                            }
                            if (data.code == 200) {
                                preloader('hide');
                                preloader('hide', data.message, 'success');
                                setTimeout(() => {
                                    window.location.href = '../view/login.php';
                                }, 1000);
                            }
                        },
                        "json"
                    );
                }
            }
        });

    }

};

//////////////////////////////
function validar() {
    var ok = true;
    var msj = "must indicate: ";
    if ($("#ingUsuario").val() == "") {
        ok = false;
        msj += "Username or Email ";

    }
    if ($("#ingPassword").val() == "") {
        ok = false;
        msj += "Password ";

    }

    if (ok == false) {
        swal(msj)
    }
    return ok;
}
