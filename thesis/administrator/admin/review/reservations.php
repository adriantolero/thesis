<!DOCTYPE html>
<html>
<head>
	<title>Administrator</title>
	<!-- bootstrap v4 -->
	<script type="text/javascript" src="../../lib/bootstrap4/js/jquery-3.2.1.min.js"></script>

	<link rel="stylesheet" type="text/css" href="../../lib/bootstrap4/css/bootstrap.min.css">	

   	<link rel="stylesheet" type="text/css" href="../../lib/fontawesome-free-5.0.6/web-fonts-with-css/css/fontawesome-all.min.css">

   	<link rel="stylesheet" href="../../lib/sidebar/css/jquery.mCustomScrollbar.min.css">

   	<script src="../../lib/sidebar/js/jquery.mCustomScrollbar.concat.min.js.download"></script>

   	<script type="text/javascript" src="../../lib/bootstrap4/js/popper.min.js"></script>

   	<script type="text/javascript" src="../../lib/bootstrap4/js/bootstrap.min.js"></script>

   	<link rel="stylesheet" type="text/css" href="../../lib/datetimepicker/jquery.datetimepicker.min.css">

   	<script type="text/javascript" src="../../lib/datetimepicker/jquery.datetimepicker.full.min.js"></script>

	<link rel="stylesheet" type="text/css" href="../../css/sidebar.css">

	<link rel="stylesheet" type="text/css" href="../../css/review_reservations.css">

	<script type="text/javascript" src="../../scripts/modal.js"></script>
	<!--<link rel="stylesheet" type="text/css" href="../../css/schedule/default.css">-->

	<?php
		
		session_start();
		if(!isset($_SESSION['username'])){
			header("Location: ../../");
			//echo "Session not found";
		}

		else{
			
			include "../../CRUD/crud.php";

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
			
			<a href="../index.php" class="navbar-brand ml-4" id="expand-title" class="text-white"><img src="../../images/vsu-logo(100).png" style="height: 70px;width: 70px;" />Center for Continuing Education Records Management System</a>
			<a href="../index.php" class="navbar-brand"  id="mini-title" data-original-title="Center for Continuing Education Records Management System" rel="tooltip"><strong class="text-white"><img src="../../images/vsu-logo(100).png" style="height: 70px;width: 70px;" />CCERMS</strong></a>

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
           		<img src="../../images/admin2.png" class="rounded-circle ml-2" id="myProfilepic">
           		<div id="welcome">
	           		<div id="myName"><h5 style="display: inline;"><?php echo utf8_encode($name); ?></h5>
	           			<input type="text" id="myID" style="display: none" value=<?php echo $id ?>>
	           		</div>
	           		<div id="btn-profile-wrapper">
	           			<a href="../profile.php" class="btn btn-info btn-sm">Profile</a>
	           		</div>
	           	</div>
           	</div>

           	<!-- Sidebar Links -->
           	<ul class="list-unstyled components">
           		<li><a href="../"><i class="fa fa-home"></i> Home</a></li>
           		<?php 
           			if($_SESSION["username"]=="admin"){
           				echo '<li><a href="../accounts/accounts.php"><i class="fa fa-cog"></i> Manage Accounts</a></li>';
           			}
           		?>
           		<li class="active">
           			<a href="#" data-toggle="collapse" data-target="#review-collapse">
           				<i class="fa fa-book fa-fw"></i>Review
           			</a>
           			<ul class="collapse show" id="review-collapse">
           				<li class="list-unstyled components">
           					<a href="schedule.php"><span class="ml-2"><i class="fa fa-calendar-alt fa-fw"></i>Schedule</span></a>
           				</li>
           				<li class="list-unstyled components">
           					<a href="#"><span class="ml-2"><i class="fa fa-users fa-fw"></i>Reservations</span></a>
           				</li>
           				<li class="list-unstyled components">
           					<a href="billing.php"><span class="ml-2"><i class="fa fa-clipboard fa-fw"></i>Billing</span></a>
           				</li>
           				<li class="list-unstyled components">
           					<a href="reports.php"><span class="ml-2"><i class="fa fa-chart-bar fa-fw"></i>Reports</span></a>
           				</li>
           				<li class="list-unstyled components">
           					<a href="#" data-toggle="collapse" data-target="#review-manage-collapse"><span class="ml-2"><i class="fa fa-cogs fa-fw"></i> Manage</span></a>
           					<ul class="collapse" id="review-manage-collapse">
           						<li class="list-unstyled components">
           							<a href="manage/school.php"><span class="ml-4"><i class="fa fa-university fa-fw"></i>School</span></a>
           						</li>
           						<li class="list-unstyled components">
           							<a href="manage/course.php"><span class="ml-4"><i class="fa fa-graduation-cap fa-fw"></i>Course & Major</span></a>
           						</li>
           					</ul>
           				</li>
           			</ul>
           		</li>
           		<li>
           			<a href="#" data-toggle="collapse" data-target="#venue-collapse">
           				<i class="fa fa-clipboard fa-fw"></i>Venue
           			</a>
           			<ul class="collapse" id="venue-collapse">
           				<li class="list-unstyled components">
           					<a href="../venue/schedule.php"><span class="ml-2"><i class="fa fa-calendar-alt fa-fw"></i>Schedule</span></a>
           				</li>
           				<li class="list-unstyled components">
           					<a href="../venue/reports.php"><span class="ml-2"><i class="fa fa-chart-bar fa-fw"></i>Reports</span></a>
           				</li>
           				<li class="list-unstyled components">
           					<a href="#" data-toggle="collapse" data-target="#venue-manage-collapse"><span class="ml-2"><i class="fa fa-cogs fa-fw"></i> Manage</span></a>
           					<ul class="collapse" id="venue-manage-collapse">
           						<li class="list-unstyled components">
           							<a href="../venue/manage/rates.php"><span class="ml-4"><i class="fa fa-money-bill-alt fa-fw"></i>Rates</span></a>
           						</li>
           					</ul>
           				</li>
           			</ul>
           		</li>
           	</ul>
		</nav>

		<!-- Main Content -->
		<div class="container-fluid" id="content">		
		
			<div class="row" style="margin-top: 50px;">
				<div class="col-md-4" id="reservedRevSched-wrapper">
					<div class="row">
						<div class="col-md-12">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">Search</span>
								</div>
								<input type="text" id="reserved_search_sched" class="form-control" placeholder="Description">
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
									<table class="table table-hover table-bordered" id="table-approved">
										<thead>
											<tr class="bg-secondary text-white">
												<th style="width: 50%"><center>Name</center></th>
												<!--<th><center>Status</center></th>-->
												<th colspan="2"><center>Action</center></th>
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

		</div><!-- Main content -->

		<?php
			
			//Create Reservation
			include "modals/reservations/create-reviewer-mdl.php";
			include "modals/reservations/create-school-mdl.php";
			include "modals/reservations/create-course-mdl.php";
			include "modals/reservations/create-major-mdl.php";

			//Create Request
			include "modals/reservations/create-request-mdl.php";
			include "modals/reservations/request-create-school-mdl.php";
			include "modals/reservations/request-create-course-mdl.php";
			include "modals/reservations/request-create-major-mdl.php";

			include "modals/reservations/vw-requests-mdl.php";
			include "modals/reservations/vw-request-info-mdl.php";
			include "modals/reservations/vw-reviewer-mdl.php";
			include "modals/reservations/vw-rej-requests-mdl.php";
			
			include "modals/reservations/vw-removed-mdl.php";
			include "modals/reservations/vw-removed-info-mdl.php";

			//view reserved
			include "modals/reservations/vw-create-school-mdl.php";
			include "modals/reservations/vw-create-course-mdl.php";
			include "modals/reservations/vw-create-major-mdl.php";

		?>		
		<div class="overlay">

		</div>
	</div><!-- wrapper -->
</body>	

</html>

<script type="text/javascript" src="../../scripts/review_reservations.js"></script>
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
	            url: "../../controller/subQueries.php",
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
