<!-- View Schedule Modal -->
<div class="modal fade" id="viewReview-modal" tabindex="-1" role="dialog" aria-labelledby="View Schedule" aria-hidden="true" data-backdrop="static" data-keyboard="false">
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

					<div class="row">
						<div class="column">
							<div style="height: 1px;width: 100%;margin-top: 10px;background-color: white;"></div>
						</div>
						<div class="column">
							<center><i class="fa fa-info-circle"></i> Review Info. </center>
						</div>
						<div class="column">
							<div style="height: 1px;width: 100%;margin-top: 10px;background-color: white;"></div>
						</div>
					</div>

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-pencil-alt fa-fw"></i>Description</span>
						</div>
						<input type="text" id="view-description" class="form-control" placeholder="Title of the review"  disabled/>
					</div>
					<div class="mr-auto mb-3" id="view-description-msg">* Required</div>

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-pencil-alt fa-fw"></i>Reviewee</span>
						</div>
						<input type="text" id="view-reviewee" class="form-control" placeholder="Name of reviewee" disabled>
					</div>
					<div class="mr-auto mb-3" id="view-reviewee-msg">* Required</div>

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-users fa-fw"></i>No. of participants</span>
						</div>
						<input type="text" id="view-num-reviewers" class="col-md-4 form-control" placeholder="0" disabled>
					</div>
					<div class="mr-auto mb-3" id="view-num-reviewers-msg">* Required</div>

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text">Room</span>
						</div>
						<select id="view-room" class="col-md-4 form-control" disabled>
							<option value="0"></option>
							<?php
								$crud->getRoom();
							?>
						</select>							
					</div>
					<div class="mr-auto mb-3" id="view-room-msg">* Required</div>

					<div class="row mb-2">
						<div class="col-md-6">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fa fa-calendar-alt fa-fw"></i> From</span>
								</div>
								<input type="text" class="form-control" id="view-date-start" placeholder="yyyy-mm-dd" disabled>
							</div>
							<div id="view-date-start-msg" class="ml-3 mt-2">* Required</div>
						</div>
						<div class="col-md-6">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fa fa-clock fa-fw"></i> From</span>
								</div>
								<input type="text" class="form-control" id="view-time-start" placeholder="HH:mm" disabled>
							</div>	
							<div id="view-time-start-msg" class="ml-3 mt-2">* Required</div>
						</div>
					</div>

					<div class="row mb-2">
						<div class="col-md-6">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fa fa-calendar-alt fa-fw"></i> To</span>
								</div>
								<input type="text" class="form-control" id="view-date-end" placeholder="yyyy-mm-dd" disabled>
							</div>
							<div id="view-date-end-msg" class="ml-3 mt-2">* Required</div>
						</div>
						<div class="col-md-6">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fa fa-clock fa-fw"></i> To</span>
								</div>
								<input type="text" class="form-control" id="view-time-end" placeholder="HH:mm" disabled>
							</div>
							<div id="view-time-end-msg" class="ml-3 mt-2">* Required</div>
						</div>
					</div>

					<!--<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-calendar-alt fa-fw"></i>Date start</span>
						</div>
						<input type="text" id="view-date-start" class="col-md-6 form-control" placeholder="yyyy-mm-dd hh:mm" disabled>
					</div>
					<div class="mr-auto mb-3" id="view-date-start-msg"></div>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-calendar-alt fa-fw"></i>Date end</span>
						</div>
						<input type="text" id="view-date-end" class="col-md-6  form-control" placeholder="yyyy-mm-dd hh:mm" disabled>
					</div>
					<div class="mr-auto mb-3" id="view-date-end-msg"></div>
					-->
					<div class="row">
						<div class="column">
							<div style="height: 1px;width: 100%;margin-top: 10px;background-color: white;"></div>
						</div>
						<div class="column">
							<center><i class="fa fa-info-circle"></i> Review Fee </center>
						</div>
						<div class="column">
							<div style="height: 1px;width: 100%;margin-top: 10px;background-color: white;"></div>
						</div>
					</div>

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text">VSU Grad.</span>
						</div>
						<input type="text" id="view-reviewFee-vsu" class="col-md-4 form-control" placeholder="VSU graduate" disabled>
					</div>
					<div class="mr-auto mb-3" id="view-reviewFee-vsu-msg">* Required</div>

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text">Non-VSU Grad.</span>
						</div>
						<input type="text" id="view-reviewFee-nonVsu" class="col-md-4 form-control" placeholder="Non-VSU graduate" disabled>
					</div>
					<div class="mr-auto mb-3" id="view-reviewFee-nonVsu-msg">* Required</div>

					<div class="row">
						<div class="column">
							<div style="height: 1px;width: 100%;margin-top: 10px;background-color: white;"></div>
						</div>
						<div class="column">
							<center><i class="fa fa-info-circle"></i> Status </center>
						</div>
						<div class="column">
							<div style="height: 1px;width: 100%;margin-top: 10px;background-color: white;"></div>
						</div>
					</div>

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text">Status</span>
						</div>
						<select id="view-status" class="col-md-4 form-control" disabled>
							<option value="0">Hide</option>
							<option value="1">Show</option>
						</select>						
					</div>
					<div class="mr-auto mb-3" id="view-status-msg">* Required</div>
				</form>
			</div>
			<div class="modal-footer">							
				<button class="btn btn-success mr-auto edit" id="manageReviewSched-btn" data-id="rev_id"><i class="fa fa-edit" id="icon_change_review"></i> Edit</button>
			</div>
		</div>
	</div>
</div><!-- End Create Review Schedule -->