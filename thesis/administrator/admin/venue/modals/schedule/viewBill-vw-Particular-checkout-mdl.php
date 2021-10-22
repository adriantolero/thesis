<!-- Create Schedule Modal -->
<div class="modal fade" id="viewBill-viewParticular-checkout-modal" data-id tabindex="-1" role="dialog" aria-labelledby="View Particulars" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content bg-dark text-white">
			<form>
				<div class="modal-header">
					<h3 class="modal-title">
						<i class="fa fa-search"></i> View Particular
					</h3>
					<button type="button" id="close-viewBill-viewParticular-checkout-modal" class="close" data-dismiss="modal" aria-label="Close" style="/*color: white;*/">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					
					<div class="mt-2">
						<p style="color: white;">Please select:</p>
						<hr>
					</div>

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text">Particulars</span>
						</div>
						<select class="custom-select" id="viewBill-particulars-category" disabled>
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
						<select class="custom-select" id="viewBill-particulars-aircon" disabled>
							<option value="0">Without Aircon</option>
							<option value="1">With Aircon</option>
						</select>
					</div>

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text">Description</span>
						</div>
						<select class="custom-select" id="viewBill-particulars-description" disabled>
			
						</select>
					</div>

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text">First Hour Rate</span>
						</div>
						<input type="text" class="form-control" id="viewBill-particulars-firstHour" disabled>
					</div>

					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">Succeeding Hour Rate</span>
						</div>
						<input type="text" class="form-control" id="viewBill-particulars-succeedingHour" disabled>
					</div>


				</div>
				<div class="modal-footer">							
					<button class="btn btn-success edit" id="viewBill-particulars-submit-btn" style="width: 100%;"><i class="fa fa-edit fa-fw"></i> Edit</button>
				</div>
			</form>
		</div>
	</div>
</div><!-- End Create Review Schedule -->