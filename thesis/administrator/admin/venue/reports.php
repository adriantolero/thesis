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

	<link rel="stylesheet" type="text/css" href="../../css/function_reports.css">

	<script type="text/javascript" src="../../scripts/modal.js"></script>

	<script type="text/javascript" src="../../lib/jqueryPrint/jqueryPrint/jQuery.print.js"></script>
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
</style>	

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
           					<a href="schedule.php"><span class="ml-2"><i class="fa fa-calendar-alt fa-fw"></i>Schedule</span></a>
           				</li>
           				<li class="list-unstyled components">
           					<a href="#"><span class="ml-2"><i class="fa fa-chart-bar fa-fw"></i>Reports</span></a>
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
           	</ul>
		</nav>

		<!-- Main Content -->
		<div class="container-fluid" id="content">	

			<div class="row">
				<div class="col-md-6">
					<!--
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-"></i> Display by</span>
						</div>
						<select class="custom-select" id="displayBy">
							<option value="1">Year</option>
							<option value="2">Month</option>
						</select>
					</div>
				-->
				</div>
				<div class="col-md-6">
					<div class="float-right" id="printBtn-container">
						<button class="btn btn-success" id="printBtn" style="margin-right: 1em;"><i class="fa fa-print fa-fw"></i>Print</button>
					</div>
				</div>
					
			
				<!--
				<div class="col-md-4">
					<div class="float-right" id="printBtn-container">
						<button class="btn btn-success" id="printBtn" style="margin-right: 1em;"><i class="fa fa-print fa-fw"></i>Print</button>
					</div>
				</div>
				-->
			</div>
			<div id="printDiv">
				<div class="row" style="margin-top: 30px;">
					<div class="col-md-12">
						<center><h4>SUMMARY OF CCE UTILIZATION</h4></center>
					</div>
				</div>	

				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-hover table-bordered" align="center">
								<thead>
									<th style="width: ">Date</th>
									<th style="width: ">Event Title</th>
									<th>Nature of Event</th>
									<th>Billing Date</th>
									<th>Venue Used</th>
									<!--<th>Rate</th>-->
									<th>Aircon</th>
									<th>No. of Hours</th>
									<th>Additional charge</th>
									<th>Total Amount Due</th>
									<th>No. of Persons</th>
									<th>Name of Organizer</th>
								</thead>
								<tbody id="tbodyReports">
									
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div><!-- Main content -->	

		<?php 
			
		?>


		<div class="overlay">

		</div>
	</div><!-- wrapper -->
</body>	

</html>

<script type="text/javascript" src="../../scripts/function_reports.js"></script>
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
