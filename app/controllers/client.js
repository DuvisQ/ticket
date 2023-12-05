 "use strict";
var MODELO = '../model/client_model.php';
var dataTable = '';
var formClient = $('#formClient');

var Client = {
    init: function() {

        $.validator.setDefaults({
            submitHandler: function () {
              alert( "Form successful submitted!" );
            }
        });   

        $("#formClient").validate({
            debug: false,
            rules: {
                add_name_client: {
                    required: true                   
                },
                add_description_client: {
                    required: true
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
    table:function () {        
        dataTable = $('#tableClients').DataTable({
            processing: true,
            responsive: true,
            serverMethod: 'post',
            ajax: {
                url:MODELO,
                data: {
                    method: "listClients"
                },
                error: function() {}
            },             
            "order": [[0, "desc"]],
            drawCallback: function(response) {
                
            }
        });
    },
    events: function() {
        $('#btnModalAddClient').click(function(e) {
            e.preventDefault();
            Client.clean();
            $('#modalAddClient').modal({
                backdrop: 'static',
                keyboard: false
            });
        });  

        $('#btnSaveNewClient').click(function() {
            if ($("#formClient").valid()) {
                preloader('show');
                let dt = {
                    "method": 'saveClient',
                    "id": $('#add_id_client').val(),
                    "name": $('#add_name_client').val(),
                    "descip": $('#add_description_client').val()                    
                };                
                $.post(MODELO, dt,function(response) {
                        if (response.code == 440) {
                            loginTimeout(response.message);
                            return;
                        } else if (response.code == 200) {
                            preloader('hide', response.message, 'success');
                            $('#modalAddClient').modal('hide');
                            dataTable.ajax.reload();
                        } else if (response.code == 204) {
                            preloader('hide', response.message, 'error');
                        }
                }, "json");
            }
        });        
         
    },        
    clean: function(){
        
        $('#add_id_client').val(0);
        $('#add_name_client').val('');
        $('#add_description_client').val('');       

        
        $("label.error").hide();
        $(".is-invalid").removeClass("is-invalid");
    }, 
    st:function (id) {
        var parametros = {
            "method": "changeStatus",
            "id": id             
        }
        //preloader('show');
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
    edit:function (id) {
        var parametros = {
            "method": "findClientById",
            "id": id             
        }
        //preloader('show');
        $.post(MODELO, parametros, function(data) {
            if (data.code == '440') {
                loginTimeout(data.message);
                return;
            } else if (data.code == 200) {
               let  { dataList } = data
               $('#add_id_client').val(id);
               $('#add_name_client').val(dataList.full_name);
               $('#add_description_client').val(dataList.descrip);
               
               $('#modalAddClient').modal({
                backdrop: 'static',
                keyboard: false
                });
            }
        }, 'json');
    }
};


$(function() {
    Client.init();
    Client.table();
    Client.events();
});
