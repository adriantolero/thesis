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

	<link rel="stylesheet" type="text/css" href="../../../css/function_schedule.css">
	<!--<link rel="stylesheet" type="text/css" href="../../css/schedule/default.css">-->

	<?php
		
		session_start();
		if(!isset($_SESSION['username'])){
			header("Location: ../../../");
			//echo "Session not found";
		}

		else{
			//echo "Session " . $_SESSION["username"] . "found";
			//include_once '../../config/dbConfig.php';
			include "../../../CRUD/crud.php";

			$crud = new CRUD();
			$id = $_SESSION["id"];
			$name = $crud->getAdmin_name($_SESSION["id"]);
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
		<nav class="navbar navbar-expand-md navbar-dark bg-dark">
			<button id="sidebarCollapse" class="btn btn-success"  type="button"><i class="fa fa-bars"></i> <span id="hideToggle">Toggle Sidebar</span></button>
			
			<a href="#" class="navbar-brand ml-4" data-original-title="Center for Continuing Education Records Management System" rel="tooltip">CCERMS</a>
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
           				<li class="list-unstyled components"><a href="../review/"><i class="fa fa-arrow-right"></i> Review Schedule</a></li>
           				<li class="list-unstyled components"><a href="#"><i class="fa fa-arrow-right"></i> Function Schedule</a></li>
           			</ul>
           		</li>
           		<li><a href="#"><i class="fa fa-cog"></i> Requests</a></li>
           		<li><a href="#"><i class="fa fa-bar-chart"></i> Reports</a></li>
           	</ul>
		</nav>

		<!-- Main Content -->
		<div class="container-fluid" id="content">		

			<div class="row">
				<div class="col-md-12">
					<div class="nav nav-tabs mt-2" id="nav-tab" role="tablist">
						<a href="#v-pills-first-floor" class="nav-link active" data-toggle="pill" id="v-pills-first-floor-tab" role="tab" aria-controls="v-pills-first-floor" aria-selected="false">First Floor</a>

						<a href="#v-pills-second-floor" class="nav-link" data-toggle="pill" id="v-pills-second-floor-tab" role="tab" aria-controls="v-pills-second-floor" aria-selected="false">Second Floor</a>	
					</div>

					<div class="tab-content mt-3" id="v-pills-tabContent">

						<div class="tab-pane fade show active" id="v-pills-first-floor" role="tabpanel" arialabelledby="v-pills-first-floor-tab">
							<div class="row">
								<form>
									<div class="col-md-12">
										<div class="input-group mb-2">
											<div class="input-group-prepend">
												<button class="btn btn-outline-success dropdown-toggle" id="firstSearch-category" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-id=1>Search by</button>
												<div class="dropdown-menu">
													<a class="dropdown-item" id="first-searchBy-desc" href="#">Description</a>
													<a class="dropdown-item" id="first-searchBy-date" href="#">Date</a>
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

							<div class="row">
								<div class="col-md-12" id="firstFloorSched-table-wrapper">
									<table class="table table-hover table-bordered" id="firstFloorSched-table">
										<thead>
											<th id="room">Room</th>
											<th id="firstDescription">Description</th>
											<th id="firstStart">Date & Time(start)</th>
											<th id="firstEnd">Date & Time(end)</th>
											<th id="firstRequest">Requesitioner</th>
											<th id="firstActions" colspan="3">Actions</th>
										</thead>
										<tbody id="firstFloorSched">
											
										</tbody>
									</table>
								</div>
							</div>

							<div class="row">
								<div class="col-md-4 offset-md-4" id="firstFloor-add-btn-wrapper" style="text-align: center">
									<button class="btn btn-success" id="toggle-add-modal" data-toggle="modal" data-target="#addFunctionSched-first-flr-modal"><i class="fa fa-plus-circle"></i> Add Schedule</button>
								</div>
							</div>

						</div><!-- first floor tab -->

						<div class="tab-pane fade" id="v-pills-second-floor" role="tabpanel" arialabelledby="v-pills-second-floor-tab">
							<div class="input-group ml-3 mb-2">
								<div class="input-group-prepend">
									<span class="input-group-text">Search</span>
								</div>
								<input type="text" class="form-control col-md-2" id="searchSecondFloor-desc" placeholder="Description">

								<div class="input-group-append ml-3">
									<span class="input-group-text">Date</span>
								</div>
								<input type="text" class="form-control col-md-2" id="searchSecondFloor-date">
								<div class="input-group-prepend">
									<button class="btn btn-secondary" id="toggle-datetime-secondfloor"><i class="fa fa-calendar-alt"></i></button>
								</div>
								
								<div class="input-group-append ml-3">
									<button class="btn btn-success" id="searchSecondFloor-btn"><i class="fa fa-search"></i> Search</button>
								</div>
							</div>

							<table class="table table-hover">
								<thead>
									<th id="secondDescription">Description</th>
									<th id="secondStart">Date & Time(start)</th>
									<th id="secondEnd">Date & Time(end)</th>
									<th id="secondRequest">Requested by</th>
									<th id="secondActions" colspan="2">Actions</th>
								</thead>
								<tbody id="secondFloorSched">
									
								</tbody>
							</table>
						</div><!-- second floor tab -->

					</div>
				</div>
			</div>
			
		</div><!-- Main content -->	

		<?php 
			include "../modals/create-functionSched-mdl.php";
		?>


		<div class="overlay">

		</div>
	</div><!-- wrapper -->
</body>	

</html>

<script type="text/javascript" src="../../../scripts/function.js"></script>
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
	            url: "../../../controller/schedule.php",
	            data: {logout: "logout"},
	            success: function(data){
	                if(data=="User Logout"){
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
