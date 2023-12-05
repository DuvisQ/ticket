<section class="content-header divSupport">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Support Admin</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Support Admin</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<section class="content divSupport">
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">List of Supports</h3>
                    <!--button type="button" class="btn btn-success float-right" id="btnAssignNewSupport">
                        <i class="fas fa-plus"></i> Assign New Support
                    </button-->
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <br>
                            <table id="tableSupports" class="table table-striped table-bordered table-hover table-checkable" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">Id</th>
                                        <th class="text-center">Code</th>
                                        <th class="text-center tr" key="Client">Client</th>
                                        <th class="text-center tr" key="Department">Branch</th>
                                        <th class="text-center tr" key="Code">User</th>
                                        <th class="text-center tr" key="Date Created">Agent</th>
                                        <th class="text-center tr" key="Date Attention">Title</th>
                                        <th class="text-center tr" key="Status">Status</th>
                                        <th class="text-center tr" key="Status">Date</th>
                                        <th class="text-center tr" key="Actions">Actions</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="../controllers/support_admin.js"></script>