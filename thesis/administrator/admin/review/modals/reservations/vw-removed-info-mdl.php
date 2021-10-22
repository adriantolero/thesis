<!-- Create Schedule Modal -->
<div class="modal fade" id="viewRemovedInfo-modal" tabindex="-1" role="dialog" aria-labelledby="View Reviewer" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content bg-dark text-white">
			<div class="modal-header">
				<h3 class="modal-title">
					Removed Info <i class="fa fa-info-circle"></i>
				</h3>
				<button type="button" id="close-viewRequestInfo-modal" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
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
							<center><i class="fa fa-info-circle"></i> Personal Info.</center>
						</div>
						<div class="column">
							<div style="height: 1px;width: 100%;margin-top: 10px;background-color: white;"></div>
						</div>
					</div>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-pencil-alt fa-fw"></i> Name</span>
						</div>
						<input type="text" id="vw-removed-fname" class="form-control col-md-4" placeholder="First name" disabled>
						<input type="text" id="vw-removed-mi" class="form-control col-md-2" placeholder="M.I" maxlength="2" disabled>
						<input type="text" id="vw-removed-lname" class="form-control col-md-4" placeholder="Last name" disabled>
					</div>
					<div class="input-group mt-2">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-calendar-alt fa-fw"></i> Birth date</span>
						</div>
						<input type="text" id="vw-removed-bdate" class="form-control col-md-5" disabled>
					</div>
					<div class="input-group mt-2">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-address-book fa-fw"></i> Address</span>
						</div>
						<input type="text" id="vw-removed-address" class="form-control" disabled>
					</div>
					<div class="input-group mt-2">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-mobile-alt fa-fw"></i> Contact no.</span>
						</div>
						<input type="text" id="vw-removed-contact" class="form-control col-md-4" disabled>
					</div>
					<div class="input-group mt-2">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-envelope fa-fw"></i> Email Address</span>
						</div>
						<input type="text" id="vw-removed-email" class="form-control" disabled>
					</div>
					<div class="row">
						<div class="column">
							<div style="height: 1px;width: 100%;margin-top: 10px;background-color: white;"></div>
						</div>
						<div class="column">
							<center><i class="fa fa-university"></i> School attended</center>
						</div>
						<div class="column">
							<div style="height: 1px;width: 100%;margin-top: 10px;background-color: white;"></div>
						</div>
					</div>
					<div class="input-group mt-2">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-university fa-fw"></i> School</span>
						</div>
						<select id="vw-removed-school" class="form-control col-md-8" disabled>
						
						</select>
					</div>
					<div class="input-group mt-2">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-graduation-cap fa-fw"></i> Course</span>
						</div>
						<select id="vw-removed-course" class="form-control col-md-6" disabled>
							
						</select>
					</div>
					<div class="collapse show" id="vw-collapseMajor">
						<div class="input-group mt-2">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fa fa-graduation-cap fa-fw"></i> Major</span>
							</div>
							<select id="vw-removed-major" class="form-control col-md-6" disabled>
								<!--<option value="0"></option>-->
							</select>
						</div>
					</div>
					<div class="input-group mt-2">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-graduation-cap fa-fw"></i> Year grad.</span>
						</div>
						<input type="text" id="vw-removed-yrGrad" class="form-control col-md-5" disabled>
					</div>
					<div class="row">
						<div class="column">
							<div style="height: 1px;width: 100%;margin-top: 10px;background-color: white;"></div>
						</div>
						<div class="column">
							<center><i class="fa fa-bed"></i> Lodging</center>
						</div>
						<div class="column">
							<div style="height: 1px;width: 100%;margin-top: 10px;background-color: white;"></div>
						</div>
					</div>

					<div class="input-group mt-2">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-bed fa-fw"></i> Lodging</span>
						</div>
						<select id="vw-removed-lodge" class="form-control col-md-4" disabled>
							<option value="0">No</option>
							<option value="1">Yes</option>
						</select>
					</div>
				</form>
			</div>
		</div>
	</div>
</div><!-- End Create Review Schedule -->