<!-- Create Schedule Modal -->
<div class="modal fade" id="createBill-checkout-modal" data-id tabindex="-1" role="dialog" aria-labelledby="Generate Bill for Check-out" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg" role="document" id="createBill-checkout-modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header bg-dark text-white">
					<h3 class="modal-title">
						<i class="fa fa-search fa-fw"></i> View Rates
					</h3>
					<button type="button" id="close-createBill-checkout-modal" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<div class="row">
						<div class="col-md-12">

							<div class="row">
								<div class="col-md-12 table-responsive">
									<table class="table table-hover table-bordered">
										<thead>
											<th class="bg-dark text-white" colspan="4"><center>Room rate used</center></th>
											<tr>
												<td style="width: 50%;text-align: center;"><b>Description</b></td>
												<td style="width: 15%;text-align: center;"><b>First hour rate</b></td>
												<td style="width: 15%;text-align: center;"><b>Succeeding hour rate</b></td>
												<td style="width: 20%;text-align: center;"><b>Action</b></td>
											</tr>
										</thead>
										<tbody id="tbodyRegisteredParticular"></tbody>
									</table>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12 table-responsive" style="max-height: 300px;overflow-y: auto;">
									<table class="table table-hover table-bordered">
										<thead>
											<th class="bg-dark text-white" colspan="4"><center>Equipment(s) used</center></th>
											<tr>
												<td style="width: 60%;text-align: center;"><b>Description</b></td>
												<td style="width: 20%;text-align: center;"><b>Rate</b></td>
												<td style="width: 20%;text-align: center;" colspan="2"><b>Action</b></td>
											</tr>
										</thead>
										<tbody id="tbodyRegisteredAmenity"></tbody>
									</table>
								</div>
							</div>

							<div class="row" style="margin-top: 3em;">
								<div class="col-md-8 offset-md-2" style="text-align: center;">
									<button class="btn btn-success" id="createBill-addAmenity" style="width: 150px;"><i class="fa fa-plus-circle fa-fw"></i> Add Equipment</button>
								</div>
							</div>

							<!--

							<div class="row mb-2">
								<label class="col-form-label col-md-3" for="createBill-name">Name</label>
								<div class="col-md-7">
									<input type="text" class="form-control" id="createBill-name" disabled>
								</div>
							</div>

							<div class="row mb-2">
								<label class="col-form-label col-md-3">Room</label>
								<div class="col-md-3">
									<input type="text" class="form-control" id="createBill-room" disabled>
								</div>
							</div>

							<div class="row mb-2">
								<label class="col-form-label col-md-3">Checked-in</label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="createBill-checkin" disabled>
								</div>
							</div>

							<div class="row mb-2">
								<label class="col-form-label col-md-3">Checked-out</label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="createBill-checkout" data-time disabled>
								</div>
							</div>

							<div class="row mb-2">
								<label class="col-form-label col-md-3">Total hours</label>
								<div class="col-md-3">
									<input type="text" class="form-control" id="createBill-totalHours" disabled>
								</div>
							</div>

							<div class="row mb-2">
								<label class="col-form-label col-md-3">Billing status</label>
								<div class="col-md-3">
									<select class="custom-select form-control" id="createBill-billingStatus">
										<option value="0">Not paid</option>
										<option value="1">Paid</option>
									</select>
								</div>
							</div>



							<div class="collapse" id="collapse-OR">
								<div class="row mb-2">
									<label class="col-form-label col-md-3">Official Receipt #</label>
									<div class="col-md-3">
										<input type="text" class="form-control" id="createBill-ORNum">
									</div>
								</div>
							</div>
							-->

							<!--
							<div class="row">
								<div class="col-md-12 table-responsive">
									<table class="table table-hover table-bordered">
										<thead>
											<th id="paymentDescription" style="width: 50%">Description</th>
											<th id="paymentPayment" style="width: 20%">Payment</th>
											<th id="paymentAction" colspan="2" style="width: 30%">Action</th>
										</thead>
										<tbody id="tbodyPaymentList"></tbody>
									</table>
								</div>
							</div>

							-->

							<!--
							<div class="row">
								<div class="col-md-4 offset-md-8">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">Total Amount</span>
										</div>
										<input type="text" class="form-control" id="createBill-particulars-total-amount" disabled>
									</div>
								</div>
							</div>
							-->
							<!--
							<div class="row" style="margin-top: 3em;">
								<div class="col-md-8 offset-md-2" style="text-align: center;">
									<button class="btn btn-success" id="createBill-addAmenity" style="width: 150px;"><i class="fa fa-plus-circle fa-fw"></i> Add Amenity</button>
									<button class="btn btn-success" id="createBill-print" style="width: 150px;"><i class="fa fa-print"></i> Print</button>
								</div>
							</div>
							-->

						</div><!-- col-md-12 -->
					</div><!-- row -->
			
				</div>
				<div class="modal-footer">							
					<button class="btn btn-success" id="createBill-submit"><i class="fa fa-save"></i> Save</button>
				</div>
			</form>
		</div>
	</div>
</div><!-- End Create Review Schedule -->