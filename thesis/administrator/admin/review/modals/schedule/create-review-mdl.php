<!-- Create Schedule Modal -->
<div class="modal fade" id="addReview-modal" tabindex="-1" role="dialog" aria-labelledby="Add Schedule" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content bg-dark text-white">
			<div class="modal-header">
				<h3 class="modal-title">
					<i class="fa fa-calendar-plus"></i> Create Review Schedule
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
							<span class="input-group-text"><i class="fa fa-pencil-alt fa-fw"></i> Description</span>
						</div>
						<input type="text" id="create-description" class="form-control" placeholder="Title of the review"  maxlength="100" />
					</div>
					<div class="mr-auto mb-3" id="create-description-msg">* Required</div>

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-pencil-alt fa-fw"></i> Reviewer(s)</span>
						</div>
						<input type="text" id="create-reviewee" class="form-control" placeholder="Name of reviewer" maxlength="100">
					</div>
					<div class="mr-auto mb-3" id="create-reviewee-msg">* Required</div>

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-users fa-fw"></i> No. of participants</span>
						</div>
						<input type="text" id="create-num-reviewers" class="col-md-4 form-control" placeholder="0" maxlength="5">
					</div>
					<div class="mr-auto mb-3" id="create-num-reviewers-msg">* Required</div>

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text">Room</span>
						</div>
						<select id="create-room" class="col-md-4 form-control">
							<option value="0"></option>
							<?php
								$crud->getRoom();
							?>
						</select>								
					</div>
					<div class="mr-auto mb-3" id="create-room-msg">* Required</div>

					<div class="row mb-2">
						<div class="col-md-6">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fa fa-calendar-alt fa-fw"></i> From</span>
								</div>
								<input type="text" class="form-control" id="create-date-start" placeholder="yyyy-mm-dd" autocomplete="off">
							</div>
							<div id="create-date-start-msg" class="ml-3 mt-2">* Required</div>
						</div>
						<div class="col-md-6">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fa fa-clock fa-fw"></i> From</span>
								</div>
								<input type="text" class="form-control" id="create-time-start" placeholder="HH:mm" autocomplete="off">
							</div>	
							<div id="create-time-start-msg" class="ml-3 mt-2">* Required</div>
						</div>
					</div>

					<div class="row mb-2">
						<div class="col-md-6">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fa fa-calendar-alt fa-fw"></i> To</span>
								</div>
								<input type="text" class="form-control" id="create-date-end" placeholder="yyyy-mm-dd" autocomplete="off">
							</div>
							<div id="create-date-end-msg" class="ml-3 mt-2">* Required</div>
						</div>
						<div class="col-md-6">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fa fa-clock fa-fw"></i> To</span>
								</div>
								<input type="text" class="form-control" id="create-time-end" placeholder="HH:mm" autocomplete="off">
							</div>
							<div id="create-time-end-msg" class="ml-3 mt-2">* Required</div>
						</div>
					</div>	

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
						<input type="text" id="create-reviewFee-vsu" class="form-control" placeholder="0" maxlength="15">
					</div>
					<div class="mr-auto mb-3" id="create-reviewFee-vsu-msg">* Required</div>

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text">Non-VSU Grad.</span>
						</div>
						<input type="text" id="create-reviewFee-nonVsu" class="form-control" placeholder="0" maxlength="15">
					</div>
					<div class="mr-auto mb-3" id="create-reviewFee-nonVsu-msg">* Required</div>
					<!--
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
						<select id="create-status" class="col-md-4 form-control">
							<option value="0">Hide</option>
							<option value="1">Show</option>
						</select>						
					</div>
					<div class="mr-auto mb-3" id="create-status-msg">* Required</div>
					-->
				</form>
			</div>
			<div class="modal-footer">							
				<button class="btn btn-success mr-auto" id="createReviewSched"><i class="fa fa-calendar-plus"></i> Create</button>
			</div>
		</div>
	</div>
</div><!-- End Create Review Schedule -->