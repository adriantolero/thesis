<!-- Create Schedule Modal -->
<div class="modal fade" id="joinReview-modal" data-id tabindex="-1" role="dialog" aria-labelledby="Add Schedule" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content bg-dark text-white">
			<div class="modal-header">
				<h3 class="modal-title">
					<i class="fa fa-pencil-alt"></i> Reservation Form
				</h3>
				<button type="button" id="close-addReviewer-modal" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<form id="reservationForm">
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
								<input type="text" id="fname" class="form-control col-md-4" placeholder="First name" maxlength="50">
								<input type="text" id="mi" class="form-control col-md-2" placeholder="M.I" maxlength="2">
								<input type="text" id="lname" class="form-control col-md-4" placeholder="Last name" maxlength="50">
							</div>
							<div class="mt-1 ml-3" id="create-name-msg"></div>

							<div class="input-group mt-2">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fa fa-calendar-alt fa-fw"></i> Birth date</span>
								</div>
								<input type="text" id="bdate" class="form-control col-md-5" maxlength="50" placeholder="Birth date">
							</div>
							<div id="create-bdate-msg" class="mt-1 ml-3"></div>

							<div class="input-group mt-2">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fa fa-address-book fa-fw"></i> Address</span>
								</div>
								<input type="text" id="address" class="form-control" maxlength="100" placeholder="Address">
							</div>
							<div id="create-address-msg" class="mt-1 ml-3"></div>

							<div class="input-group mt-2">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fa fa-mobile-alt fa-fw"></i> Contact no.</span>
								</div>
								<input type="text" id="contact" class="form-control col-md-4" maxlength="30" placeholder="Mobile">
							</div>
							<div id="create-contact-msg" class="mt-1 ml-3"></div>

							<div class="input-group mt-2">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fa fa-envelope fa-fw"></i> Email Address</span>
								</div>
								<input type="text" id="email" class="form-control" maxlength="50" placeholder="Email Address">
							</div>

							<div class="row">
								<div class="column">
									<div style="height: 1px;width: 100%;margin-top: 10px;background-color: white;"></div>
								</div>
								<div class="column">
									<center><i class="fa fa-info-circle"></i> School & Course</center>
								</div>
								<div class="column">
									<div style="height: 1px;width: 100%;margin-top: 10px;background-color: white;"></div>
								</div>
							</div>

							<div class="input-group mt-2">
								<div class="input-group-prepend">
									<span class="input-group-text">School</span>
								</div>
								<select class="custom-select" id="school">
									
								</select>
								<div class="input-group-append">
									<button type="button" class="btn btn-success" id="toggle-addSchool-modal"><i class="fa fa-plus-circle"></i></button>
								</div>
							</div>
							<div id="create-school-msg" class="mt-1 ml-3"></div>

							<div class="input-group mt-2">
								<div class="input-group-prepend">
									<span class="input-group-text">Course</span>
								</div>
								<select class="custom-select" id="course">
									
								</select>
								<div class="input-group-append">
									<button class="btn btn-success" id="toggle-addCourse-modal"><i class="fa fa-plus-circle"></i></button>
								</div>
							</div>
							<div id="create-course-msg" class="mt-1 ml-3"></div>

							<div class="input-group mt-2">
								<div class="input-group-prepend">
									<span class="input-group-text">Major</span>
								</div>
								<select class="custom-select" id="major">
									<option value=""></option>
								</select>
								<div class="input-group-append">
									<button class="btn btn-success" id="toggle-addMajor-modal"><i class="fa fa-plus-circle"></i></button>
								</div>
							</div>
							<div id="create-major-msg" class="mt-1 ml-3"></div>

							<div class="input-group mt-2">
								<div class="input-group-prepend">
									<span class="input-group-text">Year Grad.</span>
								</div>
								<input type="text" class="form-control" id="yrGrad" maxlength="5" placeholder="Year Grad">
							</div>
							<div id="create-yrGrad-msg" class="mt-1 ml-3"></div>
							
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
								<select id="lodge" class="form-control col-md-4">
									<option value="0">No</option>
									<option value="1">Yes</option>
								</select>
							</div>

							<div style="text-align: right;">							
								<button class="btn btn-success" id="previewForm"><i class="fa fa-save"></i> Done</button>	
							</div>
							
						</form>
					</div>
					<!--<div class="col-md-1">
					</div>-->
					<!--
					<div class="col-md-6" style="border-left: solid white 1px;height: 100%;">
						<div style="margin: auto;width: 70%;margin-top: 2em;">
							<h4>Please bring the following requirements:</h4>			
							<div class="mt-4">
								<ul>
									<li>One(1) piece 2 x 2 picture</li>
									<li>Reservation Fee: 500.00 Php</li>
								</ul>
							</div>
						</div>
					</div>
					-->
				</div><!-- row -->
				
				<!--
				<div class="nav nav-tabs mt-2" id="nav-tab" role="tablist">	
					<a href="#v-pills-reservation-form" class="nav-link active" data-toggle="pill" id="v-pills-reservation-form-tab" role="tab" aria-controls="v-pills-reservation-form" aria-selected="false">Form</a>

					<a href="#v-pills-requirements" class="nav-link" data-toggle="pill" id="v-pills-requirements-tab" role="tab" aria-controls="v-pills-requirements" aria-selected="false">Requirements</a>	
				</div>

				<div class="tab-content mt-3" id="v-pills-tabContent">
					<div class="tab-pane fade show active" id="v-pills-reservation-form" role="tabpanel" arialabelledby="v-pills-reservation-form-tab">

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
								<input type="text" id="fname" class="form-control col-md-4" placeholder="First name">
								<input type="text" id="mi" class="form-control col-md-2" placeholder="M.I" maxlength="2">
								<input type="text" id="lname" class="form-control col-md-4" placeholder="Last name">
							</div>
							<div id="create-name-msg" class="mt-1">* First name and last name are required.</div>

							<div class="input-group mt-2">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fa fa-calendar-alt fa-fw"></i> Birth date</span>
								</div>
								<input type="text" id="bdate" class="form-control col-md-5">
							</div>
							<div id="create-bdate-msg" class="mt-1"></div>

							<div class="input-group mt-2">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fa fa-address-book fa-fw"></i> Address</span>
								</div>
								<input type="text" id="address" class="form-control">
							</div>
							<div id="create-address-msg" class="mt-1"></div>

							<div class="input-group mt-2">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fa fa-mobile-alt fa-fw"></i> Contact no.</span>
								</div>
								<input type="text" id="contact" class="form-control col-md-4">
							</div>
							<div id="create-contact-msg" class="mt-1">* Contact no. is required.</div>

							<div class="input-group mt-2">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fa fa-envelope fa-fw"></i> Email Address</span>
								</div>
								<input type="text" id="email" class="form-control">
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
								<select id="lodge" class="form-control col-md-4">
									<option value="0">No</option>
									<option value="1">Yes</option>
								</select>
							</div>
						</form>

					</div><!-- Reservation form tab 

					<div class="tab-pane fade" id="v-pills-requirements" role="tabpanel" arialabelledby="v-pills-requirements-tab">
						<h3>Requirements</h3>
					</div>

				</div>Tab Content -->
				
			</div>
			<!--
			<div class="modal-footer">							
				<button class="btn btn-success mr-auto" id="addReviewer" style="width: 100%;"><i class="fa fa-plus-circle"></i> Add</button>
			</div>-->
		</div>
	</div>
</div><!-- End Create Review Schedule -->