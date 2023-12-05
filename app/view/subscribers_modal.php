<div class="modal fade" id="modalAddSubscriber">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Subscriber</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" id="formSubscriber" class="needs-validation" novalidate>
                    <input type="hidden" id="add_id_subscriber">
                    <div class="form-group">
                        <label for="add_name_subscriber">Name</label>
                        <input type="text" class="form-control" name="add_name_subscriber" id="add_name_subscriber">
                    </div>
                    <div class="form-group">
                        <label for="add_plan_subscriber">Select Plan</label>
                        <select name="add_plan_subscriber" id="add_plan_subscriber" class="form-control">
                            <option value="1">Free</option>
                            <option value="2">Premium</option>
                            <option value="3">Premium Pro</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="add_phone_subscriber">Movil Phone</label>
                        <input type="text" class="form-control" name="add_phone_subscriber" id="add_phone_subscriber">
                    </div>
                    <div class="form-group">
                        <label for="add_email_subscriber">Email</label>
                        <input type="text" class="form-control" name="add_email_subscriber" id="add_email_subscriber">
                    </div>
                    <div class="form-group">
                        <label for="add_password_subscriber">Password</label>        
                        <div class="input-group" id="input-group-pass">                            
                            <input type="password" class="form-control" name="add_password_subscriber" id="add_password_subscriber">
                            <div class="input-group-append">
                               <button type="button" class="btn-transition btn btn-outline-focus" id="seePass"><i class="fa fa-eye"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="add_confirm_password_subscriber">Confirm Password</label>
                        <input type="password" class="form-control" name="add_confirm_password_subscriber" id="add_confirm_password_subscriber">
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSaveNewSubscriber">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalViewUsers" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModalCampaignAutomation">Users</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">                                               
                <div class="card mb-3">
                    <div class="card-body">
                        <table  style="width: 100%;" id="dtUsersSubscriber" class="table table-hover table-striped table-bordered">
                            <thead>
                                <th class="text-center" width="10%">ID</th>
                                <th class="text-center lang" key="name">Name</th>
                                <th class="text-center lang" key="email">Email</th>
                                <th key="actions" width="10%">Actions</th>
                            </thead>
                        </table>
                    </div>
                </div>               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary lang" key="close" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalViewPayments" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModalCampaignAutomation">Payments</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">                                               
                <div class="card mb-3">
                    <div class="card-body">
                        <table  style="width: 100%;" id="dtPaymentsSubscriber" class="table table-hover table-striped table-bordered">
                            <thead>
                                <th class="text-center">Plan</th>
                                <th class="text-center lang" key="name">Start</th>
                                <th class="text-center lang" key="email">Expirated</th>
                            </thead>
                        </table>
                    </div>
                </div>               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary lang" key="close" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditSubscriber">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Subscriber</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" id="formSubscriberEdit" class="needs-validation" novalidate>
                    <input type="hidden" id="add_id_subscriber_edit">
                    <div class="form-group">
                        <label for="add_name_subscriber">Name</label>
                        <input type="text" class="form-control" name="add_name_subscriber_edit" id="add_name_subscriber_edit">
                    </div>
                    <div class="form-group">
                        <label for="add_plan_subscriber">Plans</label>
                        <select name="add_plan_subscriber_edit" id="add_plan_subscriber_edit" class="form-control">
                            <option value="1">Free</option>
                            <option value="2">Premium</option>
                            <option value="3">Premium Pro</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="add_plan_subscriber">Status</label>
                        <select name="add_status_subscriber" id="add_status_subscriber" class="form-control">
                            <option value="1">Activo</option>
                            <option value="2">Registrado</option>
                            <option value="3">Vencido</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSaveNewSubscriber">Save changes</button>
            </div>
        </div>
    </div>
</div>