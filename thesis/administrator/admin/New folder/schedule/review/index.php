<!DOCTYPE html>
<html>
<head>
	<title>Administrator</title>
	<!-- bootstrap v4 -->
	<script type="text/javascript" src="../../../lib/bootstrap4/js/jquery-3.2.1.min.js"></script>

	<link rel="stylesheet" type="text/css" href="../../../lib/bootstrap4/css/bootstrap.min.css">	

   	<link rel="stylesheet" type="text/css" href="../../../lib/fontawesome-free-5.0.6/web-fonts-with-css/css/fontawesome-all.min.css">

   	<link rel="stylesheet" href="../../../lib/sidebar/css/jquery.mCustomScrollbar.min.css">

   	<script src="../../../lib/sidebar/js/jquery.mCustomScrollbar.concat.min.js.download"></script>

   	<script type="text/javascript" src="../../../lib/bootstrap4/js/popper.min.js"></script>

   	<script type="text/javascript" src="../../../lib/bootstrap4/js/bootstrap.min.js"></script>

   	<link rel="stylesheet" type="text/css" href="../../../lib/datetimepicker/jquery.datetimepicker.min.css">

   	<script type="text/javascript" src="../../../lib/datetimepicker/jquery.datetimepicker.full.min.js"></script>

	<link rel="stylesheet" type="text/css" href="../../../css/sidebar.css">

	<link rel="stylesheet" type="text/css" href="../../../css/schedule.css">

	<script type="text/javascript" src="../../../scripts/modal.js"></script>
	<!--<link rel="stylesheet" type="text/css" href="../../css/schedule/default.css">-->

	<?php
		
		session_start();
		if(!isset($_SESSION['username'])){
			header("Location: ../../../");
			//echo "Session not found";
		}

		else{
			
			include "../../../CRUD/crud.php";

			$crud = new CRUD();
			$id = $_SESSION["id"];
			$name = $_SESSION["name"];
			
		}
	?>

</head>

