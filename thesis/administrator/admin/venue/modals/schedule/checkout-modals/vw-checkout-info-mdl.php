<!-- Create Schedule Modal -->
<div class="modal fade" id="vwCheckout-info-modal" data-id tabindex="-1" role="dialog" aria-labelledby="Add Function Schedule(First Floor)" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content bg-dark text-white">
			<form>
				<div class="modal-header">
					<h3 class="modal-title">
						<i class="fa fa-info-circle"></i> View Info
					</h3>
					<button type="button" id="close-vwCheckout-info-modal" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
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
						<input type="text" class="form-control" id="vw-checkout-Agency" disabled maxlength="100" placeholder="Agency/Organization" >
					</div>
							
					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-address-card fa-fw"></i> Address</span>
						</div>
						<input type="text" class="form-control" id="vw-checkout-Address" disabled maxlength="100" placeholder="Agency/Organization Address" >
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
						<input type="text" class="form-control col-md-12" id="vw-checkout-Title" disabled maxlength="100" placeholder="Title of activity" >
					</div>
					<div class="ml-3" id="vw-checkout-Title-msg">* Required</div>

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-users fa-fw"></i> No. of Participants</span>
						</div>
						<input type="text" class="form-control col-md-2" id="vw-checkout-Participants" disabled maxlength="4" placeholder="0" >
					</div>
					<div class="ml-3 mb-2" id="vw-checkout-Participants-msg">* Required</div>
					<!--
					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text">Room</span>
						</div>
						<select class="custom-select" id="vw-checkout-Room" disabled>
							
						</select>
					</div>
					-->
					<!--
					<div class="row mb-2">
						<div class="col-md-6">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fa fa-calendar-alt fa-fw"></i> From</span>
								</div>
								<input type="text" class="form-control" id="vw-checkin-Datestart" disabled>
							</div>
							<div id="vw-checkin-Datestart-msg" class="ml-3 mt-2">* Required</div>
						</div>
						<div class="col-md-6">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fa fa-clock fa-fw"></i> From</span>
								</div>
								<input type="text" class="form-control" id="vw-checkin-Timestart" disabled>
							</div>	
							<div id="vw-checkin-Timestart-msg" class="ml-3 mt-2">* Required</div>
						</div>
					</div>

					<div class="row mb-2">
						<div class="col-md-6">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fa fa-calendar-alt fa-fw"></i> To</span>
								</div>
								<input type="text" class="form-control" id="vw-checkin-Dateend" disabled>
							</div>
							<div id="vw-checkin-Dateend-msg" class="ml-3 mt-2">* Required</div>
						</div>
						<div class="col-md-6">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fa fa-clock fa-fw"></i> To</span>
								</div>
								<input type="text" class="form-control" id="vw-checkin-Timeend" disabled>
							</div>
							<div id="vw-checkin-Timeend-msg" class="ml-3 mt-2">* Required</div>
						</div>
					</div>	
				-->
			
					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-pencil-alt fa-fw"></i> Nature of Activity</span>
						</div>	
						<input type="text" class="form-control" id="vw-checkout-Nature" disabled maxlength="50" placeholder="Nature" >
					</div>
					<div id="vw-checkout-Nature-msg" class="ml-3 mt-2">* Required</div>
					
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
						<input type="text" class="form-control col-md-12" id="vw-checkout-ReservedBy" disabled maxlength="100" placeholder="Name">
					</div>
					<div id="vw-checkout-ReservedBy-msg" class="ml-3 mb-2">* Required</div>

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-address-card fa-fw"></i> Address</span>
						</div>
						<input type="text" class="form-control col-md-12" id="vw-checkout-ReservedByAddress" placeholder="Address" disabled maxlength="100">
					</div>
			
					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-mobile-alt fa-fw"></i> Mobile </span>
						</div>
						<input type="text" class="form-control col-md-12" id="vw-checkout-ReservedByMobile" placeholder="Mobile"  disabled maxlength="30">
					</div>
					<div id="vw-checkout-ReservedByMobile-msg" class="ml-3 mb-2">* Required</div>

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-envelope fa-fw"></i> Email</span>
						</div>
						<input type="text" class="form-control col-md-12" id="vw-checkout-ReservedByEmail" placeholder="Email Address" disabled maxlength="50">
					</div>

				</div>
				<div class="modal-footer">							
					<button class="btn btn-success mr-auto edit" id="vw-checkout-edit-btn" style="width: 100%;"><i class="fa fa-edit"></i> Edit</button>
				</div>
			</form>
		</div>
	</div>
</div><!-- End Create Review Schedule -->