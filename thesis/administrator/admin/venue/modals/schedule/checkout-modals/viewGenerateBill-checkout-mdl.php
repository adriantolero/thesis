<!-- Create Schedule Modal -->
<div class="modal fade" id="viewGenerateBill-checkout-modal" data-id tabindex="-1" role="dialog" aria-labelledby="View Generated Bill" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg" role="document" id="generateBill-checkout-modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header bg-dark text-white">
					<h3 class="modal-title">
						<i class="fa fa-clipboard fa-fw"></i> View Bill
					</h3>
					<button type="button" id="close-viewGenerateBill-checkout-modal" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<div class="row">
						<div class="col-md-12">

							<div class="row mb-2">
								<label for="viewBill-generateBill-name" class="col-form-label col-md-3">Name</label>
								<div class="col-md-7">
									<input type="text" class="form-control" id="viewBill-generateBill-name" disabled>
								</div>
							</div>

							<div class="row mb-2">
								<label for="viewBill-generateBill-room" class="col-form-label col-md-3">Room</label>
								<div class="col-md-5">
									<input type="text" class="form-control" id="viewBill-generateBill-room" disabled>
								</div>
							</div>

							<div class="row mb-2">
								<label for="viewBill-generateBill-checkin" class="col-form-label col-md-3">Checked-in</label>
								<div class="col-md-5">
									<input type="text" class="form-control" id="viewBill-generateBill-checkin" disabled>
								</div>
							</div>

							<div class="row mb-2">
								<label for="viewBill-generateBill-checkout" class="col-form-label col-md-3">Checked-out</label>
								<div class="col-md-5">
									<input type="text" class="form-control" id="viewBill-generateBill-checkout" data-checkout disabled>
								</div>
							</div>

							<div class="row mb-2">
								<label for="viewBill-generateBill-totalHours" class="col-form-label col-md-3">Total hours</label>
								<div class="col-md-3">
									<input type="text" class="form-control" id="viewBill-generateBill-totalHours" disabled>
								</div>
							</div>

							<div style="margin-top: 2em;">
								<div class="row mb-2">
									<label for="viewBill-generateBill-particular" class="col-form-label col-md-3">Charge</label>
									<div class="col-md-5">
										<input type="text" class="form-control" id="viewBill-generateBill-particular" disabled>
									</div>
								</div>

								<div class="row mb-2">
									<label for="viewBill-generateBill-amenity" class="col-form-label col-md-3">Additional charge</label>
									<div class="col-md-5">
										<input type="text" class="form-control" id="viewBill-generateBill-amenity" disabled>
									</div>
								</div>

								<div class="row mb-2">
									<label for="viewBill-generateBill-total" class="col-form-label col-md-3">Total</label>
									<div class="col-md-5">
										<input type="text" class="form-control" id="viewBill-generateBill-total" disabled>
									</div>
								</div>

								<div class="row mb-2">
									<label for="viewBill-generateBill-billStatus" class="col-form-label col-md-3">Billing status</label>
									<div class="col-md-5">
										<select class="custom-select form-control" id="viewBill-generateBill-billStatus" disabled>
											<option value="0">Not paid</option>
											<option value="1">Paid</option>
										</select>
									</div>
								</div>

								<div class="row mb-2">
									<label for="viewBill-generateBill-ORNum" class="col-form-label col-md-3">Official Receipt #</label>
									<div class="col-md-5">
										<input type="text" class="form-control" id="viewBill-generateBill-ORNum" disabled maxlength="15">
									</div>
								</div>
							</div>

						</div><!-- col-md-12 -->
					</div><!-- row -->
			
				</div>
				<div class="modal-footer">							
					<button class="btn btn-success edit" id="viewBill-generateBill-submit"><i class="fa fa-edit fa-fw"></i> Edit</button>
				</div>
			</form>
		</div>
	</div>
</div><!-- End Create Review Schedule -->