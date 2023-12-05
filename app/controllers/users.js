 "use strict";
var MODELO = '../model/user_model.php';
var dataTable = '';
var formUser = $('#formUser');

function loadClient() {
    preloader('show');
    $("#select_client").html("")
    $.post(MODELO, {method:"loadClient"},
        function (data, textStatus, jqXHR) {
            preloader('hide');
            let {  dataList } = data;
            let list = '<option value="0">Select...</option>';
            dataList.forEach(element => {
                list += `<option value="${element[0]}">${element[1]}</option>`;
            });
            $("#select_client").html(list);
        },
        "json"
    );
}

function loadBranch(client_id) {
    preloader('show');
    $("#select_branch").html("")
    $.post(MODELO, {method:"loadBranch",client_id},
        function (data, textStatus, jqXHR) {
            preloader('hide');
            let {  dataList } = data;
            let list = '';
            dataList.forEach(element => {
                list += `<option value="${element[0]}">${element[1]}</option>`;
            });
            $("#select_branch").html(list);
        },
        "json"
    );
}

loadClient();

var User = {
    init: function() {

        $.validator.setDefaults({
            submitHandler: function () {
              alert( "Form successful submitted!" );
            }
        });

        $("#formUser").validate({
            debug: false,
            rules: {
                select_branch:{
                    required:true
                },
                add_email_user: {
                    required: true,
                    email: true
                },
                add_password_user: {
                    required: true,
                    minlength: 8,
                },
                add_confirm_password_user: {
                    required: true,
                    minlength: 8,
                    equalTo: "#add_password_user"
                },
                add_name_user:{
                    required:true
                },
                add_username:{
                    required:true
                },
                add_phone_user:{
                    required:true
                }
            },
            messages: {
                add_email_user: {
                    required: "We need your email address to contact you",
                    email: "Your email address must be in the format of name@domain.com"
                },
                add_confirm_password_user: {
                    equalTo: "Passwords do not match"
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
        

    },
    events: function() {

        $("#select_client").change(function (e) { 
            e.preventDefault();
            let select_client = $("#select_client").val();
            if (select_client != 0) {
                User.table(select_client);
                loadBranch(select_client);
            }else{
                $("#listaUsers").html("");
            }
        });

        $('#btnModalAddUser').click(function(e) {
            e.preventDefault();
            let select_client = $("#select_client").val();
            if (select_client == 0) {
                preloader('hide', 'Debe Indicar Cliente...!', 'error');
            }else{
                User.clean();
                $('#modalAddUser').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            }          
           
        });  

        $('#btnSaveNewUser').click(function() {
            if ($("#formUser").valid()) {                
                let dt = {
                    "method": 'saveUser',
                    "id": $('#add_id_user').val(),
                    "client_id":$("#select_client").val(),
                    "branch_id":$("#select_branch").val(),
                    "name":$("#add_name_user").val(),
                    "username":$("#add_username").val(),
                    "email": $('#add_email_user').val(),                    
                    "password": $('#add_password_user').val(),
                    "phone":$("#add_phone_user").val()
                };
                preloader('show');
                $.post(MODELO, dt,function(response) {
                        if (response.code == 440) {
                            loginTimeout(response.message);
                            return;
                        } else if (response.code == 200) {
                            preloader('hide', response.message, 'success');
                            $('#modalAddUser').modal('hide');
                            dataTable.ajax.reload();
                        } else if (response.code == 204) {
                            preloader('hide', response.message, 'error');
                        }
                }, "json");                             
            }
        });        

        $("#seePass").hover(function() {
            console.log("#seePass");
            var x = document.getElementById("add_password_user");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        });
    },
    table:function (id) {
        $('#tableUsers').DataTable().clear().destroy();
        dataTable = $('#tableUsers').DataTable({
            processing: true,
            responsive: true,
            serverMethod: 'post',
            ajax: {
                url:MODELO,
                data: {
                    method: "listUsers",
                    client_id: id
                },
                error: function() {}
            },             
            "order": [[0, "desc"]],
            drawCallback: function(response) {
                
            }
        });  
    },
    status: function(id, ) {
        var parametros = {
            "method": "changeStatus",
            "id": id             
        }
        preloader('show');
        $.post(MODELO, parametros, function(data) {
            if (data.code == '440') {
                loginTimeout(data.message);
                return;
            } else if (data.code == 200) {
                preloader('hide', data.message, 'success');
                //dataTable.ajax.reload();
            }
        }, 'json');
    },
    admin: function(id, ) {
        var parametros = {
            "method": "isAdmin",
            "id": id             
        }
        preloader('show');
        $.post(MODELO, parametros, function(data) {
            if (data.code == '440') {
                loginTimeout(data.message);
                return;
            } else if (data.code == 200) {
                preloader('hide', data.message, 'success');
                //dataTable.ajax.reload();
            }
        }, 'json');
    },
    deleteUser: function(id, status) {
        var parametros = {
            "method": "deleteUser",
            "id": id
        }
        preloader('show');
        $.post(MODELO, parametros, function(data) {
            if (data.code == '440') {
                loginTimeout(data.message);
                return;
            } else if (data.code == 200) {
                preloader('hide', data.message, 'success');
                dataTable.ajax.reload();
            }
        }, 'json');
    },      
    clean: function(){
        $('#add_id_user').val(0);
        $('#add_email_user').val('');
        $('#add_password_user').val('');
        $('#add_confirm_password_user').val('');
        $('#add_name_user').val('');
        $('#add_username').val('');
        $('#add_phone_user').val('');

        $("label.error").hide();
        $(".is-invalid").removeClass("is-invalid");
    },
    edit:function (id) {
        var parametros = {
            "method": "edit",
            "id": id
        };
       // preloader('show');
        $.post(MODELO, parametros, function(data) {            
            if (data.code == 440) {
                loginTimeout(data.message);
                return;
            }
            if (data.code == 200) {
                let  { dataList } = data
                $('#add_id_user').val(id);
                $('#select_branch').val(dataList.branch_id);
                $('#add_name_user').val(dataList.full_name);
                $('#add_username').val(dataList.username);
                $('#add_role').val(dataList.role);
                $('#add_password_user').val(dataList.pass);
                $('#add_confirm_password_user').val(dataList.pass);
                $('#add_email_user').val(dataList.email);
                $('#add_phone_user').val(dataList.movil_phone);
   
                $('#modalAddUser').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                preloader('hide');
            } else {
                preloader('hide','Error');
            }            
        },'json');
    }
};
 
$(function() {
    User.init();     
    User.events();
});