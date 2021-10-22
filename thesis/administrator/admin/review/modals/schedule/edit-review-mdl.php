<!-- Edit Schedule Modal -->
<div class="modal fade" id="editReview-modal" tabindex="-1" role="dialog" aria-labelledby="View Schedule" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content bg-dark text-white">
			<div class="modal-header">
				<h3 class="modal-title">
					Review Schedule
				</h3>
				<button type="button" id="close-createReview" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">Room</span>
						</div>
						<select id="edit-room" class="col-md-4 form-control">
							<option value="0"></option>
							<?php
								$crud->getRoom();
							?>
						</select>								
					</div>
					<div class="mr-auto mb-3" id="edit-room-msg"></div>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">Description</span>
						</div>
						<input type="text" id="edit-description" class="form-control" placeholder="Title of the review" />
					</div>
					<div class="mr-auto mb-3" id="edit-description-msg"></div>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">Reviewer(s)</span>
						</div>
						<input type="text" id="edit-reviewee" class="form-control" placeholder="Name of reviewee">
					</div>
					<div class="mr-auto mb-3" id="edit-reviewee-msg"></div>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">No. of participants</span>
						</div>
						<input type="text" id="edit-num-reviewers" class="col-md-4 form-control" placeholder="0">
					</div>
					<div class="mr-auto mb-3" id="edit-num-reviewers-msg"></div>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">Date start</span>
						</div>
						<input type="text" id="edit-date-start" class="col-md-6 form-control" placeholder="yyyy-mm-dd hh:mm">
					</div>
					<div class="mr-auto mb-3" id="edit-date-start-msg"></div>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">Date end</span>
						</div>
						<input type="text" id="edit-date-end" class="col-md-6  form-control" placeholder="yyyy-mm-dd hh:mm">
					</div>
					<div class="mr-auto mb-3" id="edit-date-end-msg"></div>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">Review Fee(VSU grad.)</span>
						</div>
						<input type="text" id="edit-reviewFee-vsu" class="col-md-4 form-control" placeholder="VSU graduate">
					</div>
					<div class="mr-auto mb-3" id="edit-reviewFee-vsu-msg"></div>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">Review Fee(Non-VSU grad.)</span>
						</div>
						<input type="text" id="edit-reviewFee-nonVsu" class="col-md-4 form-control" placeholder="Non-VSU graduate">
					</div>
					<div class="mr-auto mb-3" id="edit-reviewFee-nonVsu-msg"></div>
					<!--
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">Status</span>
						</div>
						<select id="edit-status" class="col-md-4 form-control">
							<option value="0">Inactive</option>
							<option value="1">Active</option>
						</select>						
					</div>
					<div class="mr-auto mb-3" id="edit-status-msg"></div>
				-->
				</form>
			</div>
			<div class="modal-footer">							
				<button class="btn btn-success mr-auto" id="editReviewSched" data-id="rev_id"><i class="fa fa-calendar-check"></i> Book now</button>
			</div>
		</div>
	</div>
</div><!-- End Edit Review Schedule -->