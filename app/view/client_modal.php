<div class="modal fade" id="modalAddClient">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span id="titleModalCoupon">New Client</span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" id="formClient" class="needs-validation" novalidate>
                    <input type="hidden" id="add_id_client">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="add_name_client">Name</label>
                                <input type="text" class="form-control" name="add_name_client" id="add_name_client">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="add_description_client">Description</label>
                                <input type="text" class="form-control" name="add_description_client" id="add_description_client">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSaveNewClient">Save changes</button>
            </div>
        </div>
    </div>
</div>