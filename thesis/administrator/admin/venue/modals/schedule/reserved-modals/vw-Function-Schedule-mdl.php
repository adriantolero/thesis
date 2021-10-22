<!-- Create Schedule Modal -->
<div class="modal fade" id="vwFunctionSched-modal" data-id tabindex="-1" role="dialog" aria-labelledby="Add Function Schedule(First Floor)" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content bg-dark text-white">
			<div class="modal-header">
				<h3 class="modal-title">
					<i class="fa fa-calendar-alt"></i> View Schedule
				</h3>
				<button type="button" id="close-addFunctionSched-modal" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				
				<div class="row">
					<div class="column">
						<div style="height: 1px;width: 100%;margin-top: 10px;background-color: white;"></div>
					</div>
					<div class="column">
						<center><i class="fa fa-info-circle"></i> Agency/Org. Info</center>
					</div>
					<div class="column">
						<div style="height: 1px;width: 100%;margin-top: 10px;background-color: white;"></div>
					</div>
				</div>
	
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-pencil-alt fa-fw"></i>Agency/Organization</span>
					</div>
					<input type="text" class="form-control" id="vwAgency" placeholder="Agency/Organization" maxlength="100" disabled>
				</div>
						
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fa fa-address-card fa-fw"></i> Address</span>
					</div>
					<input type="text" class="form-control" id="vwAddress" placeholder="Agency/Organization Address" maxlength="100" disabled>
				</div>
		
				<div class="row">
					<div class="column">
						<div style="height: 1px;width: 100%;margin-top: 10px;background-color: white;"></div>
					</div>
					<div class="column">
						<center><i class="fa fa-info-circle"></i> Activity</center>
					</div>
					<div class="column">
						<div style="height: 1px;width: 100%;margin-top: 10px;background-color: white;"></div>
					</div>
				</div>

				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-pencil-alt fa-fw"></i> Title of activity</span>
					</div>
					<input type="text" class="form-control col-md-12" id="vwTitle" placeholder="Title of activity" maxlength="100" disabled>
				</div>
				<div class="ml-3" id="vwTitle-msg">* Required</div>

				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fa fa-users fa-fw"></i> No. of Participants</span>
					</div>
					<input type="text" class="form-control col-md-2" placeholder="0" id="vwParticipants" maxlength="4" disabled>
				</div>
				<div class="ml-3 mb-2" id="vwParticipants-msg">* Required</div>

				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<span class="input-group-text">Room</span>
					</div>
					<select class="custom-select" id="vwRoom" disabled>
						
					</select>
				</div>

				<div class="row mb-2">
					<div class="col-md-6">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fa fa-calendar-alt fa-fw"></i> From</span>
							</div>
							<input type="text" class="form-control" id="vwDatestart" disabled placeholder="yyyy-mm-dd">
						</div>
						<div id="vwDatestart-msg" class="ml-3 mt-2">* Required</div>
					</div>
					<div class="col-md-6">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fa fa-clock fa-fw"></i> From</span>
							</div>
							<input type="text" class="form-control" id="vwTimestart" disabled placeholder="HH:mm">
						</div>	
						<div id="vwTimestart-msg" class="ml-3 mt-2">* Required</div>
					</div>
				</div>

				<div class="row mb-2">
					<div class="col-md-6">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fa fa-calendar-alt fa-fw"></i> To</span>
							</div>
							<input type="text" class="form-control" id="vwDateend" disabled placeholder="yyyy-mm-dd">
						</div>
						<div id="vwDateend-msg" class="ml-3 mt-2">* Required</div>
					</div>
					<div class="col-md-6">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fa fa-clock fa-fw"></i> To</span>
							</div>
							<input type="text" class="form-control" id="vwTimeend" disabled placeholder="HH:mm">
						</div>
						<div id="vwTimeend-msg" class="ml-3 mt-2">* Required</div>
					</div>
				</div>	
				<!--
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fa fa-calendar-alt fa-fw"></i> Date & Time(start)</span>
					</div>
					<input type="text" class="form-control col-md-12" id="addDatestart">
				</div>
				-->
				<!--
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fa fa-calendar-alt fa-fw"></i> Date & Time(end)</span>
					</div>
					<input type="text" class="form-control col-md-12" id="addDateend">
				</div>
				-->
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-pencil-alt fa-fw"></i> Nature of Activity</span>
					</div>	
					<input type="text" class="form-control" id="vwNature" maxlength="50" disabled placeholder="Nature" >
				</div>
				<div id="vwNature-msg" class="ml-3 mt-2">* Required</div>
				<!--
				<div>
					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text">Nature of Activity</span>
						</div>
						<select class="custom-select col-md-12" id="first-addActivityType">
							<option value="1">Meeting</option>
							<option value="2">Workshop</option>
							<option value="3">Conference</option>
							<option value="4">Social gathering(please specify)</option>
						</select>
					</div>
					<div class="ml-4">
						<div class="collapse" id="socialGathering-collapse">
							<div class="input-group mb-2">
								<div class="input-group-prepend">
									<span class="input-group-text">Social gathering</span>
								</div>
								<select class="custom-select col-md-5" id="first-addSocialGather">
									<option value="1">Birthday Party</option>
									<option value="2">Wedding</option>
									<option value="3">Others(Please specify)</option>
								</select>
							</div>
						</div>

						<div class="ml-4">
							<div class="collapse" id="socialGatheringOthers-collapse">
								<div class="input-group mb-2">
									<div class="input-group-prepend">
										<span class="input-group-text">Specify</span>
									</div>
									<input type="text" class="form-control col-md-5" >
								</div>
							</div>
						</div>
					</div>
				</div>
				-->
				<div class="row">
					<div class="column">
						<div style="height: 1px;width: 100%;margin-top: 10px;background-color: white;"></div>
					</div>
					<div class="column">
						<center><i class="fa fa-info-circle"></i> Requisitioner</center>
					</div>
					<div class="column">
						<div style="height: 1px;width: 100%;margin-top: 10px;background-color: white;"></div>
					</div>
				</div>

				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-pencil-alt fa-fw"></i> Reserved by</span>
					</div>
					<input type="text" class="form-control col-md-12" id="vwReservedBy" maxlength="100" placeholder="Name" disabled>
				</div>
				<div id="vwReservedBy-msg" class="ml-3 mb-2">* Required</div>

				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-address-card fa-fw"></i> Address</span>
					</div>
					<input type="text" class="form-control col-md-12" id="vwReservedByAddress" placeholder="Address" maxlength="100" disabled>
				</div>
		
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fa fa-mobile-alt fa-fw"></i> Mobile </span>
					</div>
					<input type="text" class="form-control col-md-12" id="vwReservedByMobile" maxlength="30" placeholder="Mobile"  disabled>
				</div>
				<div id="vwReservedByMobile-msg" class="ml-3 mb-2">* Required</div>

				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fa fa-envelope fa-fw"></i> Email</span>
					</div>
					<input type="text" class="form-control col-md-12" id="vwReservedByEmail" maxlength="50" placeholder="Email Address" disabled>
				</div>

			</div>
			<div class="modal-footer">							
				<button class="btn btn-success mr-auto edit" id="editFunctionSched" style="width: 100%;"><i class="fa fa-edit"></i> Edit</button>
			</div>
		</div>
	</div>
</div><!-- End Create Review Schedule -->