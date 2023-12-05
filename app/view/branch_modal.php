<div class="modal fade" id="modalAddBranch">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Branch</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" id="formBranch" class="needs-validation" novalidate>
                    <input type="hidden" id="add_id_branch">
                    <div class="form-group">
                        <label for="add_name_branch">Name</label>
                        <input type="text" class="form-control" name="add_name_branch" id="add_name_branch">
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="add_phone_branch">Phone</label>
                                <input type="text" class="form-control" name="add_phone_branch" id="add_phone_branch">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="add_address_branch">Address</label>
                                <input type="text" class="form-control" name="add_address_branch" id="add_address_branch">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="add_state_branch">State</label>
                                <input type="text" class="form-control" name="add_state_branch" id="add_state_branch">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="add_email_branch">Email</label>
                                <input type="text" class="form-control" name="add_email_branch" id="add_email_branch">
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSaveNewBranch">Save changes</button>
            </div>
        </div>
    </div>
</div>