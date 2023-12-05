<div class="modal fade" id="modalViewPayment">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Details Payment</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                 <div class="invoice p-3 mb-3">
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-6">
                  <h4>
                    <img src="../../assets/images/logo-go.png" alt="" height="100" width="100">
                  </h4>
                </div>
                 
                <!-- /.col -->
                <div class="col-sm-6 invoice-col">
                    <b>Client <span id="name_client"></span></b><br>
                    <b>Payment #<span id="id_payment"></span></b><br>
                    <b>Order ID:</b> <span id="code_paymment"></span><br>
                    <b>Description:</b> <span id="description"></span><br>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>Qty</th>
                      <th>Plan</th>
                      <th>Date Start</th>
                      <th>Date Expired</th>
                      <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td>1</td>
                      <td><span id="plan_name"></span></td>                      
                      <td><span id="start"></span></td>
                      <td><span id="expirated"></span></td>
                      <td><span class="plan_amount"></span></td>
                    </tr>                     
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Payment Method:</p>
                  <span id="method_name"></span><br>
                  <img id="payment_method" src="" alt="Card">
                  
                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    <span id="card_number"></span>
                    <span id="card_stripe"></span>
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead">Amount Due <span id="created"></span></p>

                  <div class="table-responsive">
                    <table class="table">
                      <tbody><tr>
                        <th style="width:50%">Subtotal:</th>
                        <td>$<span class="plan_amount"></span></td>
                      </tr>
                      <tr>
                        <th>Discount</th>
                        <td>$<span id="discount"></span></td>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <td>$<span id="total_payment"></span></td>
                      </tr>
                    </tbody></table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>