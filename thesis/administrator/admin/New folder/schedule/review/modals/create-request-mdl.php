<!-- Create Schedule Modal -->
<div class="modal fade" id="addRequest-modal" data-id tabindex="-1" role="dialog" aria-labelledby="Add Request" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content bg-dark text-white">
			<div class="modal-header">
				<h3 class="modal-title">
					<i class="fa fa-user-plus"></i> Add Request
				</h3>
				<button type="button" id="close-addRequest-modal" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
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
						<input type="text" id="request-fname" class="form-control col-md-4" placeholder="First name">
						<input type="text" id="request-mi" class="form-control col-md-2" placeholder="M.I" maxlength="2">
						<input type="text" id="request-lname" class="form-control col-md-4" placeholder="Last name">
					</div>
					<div id="create-request-name-msg" class="mt-1"></div>

					<div class="input-group mt-2">
						<div class="input-group-prepend">
							<span class="input-group-text">Birth date</span>
						</div>
						<input type="text" id="request-bdate" class="form-control col-md-5">
					</div>
					<div id="create-request-bdate-msg" class="mt-1"></div>

					<div class="input-group mt-2">
						<div class="input-group-prepend">
							<span class="input-group-text">Address</span>
						</div>
						<input type="text" id="request-address" class="form-control">
					</div>
					<div id="create-request-address-msg" class="mt-1"></div>

					<div class="input-group mt-2">
						<div class="input-group-prepend">
							<span class="input-group-text">Contact no.</span>
						</div>
						<input type="text" id="request-contact" class="form-control col-md-4">
					</div>
					<div id="create-request-contact-msg" class="mt-1"></div>

					<div class="input-group mt-2">
						<div class="input-group-prepend">
							<span class="input-group-text">Email Address</span>
						</div>
						<input type="text" id="request-email" class="form-control">
					</div>
					<div id="create-request-email-msg" class="mt-1"></div>

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
						<select id="request-school" class="form-control col-md-8">
						
						</select>
						<div class="input-group-append">
							<button type="button" class="btn btn-success" id="addSchool-mdl" data-toggle="modal" data-target="#addSchool-modal"><i class="fa fa-plus-circle"></i></button>
						</div>
					</div>
					<div id="create-request-school-msg" class="mt-1"></div>

					<div class="input-group mt-2">
						<div class="input-group-prepend">
							<span class="input-group-text">Course</span>
						</div>
						<select id="request-course" class="form-control col-md-6">
							
						</select>
						<div class="input-group-append">
							<button type="button" class="btn btn-success" id="addCourse-mdl" data-toggle="modal" data-target="#addCourse-modal"><i class="fa fa-plus-circle"></i></button>
						</div>
					</div>
					<div id="create-request-course-msg" class="mt-1"></div>

					<div class="collapse" id="request-collapseMajor">
						<div class="input-group mt-2">
							<div class="input-group-prepend">
								<span class="input-group-text">Major</span>
							</div>
							<select id="request-major" class="form-control col-md-6">
								<!--<option value="0"></option>-->
							</select>
							<div class="input-group-append">
								<button type="button" class="btn btn-success" id="addMajor-mdl" data-toggle="modal" data-target="#addMajor-modal"><i class="fa fa-plus-circle"></i></button>
							</div>
						</div>
						<div id="create-request-major-msg" class="mt-1"></div>
					</div>

					<div class="input-group mt-2">
						<div class="input-group-prepend">
							<span class="input-group-text">Year grad.</span>
						</div>
						<input type="text" id="request-yrGrad" class="form-control col-md-5">
					</div>
					<div id="create-request-yrGrad-msg" class="mt-1"></div>

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
						<select id="request-lodge" class="form-control col-md-4">
							<option value="0">No</option>
							<option value="1">Yes</option>
						</select>
					</div>
				</form>
			</div>
			<div class="modal-footer">							
				<button class="btn btn-success mr-auto" id="addRequest" style="width: 100%;"><i class="fa fa-plus-circle"></i> Add</button>
			</div>
		</div>
	</div>
</div><!-- End Create Review Schedule -->