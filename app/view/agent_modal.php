<div class="modal fade" id="modalAddUser">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Agent</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" id="formUser" class="needs-validation" novalidate>
                    <input type="hidden" id="add_id_user">                   
                    <div class="form-group">
                        <label for="add_name_user">Name</label>
                        <input type="text" class="form-control" name="add_name_user" id="add_name_user">
                    </div>
                    <div class="form-group">
                        <label for="add_username">UserName</label>
                        <input type="text" class="form-control" name="add_username" id="add_username">
                    </div>
                    <!--div class="form-group">
                        <label for="add_role">Role</label>
                        <select name="add_role" id="add_role" class="form-control">
                            <option value="1">Agent</option>
                            <option value="2">User</option>
                        </select>
                    </div-->
                    <div class="form-group">
                        <label for="add_password_user">Password</label>
                        <div class="input-group" id="input-group-pass">
                            <input type="password" class="form-control" name="add_password_user" id="add_password_user">
                            <div class="input-group-append">
                                <button type="button" class="btn-transition btn btn-outline-focus" id="seePass"><i class="fa fa-eye"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="add_confirm_password_user">Confirm Password</label>
                        <input type="password" class="form-control" name="add_confirm_password_user" id="add_confirm_password_user">
                    </div>
                    <div class="form-group">
                        <label for="add_email_user">Email</label>
                        <input type="text" class="form-control" name="add_email_user" id="add_email_user">
                    </div>
                    <div class="form-group">
                        <label for="add_phone_user">Phone</label>
                        <input type="text" class="form-control" name="add_phone_user" id="add_phone_user">
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSaveNewUser">Save changes</button>
            </div>
        </div>
    </div>
</div>