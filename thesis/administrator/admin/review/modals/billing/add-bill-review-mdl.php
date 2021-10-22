<div class="modal fade in" id="add-bill-modal" data-id tabindex="-1" role="dialog" aria-labelledby="Add Bill" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content bg-dark text-white">
			<form>
				<div class="modal-header">
					<h3 class="modal-title">
						Record Bill
					</h3>
					<button type="button" id="close-createBillReview" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="col-md-12">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fa fa-pencil-alt fa-fw"></i>Description</span>
							</div>
							<input type="text" class="form-control" id="add-description" maxlength="50">
						</div>
						<div id="add-description-msg" class="mt-2 ml-3">* Required</div>

						<div class="input-group mt-2">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fa fa-pencil-alt fa-fw"></i>OR#</span>
							</div>
							<input type="text" class="form-control" id="add-or-num" maxlength="15">
						</div>
						<div id="add-or-num-msg" class="mt-2 ml-3">* Required</div>

						<div class="input-group mt-2">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fa fa-pencil-alt fa-fw"></i>Amount paid</span>
							</div>
							<input type="text" class="form-control" id="add-amount-paid" maxlength="15">
						</div>
						<div id="add-amount-paid-msg" class="mt-2 ml-3">* Required</div>

						<div class="input-group mt-2">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fa fa-calendar-alt fa-fw"></i>Date paid</span>
							</div>
							<input type="text" class="form-control" id="add-date-paid" autocomplete="off">
						</div>
						<div id="add-date-paid-msg" class="mt-2 ml-3">* Required</div>
						<!--
						<div id="add-bill-msg-cont">
							<p id="add-bill-msg">wda</p>
						</div>
						-->
					</div>
				</div>
				<div class="modal-footer">							
					<button class="btn btn-success" id="add-bill-btn"><i class="fa fa-plus-circle"></i> Add</button>
				</div>
			</form>
		</div>
	</div>
</div><!-- End Create Review Schedule -->