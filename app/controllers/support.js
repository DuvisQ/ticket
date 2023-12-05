 "use strict";
var MODELO = '../model/support_model.php';
var dataTable = '';

function loadData() {
    $("#listaSupports").html("");
    let dt = {
        method:"loadListSupports"
    }
    preloader('show');
    $.post(MODELO, dt,
        function (data, textStatus, jqXHR) {            
            let list = '';                      
            data.dataList.forEach(element => {                
                let leg = '';                               
                if (element[4] == "1") {
                    leg = '<span class="badge bg-info text-dark">Request</span>';
                }
                if (element[4] == "2") {
                    leg = '<span class="badge bg-success">Working</span>';
                }
                if (element[4] == "3") {
                    leg = '<span class="badge bg-danger">Finalized</span>';
                }
                list += `
                <div class="card" style="width: 18rem;">
                    <div class="card-header">
                       Code: ${element[1]}
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><b>${element[2]}</b></h5>
                        <p class="card-text">${element[3]}</p>
                    </div>
                    <div class="card-footer text-muted">
                        ${element[5]}<br/>
                        ${leg}<br/>
                        <a href="#" onclick="Support.edit(${element[0]})" class="card-link">Edit</a>
                    </div>
                </div>
                `;
            });
            
            $("#listaSupports").html(list);
            preloader('hide');
        },
        "json"
    );
}

function loadBranch() {
    preloader('show');
    $("#select_branch_support").html("")
    $.post(MODELO, {method:"loadListBranch"},
        function (data, textStatus, jqXHR) {
            preloader('hide');
            let {  dataList } = data;
            let list = '';
            dataList.forEach(element => {
                list += `<option value="${element[0]}">${element[1]}</option>`;
            });
            $("#select_branch_support").html(list);
        },
        "json"
    );
}

var Support = {
    init: function() {
        loadData();
        loadBranch();

        $("#formSupport").validate({
            debug: false,
            rules: {
                select_branch_support:{
                    required:true
                },
                add_title_support: {
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
    events: function() {    	 
        $("#btnNewSupport").click(function (e) { 
            e.preventDefault();
            Support.clean();
            $("#modalAddSupport").modal("show");
        });

        $("#btnSaveNewSupport").click(function (e) { 
            e.preventDefault();
            if ($("#formSupport").valid()) {
                let dt = {
                    method:"saveSupport",
                    id:$("#add_id_support").val(),
                    branch_id:$("#select_branch_support").val(),
                    title:$("#add_title_support").val(),
                    descrip:$("#add_description_client").val()
                };
                $.post(MODELO, dt,
                    function (response, textStatus, jqXHR) {
                        if (response.code == 440) {
                            loginTimeout(response.message);
                            return;
                        } else if (response.code == 200) {
                            preloader('hide', response.message, 'success');
                            $('#modalAddSupport').modal('hide');
                            loadData();
                        } else if (response.code == 204) {
                            preloader('hide', response.message, 'error');
                        }
                    },
                    "json"
                );
            }
        });
    },     
    clean: function(){
        $("#add_id_support").val(0);
        $("#add_title_support").val("");
        $("#add_description_client").val("");

        $("label.error").hide();
        $(".is-invalid").removeClass("is-invalid");
    },
    edit:function (id) {
        let dt = {
            method:"edit",
            id
        }
        $.post(MODELO, dt,
            function (data, textStatus, jqXHR) {
                let { dataList } = data;
                $("#add_id_support").val(id);
                $("#select_branch_support").val(dataList.branch_id);
                $("#add_title_support").val(dataList.title);
                $("#add_description_client").val(dataList.descrip);

                $("#modalAddSupport").modal("show");
            },
            "json"
        );
    }
};


$(function() {
    Support.init();	 
    Support.events();
});