<body>
	<div class="wrapper">
		<nav class="navbar navbar-expand-md navbar-dark bg-dark" id="navbar-top">
			<button id="sidebarCollapse" class="btn btn-success"  type="button"><i class="fa fa-bars"></i> <span id="hideToggle">Menu</span></button>
			
			<a href="#" class="navbar-brand ml-4" id="expand-title" class="text-white">Center for Continuing Education Records Management System</a>
			<a href="#" class="navbar-brand"  id="mini-title" data-original-title="Center for Continuing Education Records Management System" rel="tooltip"><strong class="text-white">CCERMS</strong></a>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
			<div class="collapse navbar-collapse" id="navbar-collapse">
				<form class="form-inline ml-auto">
				    <button class="btn btn-danger" type="button" id="logout-btn">Logout <i class="fa fa-sign-out-alt"></i></button>
				</form>
			</div>
		</nav>

		<nav id="sidebar">
			<!-- Close Sidebar button -->
			<div id="dismiss">
            	<i class="fa fa-arrow-left"></i>
            </div> 

            <!-- Sidebar Header -->
           	<div class="sidebar-header">
           		<h3>Center for Continuing Education</h3>
           	</div>

           	<div class="myProfile">
           		<img src="../../../images/admin2.png" class="rounded-circle ml-2" id="myProfilepic">
           		<div id="welcome">
	           		<div id="myName"><h5 style="display: inline;"><?php echo $name; ?></h5>
	           			<input type="text" id="myID" style="display: none" value=<?php echo $id ?>>
	           		</div>
	           		<div id="btn-profile-wrapper">
	           			<a href="#" class="btn btn-info btn-sm">Profile</a>
	           		</div>
	           	</div>
           	</div>

           	<!-- Sidebar Links -->
           	<ul class="list-unstyled components">
           		<li><a href="../../"><i class="fa fa-home"></i> Home</a></li>
           		<li><a href="#"><i class="fa fa-cog"></i> Manage Accounts</a></li>
           		<li class="active"><a href="#" data-toggle="collapse" data-target="#schedule-collapse"><i class="fa fa-calendar-alt"></i> Schedule</a>
           			<ul class="collapse" id="schedule-collapse">
           				<li class="list-unstyled components"><a href="#"> Review Schedule</a></li>
           				<li class="list-unstyled components"><a href="../function/">Venue Schedule</a></li>
           			</ul>
           		</li>
           		<li><a href="#" data-toggle="collapse" data-target="#billing-collapse"><i class="fa fa-clipboard"></i> Billing</a>
           			<ul class="collapse" id="billing-collapse">
           				<li class="list-unstyled components"><a href="../../billing/review/">Review</a></li>
           				<li class="list-unstyled components"><a href="../../billing/function/"> Venue</a></li>
           			</ul>
           		</li>
           		<li><a href="#" data-toggle="collapse" data-target="#reports-collapse"><i class="fa fa-bar-chart"></i> Reports</a>
           			<ul class="collapse" id="reports-collapse">
           				<li class="list-unstyled components"><a href="../../reports/review/">Review</a></li>
           				<li class="list-unstyled components"><a href="#"> Function</a></li>
           				</li>
           			</ul>
           		</li>
           	</ul>
		</nav>

		<!-- Main Content -->
		<div class="container-fluid" id="content">		
		
			<!-- Tab wrapper -->
			<div class="row">
				<div class="col-md-12">

					<div class="nav nav-tabs mt-2" id="nav-tab" role="tablist">	
						<a href="#v-pills-review-sched" class="nav-link active" data-toggle="pill" id="v-pills-review-sched-tab" role="tab" aria-controls="v-pills-review-sched" aria-selected="false">Review Schedule</a>
						<a href="#v-pills-reserved" class="nav-link" data-toggle="pill" id="v-pills-reserved-tab" role="tab" aria-controls="v-pills-reserved" aria-selected="false">Reservation</a>	
					</div>
			
					<div class="tab-content mt-3" id="v-pills-tabContent">

						<!-- Search Schedule form -->
						<div class="tab-pane fade show active" id="v-pills-review-sched" role="tabpanel" arialabelledby="v-pills-review-sched-tab">
							<form id="searchForm">
								<div class="form-group row">
									<label for="searchInput" class="col-md-1 col-form-label">Search</label>
									<div class="col-md-3">
										<input type="text" id="searchInput" class="form-control" placeholder="Description">
									</div>

									<label for="roomOption" class="col-md-1 col-form-label">Room</label>
									<div class="col-md-2">
										<select id="roomOption" class="form-control">
											<option value=""></option>
											<?php
												$crud->getRoom();
											?>
										</select>
									</div>

									<label for="searchDate" class="col-md-1 col-form-label">Year</label>
									<div class="col-md-2">
										<input type="text" id="searchDate" class="form-control" placeholder="Year">
									</div>
								</div>
							</form>

							<!-- Schedule Table -->
							<div class="row">
								<div class="col-md-12" style="height: 300px;overflow-x: auto;overflow-y: auto;">
									<table class="table table-hover" id="tableSchedule">
										<thead class="thead-primary">
											<tr class="bg-dark text-white">
												<th style="width: 10%">Room</th>
												<th style="width: 20%">Description</th>
												<th style="width: 15%">Date Start</th>
												<th style="width: 10%">Time Start</th>
												<th style="width: 15%">Date End</th>
												<th style="width: 10%">Time End</th>
												<th colspan="3"><center>Actions</center></th>
												<!--<th ><center>Edit</center></th>
												<th ><center>Delete</center></th>-->
											</tr>	
										</thead>
										<tbody id="dataSchedule">
											<!-- Data here  -->
										</tbody>
										
									</table>
								</div>
							</div><!-- row table -->
							<div class="row">
								<div class="col-md-4 offset-md-4" id="btn-wrapper">
									<button class="btn btn-success" id="open-addReview-modal" data-toggle="modal" data-target="#addReview-modal"><i class="fa fa-calendar-plus"></i> Book Review</button>
								</div>
							</div>
						</div><!-- end v-pills-home -->

						<!-- v-pills-function-sched -->
						<div class="tab-pane fade" id="v-pills-reserved" role="tabpanel" arialabelledby="v-pills-reseved-tab">
							<div class="row">
								<div class="col-md-4" id="reservedRevSched-wrapper">
									<div class="row">
										<div class="col-md-10">
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text">Search Year</span>
												</div>
												<input type="text" id="reserved_search_sched" class="form-control" placeholder="Year">
												<div class="input-group-append">
													<button class="btn btn-success" id="reserved_search_sched-btn"><i class="fa fa-search"></i></button>
												</div>
											</div>
										</div>
									</div>
									<div class="row mt-3">
										<div class="col-md-12">
											<select id="reservedRevSched" size="10" style="width: 100%;">
												<?php
													//$crud->fillReservedSched();
												?>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-8" id="approved-wrapper" data-id>
									<div class="card">
										<div class="card-header bg-dark text-white">
											<h3 class="card-title">Review title: <span id="review-title"></span></h3>
											<p class="card-subtitle">Slot(s) remaining: <span id="slots-remaining"></span></p>
										</div>
										<div class="card-body">
											<div class="row">
												<div class="col-md-12" id="reservedApproved-wrapper">
													<form>
														<div class="input-group">
															<div class="input-group-prepend">
																<span class="input-group-text">Search by</span>
															</div>
															<select class="custom-select col-md-3" id="searchApprovedBy" style="border-top-right-radius: 5px;border-bottom-right-radius: 5px;">
																	<option value="1">Last name</option>
																	<option value="2">First name</option>
															</select>
							
															<input type="text" id="searchApproved" class="col-md-6 form-control ml-3" placeholder="Last Name" disabled   style="border-top-left-radius: 5px;border-bottom-left-radius: 5px;">
															<div class="input-group-append">
																<button class="btn btn-success" id="searchApproved-btn"><i class="fa fa-search"></i></button>
															</div>
														</div>
													</form>
												</div>
											</div>
											<div class="row mt-3">
												<div class="col-md-12" style="max-height: 350px;overflow-y: auto;">
													<table class="table table-hover" id="table-approved">
														<thead>
															<tr class="bg-secondary text-white">
																<th style="width: 50%"><center>Name</center></th>
																<th><center>Status</center></th>
																<th colspan="3"><center>Action</center></th>
															</tr>
														</thead>
														<tbody id="approved-data">
															<!--<tr class="bg-danger text-white">
																<td colspan="3"><center><h3>List is empty</h3></center></td>
															</tr>-->
														</tbody>
													</table>
												</div><!-- col -->
											</div><!-- row -->
											<div class="row">
												<div class="col-md-12">
													<div id="btn-wrapper">
														<button class="btn btn-success" id="create_requests" data-toggle="modal" data-target="#addReviewer-modal"><i class="fa fa-user-plus"></i> Add</button>
														<button class="btn btn-success" id="vw_requests" data-toggle="modal" data-target="#vw-requests-modal"><i class="fa fa-users"></i> View Requests</button>
														<button class="btn btn-success" id="vw_removed" data-toggle="modal" data-target="#vw-removed-modal"><i class="fa fa-user-times"></i> View Removed</button>
													</div>
												</div>	
											</div>
										</div><!-- card-body -->
									</div><!-- card-->
								</div>
							</div><!-- row -->
						</div><!-- end v-pills-reserved -->

					</div><!-- Tab-content -->

				</div><!-- col-md-12 -->

			</div><!-- Tab wrapper -->

		</div><!-- Main content -->

		<?php
			include "modals/create-review-mdl.php";
			include "modals/view-review-mdl.php";
			//include "../modals/edit-review-mdl.php";
			include "modals/vw-requests-mdl.php";
			include "modals/vw-request-info-mdl.php";
			include "modals/create-reviewer-mdl.php";
			include "modals/create-school-mdl.php";
			include "modals/create-course-mdl.php";
			include "modals/create-major-mdl.php";
			include "modals/vw-reviewer-mdl.php";
			include "modals/vw-rej-requests-mdl.php";
			include "modals/create-request-mdl.php";
			include "modals/vw-removed-mdl.php";
		?>		
		<div class="overlay">

		</div>
	</div><!-- wrapper -->
