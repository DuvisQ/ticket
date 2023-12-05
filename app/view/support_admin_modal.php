<div class="modal fade" id="modalAssignerSupport">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span id="titleModalCoupon">Assigner Support</span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" id="formClient" class="needs-validation" novalidate>
                    <input type="hidden" id="add_id_support">
                    <input type="hidden" id="add_title_support">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="select_add_agent">Agent</label>
                                <select name="select_add_agent" id="select_add_agent" class="form-control"></select>
                            </div>
                        </div>
                        <!--div class="col-6">
                            <div class="form-group">
                                <label for="add_description_client">Description</label>
                                <input type="text" class="form-control" name="add_description_client" id="add_description_client">
                            </div>
                        </div-->
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSaveNewAssigner">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!--------------------------------------------------------------------->
<div class="modal fade" id="modalDetailSupport">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Details Support</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" name="id_support" id="id_support">
                    <input type="hidden" name="id_client" id="id_client">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header" style="cursor: move;">
                            <h3 class="card-title">Tickets / <span id="numberTicket"></span> </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" id="prevTicket">
                                        <i class="fas fa-chevron-left"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" id="nextTicket">
                                        <i class="fas fa-chevron-right"></i>
                                    </button>

                                </div>
                            </div>
                            <div class="card-body">
                                <div class="inline">
                                    <div class="mx-auto" id="profileImage"></div>
                                    <div class="mx-auto mt-2">
                                        <p class="text-center" id="nameClient"></p>
                                    </div>
                                    <div class="mx-auto mt-2">
                                        <p class="text-center" id="emailClient"></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Estatus</label>
                                        <select name="add_status_support" id="add_status_support" class="custom custom-select" disabled="">
                                            <option value="1"><b>Request</b></option>
                                            <option value="2"><b>Working</b></option>
                                            <option value="3"><b>Finalized</b></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Code <b><span id="codeTicket"></span></b></h3>
                            </div>

                            <div class="card-body">
                                <div class="card card-primary card-outline card-outline-tabs">

                                    <div class="card-body">

                                       <div id="reply-editor" class="m-t-sm">
                                            <label class="lead">Add answer or comment</label>
                                            <textarea id="add_reply_support" name="add_reply_support" class=" form-control textarea"></textarea>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-7 mt-2">
                                                <!-- <div class='form-group '>
                                                   <input type="file" name="file-1" id="file-1" class="inputfile inputfile-1" data-multiple-caption="{count} files selected"/>
                                                    <label for="file-1"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Choose a file&hellip;</span></label>
                                                    <div class="position-relative form-group">
                                                       <img src="" id="imagen_url" class="img-thumbnail previsualizar" width="150px" alt="imagen default"> -->
                                                        <!-- <input type="hidden" class="form-control" id="add_path_image_tickets">
                                                    </div> -->

                                             </div> 
                                            <div class="col-md-5">
                                                <!-- <p class="mb-1">Does it merit a response from the user?</p>
                                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                  <label class="btn btn-secondary active">
                                                    <input type="radio" name="status_response" id="option1" autocomplete="off" checked="" value="0"> No
                                                  </label>
                                                  <label class="btn btn-secondary">
                                                    <input type="radio" name="status_response" id="option2" autocomplete="off" value="1"> Yes
                                                  </label>
                                                </div> -->
                                            </div>  
                                        </div>
                                        <div class="float-right mt-2">
                                                <button type="button" id="btnSendReply" class="btn btn-default">Send Reply</button>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown" id="dropdown-Finalized">
                                                      <span class="sr-only">Toggle Dropdown</span>
                                                      <div class="dropdown-menu" role="menu">
                                                        <a class="dropdown-item" href="javascript:;" id="btnSendReplyFinalized">Send Reply & Finalized</a>
                                                      </div>
                                                    </button>
                                                  </div>
                                            </div>
                                    </div>
                                    <!-- /.card -->
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- The time line -->
                                        <div id="demo" class="mx-auto overflow-auto ">
                                            <div class="timeline" id="support_div_history">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">

                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
