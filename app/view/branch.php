<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Branch</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Branch</li>
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
                    <h3 class="card-title">List of branch</h3>
                    <button type="button" class="btn btn-default float-right" id="btnModalAddBranch">
                        <i class="fas fa-plus"></i> Add New Branch
                    </button>
                    <br>
                    <br>
                    <select name="select_client" id="select_client" class="form-control"></select>
                </div>
                <div class="card-body">
                    <table style="width: 100%;" id="tableBranch" class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="listaBranch"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="../controllers/branch.js"></script>