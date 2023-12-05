 "use strict";
var MODELO = '../model/support_model.php';
var dataTable = '';

function loadagent() {
    preloader('show');
    $("#select_add_agent").html("")
    $.post(MODELO, {method:"loadagent"},
        function (data, textStatus, jqXHR) {
            preloader('hide');
            let {  dataList } = data;
            let list = '';
            dataList.forEach(element => {
                list += `<option value="${element[0]}">${element[1]}</option>`;
            });
            $("#select_add_agent").html(list);
        },
        "json"
    );
}

var Support = {
    init: function() {         
        loadagent();
    },
    events: function() {
 
        $("#btnSaveNewAssigner").click(function (e) { 
            e.preventDefault();
            let dt = {
                method:"saveAssigner",
                id:$("#add_id_support").val(),
                agent_id:$("#select_add_agent").val(),
                title_support:$("#add_title_support").val()
            };
            preloader('show');
            $.post(MODELO, dt,
                function (response, textStatus, jqXHR) {
                    if (response.code == 440) {
                        loginTimeout(response.message);
                        return;
                    } else if (response.code == 200) {
                        preloader('hide', response.message, 'success');
                        $('#modalAssignerSupport').modal('hide');
                        dataTable.ajax.reload();
                    } else if (response.code == 204) {
                        preloader('hide', response.message, 'error');
                    }
                },
                "json"
            );
        });

          // Validar y Previsualizar la imagen
        $("#file-1").change(function(event) { //validar que sea imagen
            console.log('imagen change');
            var fileInput = document.getElementById('file-1');
            var imagen = this.files[0];
            var filePath = fileInput.value;
            var allowedExtensions = /(.jpg|.jpeg|.png|.gif)$/i;
            if (!allowedExtensions.exec(filePath)) {
                Swal.fire("Ups..", 'Please upload file having extensions .jpeg/.jpg/.png/.gif Only.', "warning");
                $("#imagen").val('');
            }
            var datosImagen = new FileReader();
            datosImagen.readAsDataURL(imagen);
            $(datosImagen).on("load", function(event) {
                var rutaImagen = event.target.result;
                $(".previsualizar").attr("src", rutaImagen);
            });
        });

        ////////////////////////////////////////////////////////////////////////
        $('#btnSendReply').click(function(e) {
            e.preventDefault();
            // var storageRef = firebase.storage().ref();
            // var file = document.getElementById("file-1").files;
            var id_client = document.getElementById('id_client')+ '/';
            var statusResponse = $("input[name='status_response']:checked").val();

            preloader('show');
            // if (file.length != 0) { //si tiene foto cargada
            //     var uploadTask = storageRef.child('supportTickets/' + id_client + file[0].name).put(file[0]);
            //     uploadTask.on('state_changed', function(snapshot) {
            //         var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
            //         console.log('Upload is ' + progress + '% done');
            //         switch (snapshot.state) {
            //             case firebase.storage.TaskState.PAUSED: // or 'paused'
            //                 console.log('Upload is paused');
            //                 break;
            //             case firebase.storage.TaskState.RUNNING: // or 'running'
            //                 console.log('Upload is running');
            //                 break;
            //         }
            //     },
            //     function(error) {
            //         // Handle unsuccessful uploads
            //     }, function() {

            //         uploadTask.snapshot.ref.getDownloadURL().then(function(downloadURL) {
            //             var parametros = {
            //                  method: 'sendReplyDetailsSupport',
            //                 id_support: $('#id_support').val(),
            //                 detail: $('#add_reply_support').val(),
            //                 path_image: 'supportTickets/' + id_client + file[0].name,
            //                 url_image: downloadURL,
            //                 type_details: 2,
            //                 type_user: 2,
            //                 status_response: statusResponse
            //             };
            //             $.post(MODELO, parametros, function(response) {
            //                 if (response.code == null) {
            //                     preloader('hide', 'warning', 'warning');
            //                     return;
            //                 }
            //                 if (response.code == 440) {
            //                     loginTimeout(response.message);
            //                     return;
            //                 }
            //                 if (response.code == 200) {
            //                     preloader('hide', response.message, 'success');
            //                      Support.findHistoryByIdSupport();
            //                 } else {
            //                     storageRef.child('supportTickets/' + id_client + file[0].name).delete();
            //                     preloader('hide', response.message, 'warning');
            //                 }
            //             }, 'json');
            //         });
            //     });
            // } //endif file
            //else { // si no tiene foto cargada

                var parametros = {
                    method: 'sendReplyDetailsSupport',
                    id_support: $('#id_support').val(),
                    detail: $('#add_reply_support').val(),
                    path_image: '',
                    url_image: '',
                    type_details: 2,
                    type_user: 1,
                    // status_response: statusResponse
                    status_response: 0
                };
                $.post(MODELO, parametros, function(response) {
                    if (response.code == null) {
                        preloader('hide', 'error', 'warning');
                        return;
                    }
                    if (response.code == 440) {
                        loginTimeout(response.message);
                        return;
                    }
                    if (response.code == 200) {                        
                        preloader('hide', response.message, 'success');
                        Support.clean();
                        Support.findHistoryByIdSupport();
                    } else {
                        preloader('hide', response.message, 'warning');
                    }
                }, 'json');

            // }

        });

        ///////////////////////////////////////////////////////////////////////
        $('#btnSendReplyFinalized').click(function(e) {
            e.preventDefault();
            // var storageRef = firebase.storage().ref();
            // var file = document.getElementById("file-1").files;
            var id_client = document.getElementById('id_client')+ '/';            

            preloader('show');
            //si tiene foto cargada
            /*if (file.length != 0) { 
                var uploadTask = storageRef.child('supportTickets/' + id_client + file[0].name).put(file[0]);
                uploadTask.on('state_changed', function(snapshot) {
                    var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                    console.log('Upload is ' + progress + '% done');
                    switch (snapshot.state) {
                        case firebase.storage.TaskState.PAUSED: // or 'paused'
                            console.log('Upload is paused');
                            break;
                        case firebase.storage.TaskState.RUNNING: // or 'running'
                            console.log('Upload is running');
                            break;
                    }
                },
                function(error) {
                    // Handle unsuccessful uploads
                }, function() {

                    uploadTask.snapshot.ref.getDownloadURL().then(function(downloadURL) {
                        var parametros = {
                            method: 'sendReplyFinalizedSupport',
                            id_support: $('#id_support').val(),
                            detail: $('#add_reply_support').val(),
                            path_image: 'supportTickets/' + id_client + file[0].name,
                            url_image: downloadURL,
                            type_details: 2,
                            type_user: 2
                        };
                        $.post(MODELO, parametros, function(response) {
                            if (response.code == null) {
                                preloader('hide', 'warning', 'warning');
                                return;
                            }
                            if (response.code == 440) {
                                loginTimeout(response.message);
                                return;
                            }
                            if (response.code == 200) {
                                preloader('hide', response.message, 'success');
                                Support.clean();
                                Support.findHistoryByIdSupport();
                            } else {
                                storageRef.child('supportTickets/' + id_client + file[0].name).delete();
                                preloader('hide', response.message, 'warning');
                            }
                        }, 'json');
                    });
                });
            } //endif file
            else { // si no tiene foto cargada*/

                var parametros = {
                    method: 'sendReplyFinalizedSupport',
                    id_support: $('#id_support').val(),
                    detail: $('#add_reply_support').val(),
                    path_image: '',
                    url_image: '',
                    type_details: 3,
                    type_user: 1
                };
                $.post(MODELO, parametros, function(response) {
                    if (response.code == null) {
                        preloader('hide', 'error', 'warning');
                        return;
                    }
                    if (response.code == 440) {
                        loginTimeout(response.message);
                        return;
                    }
                    if (response.code == 200) {
                        preloader('hide', response.message, 'success');
                        Support.clean();
                        Support.finalized();
                        Support.findHistoryByIdSupport();
                    } else {
                        preloader('hide', response.message, 'warning');
                    }
                }, 'json');

            // }
        });

        ///////////////////////////////////////////////////////////////////////
        $('.inputfile').each( function(){
            var $input   = $( this ),
                $label   = $input.next( 'label' ),
                labelVal = $label.html();

            $input.on( 'change', function( e )
            {
                var fileName = '';

                if( this.files && this.files.length > 1 )
                    fileName = ( this.getAttribute('data-multiple-caption') || '' ).replace('{count}', this.files.length );
                else if( e.target.value )
                    fileName = e.target.value.split( '\\' ).pop();

                if( fileName )
                    $label.find('span').html( fileName );
                else
                    $label.html( labelVal );
            });

            // Firefox bug fix
            $input
            .on( 'focus', function(){ $input.addClass('has-focus'); })
            .on( 'blur', function(){ $input.removeClass('has-focus'); });
        });

        $('#tableSupports tbody').on('click', '.btn_assiger_support', function () {
            var $tr = $(this).closest('tr');
            var data = dataTable.row($(this).parents($tr)).data();
            console.log(data[0])
            $("#add_id_support").val(data[0]);
            $("#add_title_support").val(data[6]);
            $("#modalAssignerSupport").modal("show");
        });
        
    },
    table:function () {
        dataTable = $('#tableSupports').DataTable({
            processing: true,
            responsive: true,
            serverMethod: 'post',
            ajax: {
                url:MODELO,
                data: {
                    method: "listSupportsBack"
                },
                error: function() {}
            },            
            "order": [[0, "desc"]],
            drawCallback: function(response) {
                
            }
        });
    },
    detailSupportByIdBack: function(id){        
        var parametros = {
            "method": "detailSupportByIdBack",
            "id": id
        };
        //preloader('show');
        $.post(MODELO, parametros, function(data) {
            if (data.code == 440) {
                loginTimeout(data.message);
                return;
            }
            if (data.code == 200) {
                console.log(data)
                 
                preloader('hide');
            } else {
                preloader('hide','Error');
            }
        },'json');
    },
    findByIdSupportBack: function(id) {
        var parametros = {
            "method": "findByIdSupportBack",
            "id": id
        };
        //preloader('show');
        $.post(MODELO, parametros, function(data) {
            if (data.code == 440) {
                loginTimeout(data.message);
                return;
            }
            if (data.code == 200) {
                console.log(data)
                 
                preloader('hide');
            } else {
                preloader('hide','Error');
            }
        },'json');        
    },
    assignerSupport:function (id) {
        $("#add_id_support").val(id);
        $("#modalAssignerSupport").modal("show");
    },
    closeSupport:function (id) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then(result => {
            if (result.value) {
                preloader('show');
                var parametros = {
                    "method": "closeSupport",
                    "id": id,
                };
                $.post(MODELO, parametros, function(data) {
		            if (data.code == '440') {
		                loginTimeout(data.message);
		                return;
		            } else if (data.code == 200) {
		                preloader('hide', data.message, 'success');
		                dataTable.ajax.reload();
		            }
		        }, 'json');
            }
        });
    },
    seeSupport:function (id) {
        var parametros = {
            "method": "seeSupport",
            "id": id,
        };
        $.post(MODELO, parametros, function(data) {
            // console.log(data)
            if (data.code == '440') {
                loginTimeout(data.message);
                return;
            } else if (data.code == 200) {
                $('#view_branch').val(data.dataList.branch);
                $('#view_title').val(data.dataList.title);
                $('#view_description').val(data.dataList.descrip);
                $("#modalDetailSupport").modal("show");
            }
        }, 'json');
    },
    detailSupportById: function(id){
        var settingLang = localStorage.getItem('settingLang');
        var title = settingLang == 'en' ? 'View Support' : 'Ver Soporte';
        $("#titleModalSupport").text(title);
        var parametros = {
            "method": "findSupportById",
            "id": id
        };
        preloader('show');
        $.post(MODELO, parametros, function(data) {
            if (data.code == 440) {
                loginTimeout(data.message);
                return;
            }
            if (data.code == 200) {
                $('#id_support').val(data.id)
                $('#numberTicket').html(data.id);
                $('#codeTicket').html(data.code_ticket);
                 console.log(data)
                let fullName = data.name_client.split(' ');
                let initials = '';
                if (fullName.length > 1) {
                    initials = fullName.shift().charAt(0) + fullName.pop().charAt(0);  
                }else{
                    initials = fullName.shift().charAt(0)
                }                           
                document.getElementById('profileImage').innerHTML = initials.toUpperCase();
                $('#nameClient').html(data.name_client.toUpperCase());
                $('#add_status_support').val(data.status);
                if (data.status == 4) {
                    Support.clean();
                    Support.finalized();
                }else{
                    $('#add_reply_support').prop('disabled', false );
                    $('#file-1').prop('disabled', false );
                    $('#btnSendReply').prop('disabled', false );
                    $('#dropdown-Finalized').prop('disabled', false );
                }

                Support.findHistoryByIdSupport();
                $("#modalDetailSupport").modal("show");
                preloader('hide');
            } else {
                preloader('hide','Error');
            }
        },'json');
    },
    findHistoryByIdSupport: function() {
        var $supportDetail = $('#support_div_history');
        $.post(MODELO, {
                "method": 'findHistoryByIdSupport',
                "id_support": $('#id_support').val()
            },
            function(response) {

                $supportDetail.html('');
                if (response.code == 200) {
                    // console.log(response)
                    $.each(response.data, function(cant_reg, detalle) { //se recorre el json.
                            // console.log(detalle)
                            let $response = '',$div = '', $icon = '', $class = '', $type_user = '';
 
                            switch (parseInt(detalle.type_details)) {
                                case 1:
                                    $response = 'Created';
                                    $icon = 'envelope';
                                    $class = 'success';
                                    break;
                                case 2:
                                    $type_user = parseInt(detalle.type_user);
                                    if ($type_user == 1) {
                                        $response = 'Request';
                                        $icon = 'user';
                                        $class = 'primary';
                                    }
                                    if ($type_user == 2) {
                                        $response = 'Response';
                                        $icon = 'user';
                                        $class = 'danger';
                                    }
                                    
                                    break;
                                case 3:
                                    $response = 'Finalized';
                                    $icon = 'calendar-check';
                                    $class = 'purple';
                                    break;
                            }
                            let date_create= new Date(detalle.created);

                            let $dateCreate = moment(date_create).format('YYYY-MM-DD  h:mm:ss');
                            $div = `
                                    <div>
                                        <i class="fas fa-${ $icon } bg-${ $class }"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="fas fa-clock"></i> ${ $dateCreate }</span>
                                            <h3 class="timeline-header"><a href="#">${ $response }</a></h3>
                                            <div class="timeline-body">
                                                ${detalle.detail}
                                                <br>
                                                <img src="${detalle.url_image}" alt="..." width="150px" height="100">
                                            </div>
                                            
                                        </div>
                                    </div>
                                    `;

                            $supportDetail.append($div);

                    }); //Fin $.each

                }
                }, "json")
            .fail(
                function(error) {
                    preloader('hide', 'FAIL', 'error');
                    console.log(error.responseJSON);
                }
            );
    },
    clean: function(){
        $('#add_reply_support').val('');
        $("#option1").prop("checked", true);
        $('#file-1').val('');
    },
    finalized: function(){
        $('#add_reply_support').prop('disabled', true);
        $('#file-1').prop('disabled', true);
        $('#btnSendReply').prop('disabled', true);
        $('#dropdown-Finalized').prop('disabled', true);
    }
};


$(function() {
    Support.init();
    Support.table();
    Support.events();
});