</body>	

</html>

<script type="text/javascript" src="../../../scripts/review.js"></script>
<script>
	$(document).ready(function(){
		//tooltip
	 	$("[rel='tooltip']").tooltip();

	 	/*******************************
					SIDEBAR
	 	*******************************/
	    $("#sidebar").mCustomScrollbar({
	    	theme: "minimal"
	    });

	    // when opening the sidebar
	    $('#sidebarCollapse').click(function () {
	        // open sidebar
	        $('#sidebar').addClass('active');
	        // fade in the overlay
	        $('.overlay').fadeIn();
	        $('.collapse.in').toggleClass('in');
	        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
	    });

	    // if dismiss or overlay was clicked
	    $('#dismiss, .overlay').on('click', function () {
	      // hide the sidebar
	      $('#sidebar').removeClass('active');
	      // fade out the overlay
	      $('.overlay').fadeOut();
	    });

	    /*********************************
					LOGOUT
	    **********************************/
		$("#logout-btn").click(function(){
	        $.ajax({
	            type: "POST",
	            url: "../../../controller/subQueries.php",
	            data: {function: "logout"},
	            success: function(data){
	                if(data==true){     
	                    window.location.href = "../../index.php";
	                }
	                else{
	                	console.log(data);
	                }
	            },
	            error: function(data){
	                alert(data);
	            }
	        });
	    });
	});
</script>
