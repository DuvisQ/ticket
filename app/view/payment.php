<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Payment</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Payment</li>
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
                    <h3 class="card-title">List of Payments</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <select name="select_search_client" id="select_search_client" class="mb-4 custom custom-select select2">
                            </select>
                            <br>
                            <table id="tablePayments" class="table table-striped table-bordered table-hover table-checkable" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">Id</th>
                                        <th class="text-center tr" key="Plan">Plan</th>
                                        <th class="text-center tr" key="Client">Client</th>
                                        <th class="text-center tr" key="Plan Amount">Amount</th>
                                        <th class="text-center tr" key="Discount">Discount</th>
                                        <th class="text-center tr" key="Total Payment">Total</th>
                                        <th class="text-center tr" key="Method">Method</th>
                                        <th class="text-center tr" key="Status">Status</th>
                                        <th class="text-center tr" key="Actions" >Actions</th>
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
<script src="../controllers/payment.js"></script>