<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Agent</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Agent</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">List of Agent</h3>
                    <button type="button" class="btn btn-default float-right" id="btnModalAddUser">
                        <i class="fas fa-plus"></i> Add New Agent
                    </button>   
                </div>
                <div class="card-body">
                    <table style="width: 100%;" id="tableUsers" class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Active</th>
                                <th>Admin</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="listaUsers"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="../controllers/agent.js"></script>