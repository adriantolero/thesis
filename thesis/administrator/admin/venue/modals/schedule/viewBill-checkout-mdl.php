<!-- Create Schedule Modal -->
<div class="modal fade" id="viewBill-checkout-modal" data-id tabindex="-1" role="dialog" aria-labelledby="View Bill" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg" role="document" id="viewBill-checkout-modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header bg-dark text-white">
					<h3 class="modal-title">
						<i class="fa fa-search fa-fw"></i> View Bill
					</h3>
					<button type="button" id="close-viewBill-checkout-modal" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<div class="row">
						<div class="col-md-12">

							<div class="row mb-2">
								<label class="col-form-label col-md-3" for="viewBill-name">Name</label>
								<div class="col-md-7">
									<input type="text" class="form-control" id="viewBill-name" disabled>
								</div>
							</div>

							<div class="row mb-2">
								<label class="col-form-label col-md-3">Room</label>
								<div class="col-md-3">
									<input type="text" class="form-control" id="viewBill-room" disabled>
								</div>
							</div>

							<div class="row mb-2">
								<label class="col-form-label col-md-3">Checked-in</label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="viewBill-checkin" disabled>
								</div>
							</div>

							<div class="row mb-2">
								<label class="col-form-label col-md-3">Checked-out</label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="viewBill-checkout" data-time disabled>
								</div>
							</div>

							<div class="row mb-2">
								<label class="col-form-label col-md-3">Total hours</label>
								<div class="col-md-3">
									<input type="text" class="form-control" id="viewBill-totalHours" disabled>
								</div>
							</div>

							<div class="row mb-2">
								<label class="col-form-label col-md-3">Billing status</label>
								<div class="col-md-3">
									<select class="custom-select form-control" id="viewBill-billingStatus" disabled>
										<option value="0">Not paid</option>
										<option value="1">Paid</option>
									</select>
								</div>
							</div>
							
							<div class="row mb-2">
								<label class="col-form-label col-md-3">Official Receipt #</label>
								<div class="col-md-3">
									<input type="text" class="form-control" id="viewBill-ORNum" disabled>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-12 table-responsive">
									<table class="table table-hover table-bordered">
										<thead>
											<th id="viewBill-paymentDescription" style="width: 50%">Description</th>
											<th id="viewBill-paymentPayment" style="width: 20%">Payment</th>
											<th id="viewBill-paymentAction" colspan="2" style="width: 30%">Action</th>
										</thead>
										<tbody id="viewBill-tbodyPaymentList"></tbody>
									</table>
								</div>
							</div>

							<div class="row">
								<div class="col-md-4 offset-md-8">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">Total Amount</span>
										</div>
										<input type="text" class="form-control" id="viewBill-particulars-total-amount" disabled>
									</div>
								</div>
							</div>

							<div class="row" style="margin-top: 3em;">
								<div class="col-md-8 offset-md-2" style="text-align: center;">
									<button class="btn btn-success" id="viewBill-addAmenity" style="width: 150px;" disabled><i class="fa fa-plus-circle fa-fw"></i> Add Amenity</button>
									<button class="btn btn-success" id="viewBill-print" style="width: 150px;"><i class="fa fa-print"></i> Print</button>
								</div>
							</div>

						</div><!-- col-md-12 -->
					</div><!-- row -->
			
					<!--
					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text">Name</span>
						</div>
						<input type="text" id="createBill-name" class="form-control" disabled>
					</div>

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text">Event Title</span>
						</div>
						<input type="text" id="createBill-title" class="form-control" disabled>
					</div>

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text">Room</span>
						</div>
						<input type="text" id="createBill-room" class="form-control col-md-5" disabled>
					</div>

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text">Date check-in</span>
						</div>
						<input type="text" id="createBill-checkin" class="form-control" disabled>
					</div>

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text">Date check-out</span>
						</div>
						<input type="text" id="createBill-checkout" class="form-control" disabled>
					</div>

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text">Total Hours</span>
						</div>
						<input type="text" id="createBill-totalHours" class="form-control col-md-3" disabled>
					</div>

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text">Particulars</span>
						</div>
						<select class="custom-select" id="createBill-particulars-category">
							<option value="1">VSU Personnel(First Floor)</option>
							<option value="2">VSU Students(First Floor)</option>
							<option value="3">Non VSU Employees and Students(First Floor)</option>
							<option value="4">VSU Employees and Students(Second Floor)</option>
							<option value="5">Non-VSU Employees(Second Floor)</option>
						</select>
					</div>

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text">Aircon</span>
						</div>
						<select class="custom-select" id="createBill-particulars-aircon">
							<option value="0">Without Aircon</option>
							<option value="1">With Aircon</option>
						</select>
					</div>

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text">Description</span>
						</div>
						<select class="custom-select" id="createBill-particulars-description">
			
						</select>
					</div>

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text">First Hour</span>
						</div>
						<input class="form-control col-md-3" id="createBill-particulars-first-hour" disabled>
					</div>

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text">Succeeding Hour</span>
						</div>
						<input class="form-control col-md-3" id="createBill-particulars-succeeding-hour" disabled>
					</div>

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text">Total Amount</span>
						</div>
						<input class="form-control col-md-3" id="createBill-particulars-total-amount" disabled>
					</div>
				-->
				</div>
				<div class="modal-footer">							
					<button class="btn btn-success edit" id="viewBill-submit"><i class="fa fa-save"></i> Edit</button>
				</div>
			</form>
		</div>
	</div>
</div><!-- End Create Review Schedule -->