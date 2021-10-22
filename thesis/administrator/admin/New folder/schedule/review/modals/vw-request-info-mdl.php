<!-- Create Schedule Modal -->
<div class="modal fade" id="viewRequestInfo-modal" tabindex="-1" role="dialog" aria-labelledby="View Reviewer" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content bg-dark text-white">
			<div class="modal-header">
				<h3 class="modal-title">
					Request Info <i class="fa fa-info-circle"></i>
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
							<span class="input-group-text">Name</span>
						</div>
						<input type="text" id="vw-request-fname" class="form-control col-md-4" placeholder="First name" disabled>
						<input type="text" id="vw-request-mi" class="form-control col-md-2" placeholder="M.I" maxlength="2" disabled>
						<input type="text" id="vw-request-lname" class="form-control col-md-4" placeholder="Last name" disabled>
					</div>
					<div class="input-group mt-2">
						<div class="input-group-prepend">
							<span class="input-group-text">Birth date</span>
						</div>
						<input type="text" id="vw-request-bdate" class="form-control col-md-5" disabled>
					</div>
					<div class="input-group mt-2">
						<div class="input-group-prepend">
							<span class="input-group-text">Address</span>
						</div>
						<input type="text" id="vw-request-address" class="form-control" disabled>
					</div>
					<div class="input-group mt-2">
						<div class="input-group-prepend">
							<span class="input-group-text">Contact no.</span>
						</div>
						<input type="text" id="vw-request-contact" class="form-control col-md-4" disabled>
					</div>
					<div class="input-group mt-2">
						<div class="input-group-prepend">
							<span class="input-group-text">Email Address</span>
						</div>
						<input type="text" id="vw-request-email" class="form-control" disabled>
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
							<span class="input-group-text">School</span>
						</div>
						<select id="vw-request-school" class="form-control col-md-8" disabled>
						
						</select>
					</div>
					<div class="input-group mt-2">
						<div class="input-group-prepend">
							<span class="input-group-text">Course</span>
						</div>
						<select id="vw-request-course" class="form-control col-md-6" disabled>
							
						</select>
					</div>
					<div class="collapse show" id="vw-collapseMajor">
						<div class="input-group mt-2">
							<div class="input-group-prepend">
								<span class="input-group-text">Major</span>
							</div>
							<select id="vw-request-major" class="form-control col-md-6" disabled>
								<!--<option value="0"></option>-->
							</select>
						</div>
					</div>
					<div class="input-group mt-2">
						<div class="input-group-prepend">
							<span class="input-group-text">Year grad.</span>
						</div>
						<input type="text" id="vw-request-yrGrad" class="form-control col-md-5" disabled>
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
							<span class="input-group-text">Lodging</span>
						</div>
						<select id="vw-request-lodge" class="form-control col-md-4" disabled>
							<option value="0">No</option>
							<option value="1">Yes</option>
						</select>
					</div>
				</form>
			</div>
		</div>
	</div>
</div><!-- End Create Review Schedule -->