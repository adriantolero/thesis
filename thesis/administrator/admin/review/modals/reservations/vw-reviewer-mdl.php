<!-- Create Schedule Modal -->
<div class="modal fade" id="viewReviewer-modal" data-id tabindex="-1" role="dialog" aria-labelledby="View Reviewer" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content bg-dark text-white">
			<form>
				<div class="modal-header">
					<h3 class="modal-title">
						<i class="fa fa-search"></i> View Reviewee
					</h3>
					<button type="button" id="close-viewReviewer-modal" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					
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
						<input type="text" id="vw-fname" class="form-control col-md-4" placeholder="First name" disabled maxlength="50">
						<input type="text" id="vw-mi" class="form-control col-md-2" placeholder="M.I" maxlength="2" disabled>
						<input type="text" id="vw-lname" class="form-control col-md-4" placeholder="Last name" disabled maxlength="50">
					</div>
					<div id="vw-name-msg" class="mt-1"></div>

					<div class="input-group mt-2">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-calendar-alt fa-fw"></i> Birth date</span>
						</div>
						<input type="text" id="vw-bdate" class="form-control col-md-5" maxlength="50" disabled placeholder="Birth date">
					</div>
					<div id="vw-bdate-msg" class="mt-1"></div>

					<div class="input-group mt-2">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-address-book fa-fw"></i> Address</span>
						</div>
						<input type="text" id="vw-address" placeholder="Address" class="form-control" maxlength="100" disabled>
					</div>
					<div id="vw-address-msg" class="mt-1"></div>

					<div class="input-group mt-2">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-mobile-alt fa-fw"></i> Contact no.</span>
						</div>
						<input type="text" id="vw-contact" placeholder="Mobile" class="form-control col-md-4" maxlength="30" disabled>
					</div>
					<div id="vw-contact-msg" class="mt-1"></div>

					<div class="input-group mt-2">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-envelope fa-fw"></i> Email Address</span>
						</div>
						<input type="text" id="vw-email" placeholder="Email Address" class="form-control" maxlength="50" disabled>
					</div>
					<div id="vw-email-msg" class="mt-1"></div>

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
						<select id="vw-school" class="form-control col-md-8" disabled>
						
						</select>
						<div class="input-group-append">
							<button type="button" class="btn btn-success" id="viewSchool-mdl" data-toggle="modal" data-target="#view-addSchool-modal" disabled><i class="fa fa-plus-circle"></i></button>
						</div>
					</div>
					<div id="vw-school-msg" class="mt-1"></div>

					<div class="input-group mt-2">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-graduation-cap fa-fw"></i> Course</span>
						</div>
						<select id="vw-course" class="form-control col-md-6" disabled>
							
						</select>
						<div class="input-group-append">
							<button type="button" class="btn btn-success" id="viewCourse-mdl" data-toggle="modal" data-target="#view-addCourse-modal" disabled><i class="fa fa-plus-circle"></i></button>
						</div>
					</div>
					<div id="vw-course-msg" class="mt-1"></div>

					
					<div class="input-group mt-2">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-graduation-cap fa-fw"></i> Major</span>
						</div>
						<select id="vw-major" class="form-control col-md-6" disabled>
							<!--<option value="0"></option>-->
						</select>
						<div class="input-group-append">
							<button type="button" class="btn btn-success" id="viewMajor-mdl" disabled><i class="fa fa-plus-circle"></i></button>
						</div>
					</div>
					<div id="vw-major-msg" class="mt-1"></div>
					

					<div class="input-group mt-2">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-graduation-cap fa-fw"></i> Year grad.</span>
						</div>
						<input type="text" id="vw-yrGrad" class="form-control col-md-5" disabled maxlength="5" placeholder="Year Grad">
					</div>
					<div id="vw-yrGrad-msg" class="mt-1"></div>

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
							<span class="input-group-text"><i class="fa fa-bed fa-fw"></i>Lodging</span>
						</div>
						<select id="vw-lodge" class="form-control col-md-4" disabled>
							<option value="0">No</option>
							<option value="1">Yes</option>
						</select>
					</div>
					
				</div>
				<div class="modal-footer">							
					<button class="btn btn-success mr-auto edit" id="editReviewer" data-id style="width: 100%;"><i class="fa fa-edit"></i> Edit</button>
				</div>
			</form>
		</div>
	</div>
</div><!-- End Create Review Schedule -->