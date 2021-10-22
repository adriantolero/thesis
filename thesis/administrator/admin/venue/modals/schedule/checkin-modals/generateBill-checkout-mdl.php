<!-- Create Schedule Modal -->
<div class="modal fade" id="generateBill-checkout-modal" data-id tabindex="-1" role="dialog" aria-labelledby="Generate Bill for Check-out" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg" role="document" id="generateBill-checkout-modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header bg-dark text-white">
					<h3 class="modal-title">
						<i class="fa fa-clipboard fa-fw"></i> Check-out Bill
					</h3>
					<button type="button" id="close-generateBill-checkout-modal" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<div class="row">
						<div class="col-md-12">

							<div class="row mb-2">
								<label for="generateBill-name" class="col-form-label col-md-3">Name</label>
								<div class="col-md-7">
									<input type="text" class="form-control" id="generateBill-name" disabled>
								</div>
							</div>

							<div class="row mb-2">
								<label for="generateBill-room" class="col-form-label col-md-3">Room</label>
								<div class="col-md-5">
									<input type="text" class="form-control" id="generateBill-room" disabled>
								</div>
							</div>

							<div class="row mb-2">
								<label for="generateBill-checkin" class="col-form-label col-md-3">Checked-in</label>
								<div class="col-md-5">
									<input type="text" class="form-control" id="generateBill-checkin" data-checkin disabled>
								</div>
							</div>

							<div class="row mb-2">
								<label for="generateBill-checkout" class="col-form-label col-md-3">Checked-out</label>
								<div class="col-md-5">
									<input type="text" class="form-control" id="generateBill-checkout" data-checkout disabled>
								</div>
							</div>

							<div class="row mb-2">
								<label for="generateBill-totalHours" class="col-form-label col-md-3">Total hours</label>
								<div class="col-md-3">
									<input type="text" class="form-control" id="generateBill-totalHours" disabled>
								</div>
							</div>

							<div style="margin-top: 2em;">
								<div class="row mb-2">
									<label for="generateBill-particular" class="col-form-label col-md-3">Charge</label>
									<div class="col-md-5">
										<input type="text" class="form-control" id="generateBill-particular" disabled>
									</div>
								</div>

								<div class="row mb-2">
									<label for="generateBill-amenity" class="col-form-label col-md-3">Additional charge</label>
									<div class="col-md-5">
										<input type="text" class="form-control" id="generateBill-amenity" disabled>
									</div>
								</div>

								<div class="row mb-2">
									<label for="generateBill-total" class="col-form-label col-md-3">Total</label>
									<div class="col-md-5">
										<input type="text" class="form-control" id="generateBill-total" disabled>
									</div>
								</div>
								<!--
								<div class="row mb-2">
									<label for="generateBill-billStatus" class="col-form-label col-md-3">Billing status</label>
									<div class="col-md-5">
										<select class="custom-select form-control" id="generateBill-billStatus">
											<option value="0">Not paid</option>
											<option value="1">Paid</option>
										</select>
									</div>
								</div>

								<div class="row mb-2">
									<label for="generateBill-ORNum" class="col-form-label col-md-3">Official Receipt #</label>
									<div class="col-md-5">
										<input type="text" class="form-control" id="generateBill-ORNum" disabled maxlength="15">
									</div>
								</div>
								-->
							</div>

						</div><!-- col-md-12 -->
					</div><!-- row -->

					<div class="row">
						<div class="col-md-12">
							<button class="btn btn-success float-right" id="generateBill-print"><i class="fa fa-print fa-fw"></i> Print</button>
						</div>
					</div>
			
				</div>
				<div class="modal-footer">								
					<center><button class="btn btn-success" id="generateBill-submit"><i class="fa fa-sign-out-alt fa-fw"></i> Check-out</button></center>	
				</div>
			</form>
		</div>
	</div>
</div><!-- End Create Review Schedule -->