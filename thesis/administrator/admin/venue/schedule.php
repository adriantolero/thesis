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

	<link rel="stylesheet" type="text/css" href="../../css/function_schedule.css">

	<script type="text/javascript" src="../../scripts/modal.js"></script>
	<!--<link rel="stylesheet" type="text/css" href="../../css/schedule/default.css">-->

	<?php
		
		session_start();
		if(!isset($_SESSION['username'])){
			header("Location: ../../");
			//echo "Session not found";
		}

		else{
			//echo "Session " . $_SESSION["username"] . "found";
			//include_once '../../config/dbConfig.php';
			/*include "../../../CRUD/crud.php";

			$crud = new CRUD();
			$id = $_SESSION["id"];
			$name = $crud->getAdmin_name($_SESSION["id"]);
			*/
			$id= $_SESSION["id"];
			$name = $_SESSION["name"];
		}
		/*
		session_start();
		if(!isset($_SESSION['username'])){
			header("Location: ../..");
		}

		include "../../php/connect.php";
		$id = $_SESSION['id'];
		$name = "";
		$sql = "SELECT * FROM `employee` WHERE `i_emp_id` = '$id'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$name = $row['str_e_fname'];
			}
		}
		*/
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
           		<li>
           			<a href="#" data-toggle="collapse" data-target="#review-collapse">
           				<i class="fa fa-book fa-fw"></i>Review
           			</a>
           			<ul class="collapse" id="review-collapse">
           				<li class="list-unstyled components">
           					<a href="../review/schedule.php"><span class="ml-2"><i class="fa fa-calendar-alt fa-fw"></i>Schedule</span></a>
           				</li>
           				<li class="list-unstyled components">
           					<a href="../review/reservations.php"><span class="ml-2"><i class="fa fa-users fa-fw"></i>Reservations</span></a>
           				</li>
           				<li class="list-unstyled components">
           					<a href="../review/billing.php"><span class="ml-2"><i class="fa fa-clipboard fa-fw"></i>Billing</span></a>
           				</li>
           				<li class="list-unstyled components">
           					<a href="../review/reports.php"><span class="ml-2"><i class="fa fa-chart-bar fa-fw"></i>Reports</span></a>
           				</li>
           				<li class="list-unstyled components">
           					<a href="#" data-toggle="collapse" data-target="#review-manage-collapse"><span class="ml-2"><i class="fa fa-cogs fa-fw"></i> Manage</span></a>
           					<ul class="collapse" id="review-manage-collapse">
           						<li class="list-unstyled components">
           							<a href="../review/manage/school.php"><span class="ml-4"><i class="fa fa-university fa-fw"></i>School</span></a>
           						</li>
           						<li class="list-unstyled components">
           							<a href="../review/manage/course.php"><span class="ml-4"><i class="fa fa-graduation-cap fa-fw"></i>Course & Major</span></a>
           						</li>
           					</ul>
           				</li>
           			</ul>

           		</li>
           		<li class="active">
           			<a href="#" data-toggle="collapse" data-target="#venue-collapse">
           				<i class="fa fa-clipboard fa-fw"></i>Venue
           			</a>
           			<ul class="collapse show" id="venue-collapse">
           				<li class="list-unstyled components">
           					<a href="#"><span class="ml-2"><i class="fa fa-calendar-alt fa-fw"></i>Schedule</span></a>
           				</li>
           				<li class="list-unstyled components">
           					<a href="reports.php"><span class="ml-2"><i class="fa fa-chart-bar fa-fw"></i>Reports</span></a>
           				</li>
           				<li class="list-unstyled components">
           					<a href="#" data-toggle="collapse" data-target="#venue-manage-collapse"><span class="ml-2"><i class="fa fa-cogs fa-fw"></i> Manage</span></a>
           					<ul class="collapse" id="venue-manage-collapse">
           						<li class="list-unstyled components">
           							<a href="manage/rates.php"><span class="ml-4"><i class="fa fa-money-bill-alt fa-fw"></i>Rates</span></a>
           						</li>
           					</ul>
           				</li>
           			</ul>
           		</li>
           		<!--
           		<li class="active"><a href="#" data-toggle="collapse" data-target="#schedule-collapse"><i class="fa fa-calendar-alt"></i> Schedule</a>
           			<ul class="collapse" id="schedule-collapse">
           				<li class="list-unstyled components"><a href="../review/">Review Schedule</a></li>
           				<li class="list-unstyled components"><a href="#">Venue Schedule</a></li>
           			</ul>
           		</li>
           		-->
           		<!--
           		<li><a href="#" data-toggle="collapse" data-target="#billing-collapse"><i class="fa fa-clipboard"></i> Billing</a>
	           			<ul class="collapse" id="billing-collapse">
	           				<li class="list-unstyled components"><a href="../../billing/review/">Review</a></li>
	           				<li class="list-unstyled components"><a href="../../billing/function/"> Venue</a></li>
	           			</ul>
	           		</li>
	           		<li><a href="#" data-toggle="collapse" data-target="#reports-collapse"><i class="fa fa-bar-chart"></i> Reports</a>
	           			<ul class="collapse" id="reports-collapse">
	           				<li class="list-unstyled components"><a href="../../reports/review/">Review</a></li>
	           				<li class="list-unstyled components"><a href="#">Function</a></li>
	           				</li>
	           			</ul>
	           		</li>
	           	-->
           	</ul>
		</nav>

		<!-- Main Content -->
		<div class="container-fluid" id="content">		
			<div class="row">
				<div class="col-md-12 mt-4">

					<div class="nav nav-tabs mt-2" id="nav-tab" role="tablist">	
						<a href="#v-pills-reserved" class="nav-link active" data-toggle="pill" id="v-pills-reserved-tab" role="tab" aria-controls="v-pills-reserved" aria-selected="false">Reserved</a>
						<a href="#v-pills-checkin" class="nav-link" data-toggle="pill" id="v-pills-checkin-tab" role="tab" aria-controls="v-pills-checkin" aria-selected="false">Checked-in</a>	
						<a href="#v-pills-checkout" class="nav-link" data-toggle="pill" id="v-pills-checkout-tab" role="tab" aria-controls="v-pills-checkout">Checked-out</a>
					</div>

					<div class="tab-content mt-3" id="v-pills-tabContent">

						<div class="tab-pane fade show active" id="v-pills-reserved" role="tabpanel" arialabelledby="v-pills-reserved-tab">

							<div class="row">
								<form>
									<div class="col-md-12">
										<div class="input-group mb-2">
											<div class="input-group-prepend">
												<button class="btn btn-outline-success dropdown-toggle" id="firstSearch-category" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-id=1>Search by</button>
												<div class="dropdown-menu">
													<a class="dropdown-item" id="searchBy-desc" href="#">Description</a>
													<a class="dropdown-item" id="searchBy-name" href="#">Organizer</a>
													<a class="dropdown-item" id="searchBy-date" href="#">Date</a>
												</div>
												<!--<span class="input-group-text">Search</span>-->
											</div>
											<input type="text" class="form-control col-md-7" id="searchFirstFloor-desc" placeholder="Description" style="border-top-right-radius: 5px;border-bottom-right-radius: 5px">
											<div class="input-group-append ml-3">
												<button class="btn btn-success" id="searchFirstFloor-btn"  style="border-top-left-radius: 4px;border-bottom-left-radius: 4px;"><i class="fa fa-search"></i> Search</button>
											</div>
										</div>
									</div>
								</form>
							</div>
							
							<div class="row mt-2">
								<div class="col-md-12" id="schedule-table-wrapper">
									<table class="table table-hover table-bordered" id="tableSched">
										<thead class="bg-dark text-white">
											<th id="room">Room</th>
											<th id="firstDescription">Description</th>
											<th id="firstStart">Arrival(Date and time)</th>
											<th id="firstEnd">Departure(Date and time)</th>
											<th id="firstRequest">Organizer</th>
											<th id="firstActions" colspan="3">Actions</th>
										</thead>
										<tbody id="tbodySched">
											
										</tbody>
									</table>
								</div>
							</div>

							<div class="row mt-4">
								<div class="col-md-8 offset-md-2" id="firstFloor-add-btn-wrapper" style="text-align: center">
									<button class="btn btn-success" id="toggle-add-modal" data-toggle="modal" data-target="#addFunctionSched-modal"><i class="fa fa-plus-circle"></i> Add Schedule</button>

									<button class="btn btn-success" id="toggle-requests-modal" data-toggle="modal" data-target="#viewRequests-modal"><i class="fa fa-search"></i> View Requests</button>
									
								</div>
							</div>

						</div><!-- Reserved tab -->


						<div class="tab-pane fade" id="v-pills-checkin" role="tabpanel" arialabelledby="v-pills-checkin-tab">
							<!--
							<div class="row">
								<div class="col-md-12">
									<form>
										<div class="input-group">
											<div class="input-group-prepend">
												<button class="btn btn-outline-success dropdown-toggle" id="search-category-checkin" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-id=1>Search by</button>
												<div class="dropdown-menu">
													<a class="dropdown-item" id="searchBy-lname-checkin" href="#">Last name</a>
													<a class="dropdown-item" id="searchBy-fname-checkin" href="#">First name</a>
												</div>
											</div>
											<input type="text" class="form-control col-md-3" id="search-checked-in" placeholder="Last name">
											<div class="input-group-append">
												<button class="btn btn-success" id="search-checked-in-btn"><i class="fa fa-search"></i></button>
											</div>
										</div>
									</form>
								</div>
							</div>
							-->
							<div class="row mt-2">
								<div class="col-md-12" id="schedule-table-wrapper">
									<table class="table table-hover table-bordered">
										<thead class="bg-dark text-white">
											<th id="checkin-room">Room</th>
											<th id="checkin-description">Description</th>
											<th id="checkin-requesitioner">Organizer</th>
											<!--<th id="checkin-arrival">Arrival</th>-->
											<th id="checkin-checkedin">Checked-in</th>
											<th id="checkin-departure">Departure</th>
											<th id="checkin-action" colspan="4">Action</th>
										</thead>
										<tbody id="tbodyCheckin">
											
										</tbody>
									</table>
								</div>
							</div>
							
						</div><!-- check-in tab -->


						<div class="tab-pane fade" id="v-pills-checkout" role="tabpanel" arialabelledby="v-pills-checkout-tab">

							<div class="row">
								<form>
									<div class="col-md-12">
										<div class="input-group mb-2">
											<div class="input-group-prepend">
												<button class="btn btn-outline-success dropdown-toggle" id="checkout-search-category" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-id=1>Search by</button>
												<div class="dropdown-menu">
													<a class="dropdown-item" id="checkout-searchBy-desc" href="#">Description</a>
													<a class="dropdown-item" id="checkout-searchBy-name" href="#">Organizer</a>
												</div>
												<!--<span class="input-group-text">Search</span>-->
											</div>
											<input type="text" class="form-control col-md-7" id="checkout-search-desc" placeholder="Description" style="border-top-right-radius: 5px;border-bottom-right-radius: 5px">
											<div class="input-group-append ml-3">
												<button class="btn btn-success" id="checkout-search-btn"  style="border-top-left-radius: 4px;border-bottom-left-radius: 4px;"><i class="fa fa-search"></i> Search</button>
											</div>
										</div>
									</div>
								</form>
							</div>

							<div class="row mt-2">
								<div class="col-md-12"  id="schedule-table-wrapper">
									<table class="table table-hover table-bordered">
										<thead class="bg-dark text-white">
											<th id="checkout-room">Room</th>
											<th id="checkout-description">Description</th>
											<th id="checkout-requesitioner">Organizer</th>
											<th id="checkout-checkedin">Checked-in</th>
											<th id="checkout-checkedout">Checked-out</th>
											<th id="checkout-action" colspan="3">Action</th>
										</thead>
										<tbody id="tbodyCheckout">
											
										</tbody>
									</table>
								</div>
							</div>
						</div><!-- checkout-tab -->

					</div><!-- tab content -->
					
				</div>
			</div>
			
		</div><!-- Main content -->	

		<?php 
			
			//Requests
			include "modals/schedule/requests-modals/vw-requests-mdl.php";
			include "modals/schedule/requests-modals/create-request-mdl.php";
			include "modals/schedule/requests-modals/vw-reject-mdl.php";
			include "modals/schedule/requests-modals/vw-request-detail-mdl.php";

			//Reserved
			include "modals/schedule/reserved-modals/create-functionSched-mdl.php";
			include "modals/schedule/reserved-modals/createBill-checkin-mdl.php";
			include "modals/schedule/reserved-modals/vw-Function-Schedule-mdl.php";

			// Check-in
			include "modals/schedule/checkin-modals/vw-checkin-info-mdl.php";		
			include "modals/schedule/checkin-modals/createBill-checkout-mdl.php";
			//View Registered Particular
			include "modals/schedule/checkin-modals/vw-particular-checkout-mdl.php";

			//Create Amenity
			include "modals/schedule/checkin-modals/createAmenity-checkout-mdl.php";
			include "modals/schedule/checkin-modals/viewAmenity-checkout-mdl.php";

			//Generate Bill checkout
			include "modals/schedule/checkin-modals/generateBill-checkout-mdl.php";
			//include "modals/vw-checkin-mdl.php";

			//Checkout tab
			include "modals/schedule/checkout-modals/vw-checkout-info-mdl.php";
			include "modals/schedule/checkout-modals/viewGenerateBill-checkout-mdl.php";
			//include "modals/schedule/viewBill-checkout-mdl.php";
			//include "modals/schedule/viewBill-vw-Particular-checkout-mdl.php";
			//include "modals/schedule/viewBill-vw-Amenity-checkout-mdl.php";
			//include "modals/schedule/viewBill-create-Amenity-checkout-mdl.php";
		?>


		<div class="overlay">

		</div>
	</div><!-- wrapper -->
</body>	

</html>

<script type="text/javascript" src="../../scripts/function.js"></script>
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

	$("#schedule-data").click(function () {
	    //$('.selected').removeClass('selected');
	    $(this).addClass("selected");
	    alert($(".selected").data("id"));
	});
</script>
