<!-- Create Schedule Modal -->
<div class="modal fade" id="createAmenity-checkout-modal" data-id tabindex="-1" role="dialog" aria-labelledby="Create Amenity" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content bg-dark text-white">
			<form>
				<div class="modal-header">
					<h3 class="modal-title">
						<i class="fa fa-plus-circle"></i> Add Equipment
					</h3>
					<button type="button" id="close-createAmenity-checkout-modal" class="close" data-dismiss="modal" aria-label="Close" style="/*color: white;*/">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text">Description</span>
						</div>
						<input type="text" class="form-control" id="create-amenityDescription" maxlength="100">
					</div>
					<div class="ml-3 mb-2" id="create-amenityDescription-msg">* Required</div>

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text">Rate</span>
						</div>
						<input type="text" class="form-control" id="create-amenityPayment">
					</div>
					<div class="ml-3" id="create-amenityPayment-msg">* Required</div>

				</div>
				<div class="modal-footer">							
					<button class="btn btn-success" id="create-amenity-submit-btn" style="width: 100%;"><i class="fa fa-save fa-fw"></i> Submit</button>
				</div>
			</form>
		</div>
	</div>
</div><!-- End Create Review Schedule -->