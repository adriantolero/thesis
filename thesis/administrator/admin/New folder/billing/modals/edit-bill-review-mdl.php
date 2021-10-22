<div class="modal fade in" id="edit-bill-modal" tabindex="-1" role="dialog" aria-labelledby="Edit Bill" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content bg-dark text-white">
			<div class="modal-header">
				<h3 class="modal-title">
					Edit Bill
				</h3>
				<button type="button" id="close-createBillReview" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="col-md-12">
					<form>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">Description</span>
							</div>
							<input type="text" class="form-control" id="edit-description">
						</div>
						<div id="edit-description-msg" class="mt-2 ml-3">* Required</div>

						<div class="input-group mt-2">
							<div class="input-group-prepend">
								<span class="input-group-text">OR#</span>
							</div>
							<input type="text" class="form-control" id="edit-or-num">
						</div>
						<div id="edit-or-num-msg" class="mt-2 ml-3">* Required</div>

						<div class="input-group mt-2">
							<div class="input-group-prepend">
								<span class="input-group-text">Amount paid</span>
							</div>
							<input type="text" class="form-control" id="edit-amount-paid">
						</div>
						<div id="edit-amount-paid-msg" class="mt-2 ml-3">* Required</div>

						<div class="input-group mt-2">
							<div class="input-group-prepend">
								<span class="input-group-text">Date paid</span>
							</div>
							<input type="text" class="form-control" id="edit-date-paid">
						</div>
						<div id="edit-date-paid-msg" class="mt-2 ml-3">* Required</div>
						<!--
						<div id="add-bill-msg-cont">
							<p id="add-bill-msg">wda</p>
						</div>
						-->
					</form>
				</div>
			</div>
			<div class="modal-footer">							
				<button type="button" class="btn btn-success" id="edit-bill-btn" data-id=""><i class="fa fa-edit"></i> Update</button>
			</div>
		</div>
	</div>
</div><!-- End Create Review Schedule -->