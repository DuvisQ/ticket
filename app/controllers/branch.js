 "use strict";
var MODELO = '../model/branch_model.php';
var dataTable = '';
var formBranch = $('#formBranch');

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

loadClient();
var Branch = {
    init: function() {

        $.validator.setDefaults({
            submitHandler: function () {
              alert( "Form successful submitted!" );
            }
        });   
        $("#formBranch").validate({
            debug: false,
            rules: {
                add_name_branch: {
                    required: true,
                },
                add_phone_branch: {
                    required: true                    
                },
                add_address_branch: {
                    required: true
                },
                add_state_branch: {
                    required: true
                },
                add_email_branch: {
                    required: true,
                    email:true
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
       
        // Summernote
        $('#add_description_plan').summernote();

     

    },
    table:function (id) {

        $('#tableBranch').DataTable().clear().destroy();
        dataTable = $('#tableBranch').DataTable({
            processing: true,
            responsive: true,
            serverMethod: 'post',
            ajax: {
                url:MODELO,
                data: {
                    method: "listbranch",
                    client_id:id
                },
                error: function() {}
            },            
            "order": [[0, "desc"]],
            drawCallback: function(response) {
                
            }
        });
    },
    events: function() {

        $("#select_client").change(function (e) { 
            e.preventDefault();
            let select_client = $("#select_client").val();
            if (select_client != 0) {
                Branch.table(select_client);
            }else{
                $("#listaBranch").html("");
            }
        });

        $('#btnModalAddBranch').click(function(e) {
            e.preventDefault();
            Branch.clean();
            let select_client = $("#select_client").val();
            if (select_client == 0) {
                preloader('hide', 'Debe Indicar Cliente...!', 'error');
            }else{
                $('#modalAddBranch').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            }           
        });  

        $('#btnSaveNewBranch').click(function() {
            if ($("#formBranch").valid()) {               
                //preloader('show');
                let dt = {
                    "method": 'saveBranch',
                    "id_branch": $('#add_id_branch').val(),
                    "client_id":$("#select_client").val(),
                    "name": $('#add_name_branch').val(),
                    "phone": $('#add_phone_branch').val(),
                    "address": $('#add_address_branch').val(),
                    "state": $('#add_state_branch').val(),
                    "email": $('#add_email_branch').val(),                   
                };               
                $.post(MODELO, dt,function(response) {
                        if (response.code == 440) {
                            loginTimeout(response.message);
                            return;
                        } else if (response.code == 200) {
                            preloader('hide', response.message, 'success');
                            $('#modalAddBranch').modal('hide');
                            dataTable.ajax.reload();
                        } else if (response.code == 204) {
                            preloader('hide', response.message, 'error');
                        }
                }, "json")
            }
        });

    },
    findPlanById: function(id){         
        var parametros = {
            "method": "findBranchById",
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
                $('#add_id_branch').val(id);
                $('#add_name_branch').val(dataList.full_name);
                $('#add_phone_branch').val(dataList.phone);
                $('#add_address_branch').val(dataList.address);
                $('#add_state_branch').val(dataList.state);
                $('#add_email_branch').val(dataList.email);
   
                $('#modalAddBranch').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                preloader('hide');
            } else {
                preloader('hide','Error');
            }            
        },'json');
    },
    status: function(id) {
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
    clean: function(){

        $('#add_id_branch').val(0);
        $('#add_name_branch').val('');      
        $('#add_description_plan').val('');
        $('#add_phone_branch').val('');
        $('#add_address_branch').val('');
        $('#add_state_branch').val('');
        $('#add_email_branch').val('');        

        $("label.error").hide();
        $(".is-invalid").removeClass("is-invalid");      
    }
};


$(function() {
    Branch.init();
    Branch.events();
});
 
