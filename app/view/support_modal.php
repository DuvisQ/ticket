<div class="modal fade" id="modalAddSupport">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span id="titleModalCoupon">New Support</span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" id="formSupport" class="needs-validation" novalidate>
                    <input type="hidden" id="add_id_support">
                    <div class="form-group">
                        <label for="select_branch_support">Branch</label>
                        <select name="select_branch_support" class="form-control" id="select_branch_support"></select>
                    </div>
                    <div class="form-group">
                        <label for="add_title_support">Title</label>
                        <input type="text" class="form-control" name="add_title_support" id="add_title_support">
                    </div>
                    <div class="form-group">
                        <label for="add_description_client">Description</label>
                        <textarea id="add_description_client" class="form-control" name="add_description_client" id="" cols="30" rows="10"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSaveNewSupport">Save changes</button>
            </div>
        </div>
    </div>
</div>