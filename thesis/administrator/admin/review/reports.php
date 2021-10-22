<!DOCTYPE html>
<html>
<head>
	<META http-equiv="Content-type" content="text/html; charset=iso-8859-1">
	<title>Administrator</title>
	<!-- bootstrap v4 -->
	<script type="text/javascript" src="../../lib/bootstrap4/js/jquery-3.2.1.min.js"></script>

	<link rel="stylesheet" type="text/css" href="../../lib/bootstrap4/css/bootstrap.min.css">

   	<link rel="stylesheet" type="text/css" href="../../lib/fontawesome-free-5.0.6/web-fonts-with-css/css/fontawesome-all.min.css">

   	<link rel="stylesheet" href="../../lib/sidebar/css/jquery.mCustomScrollbar.min.css">

   	<script src="../../lib/sidebar/js/jquery.mCustomScrollbar.concat.min.js.download"></script>

   	<script type="text/javascript" src="../../lib/bootstrap4/js/popper.min.js"></script>

   	<script type="text/javascript" src="../../lib/bootstrap4/js/bootstrap.min.js"></script>

   	<!--<script src="../css/jquery.mCustomScrollbar.concat.min.js.download"></script>-->
	<link rel="stylesheet" type="text/css" href="../../css/sidebar.css">

	<link rel="stylesheet" type="text/css" href="../../css/reports_review.css">

	<script type="text/javascript" src="../../scripts/modal.js"></script>

	<?php
	
		session_start();
		if(!isset($_SESSION['username'])){
			header("Location: ../..");
			echo "Session not found";
		}

		else{
			//echo "Session " . $_SESSION["username"] . "found";
			//include_once "../config/dbConfig.php";
			/*include_once "../../../CRUD/crud.php";

			$crud = new CRUD();
			$id = $_SESSION["id"];
			$name = $crud->getAdmin_name($_SESSION["id"]);
			*/
			$id = $_SESSION["id"];
			$name = $_SESSION["name"];
		}
		//echo "User's name is " . $name;
		//include "../php/connect.php";
		/*
		$id = $_SESSION['id'];
		$name = "";
		$sql = "SELECT * FROM `employee` WHERE `i_emp_id` = '$id'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$name = $row['str_e_fname'];
			}
		}*/
	?>

</head>

<body>
	<div class="wrapper">
		<nav class="navbar navbar-expand-md navbar-dark bg-dark">
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
	           			<a href="../profile.php" id="openProfile" class="btn btn-info btn-sm">Profile</a>
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
           					<a href="reservations.php"><span class="ml-2"><i class="fa fa-users fa-fw"></i>Reservations</span></a>
           				</li>
           				<li class="list-unstyled components">
           					<a href="billing.php"><span class="ml-2"><i class="fa fa-clipboard fa-fw"></i>Billing</span></a>
           				</li>
           				<li class="list-unstyled components">
	       					<a href="#"><span class="ml-2"><i class="fa fa-chart-bar fa-fw"></i>Reports</span></a>
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
           		<!--
           		<li><a href="#" data-toggle="collapse" data-target="#schedule-collapse"><i class="fa fa-calendar-alt"></i> Schedule</a>
           			<ul class="collapse" id="schedule-collapse">
           				<li class="list-unstyled components"><a href="../../schedule/review/"><i class="fa fa-arrow-right"></i> Review Schedule</a></li>
           				<li class="list-unstyled components"><a href="#"><i class="fa fa-arrow-right"></i> Function Schedule</a></li>
           			</ul>
           		</li>
           		<li><a href="#" data-toggle="collapse" data-target="#billing-collapse"><i class="fa fa-cogs"></i> Billing</a>
           			<ul class="collapse" id="billing-collapse">
           				<li class="list-unstyled components"><a href="../../billing/review/"><i class="fa fa-arrow-right"></i> Review</a></li>
           				<li class="list-unstyled components"><a href="../../billing/function/"><i class="fa fa-arrow-right"></i> Function</a></li>
           			</ul>
           		</li>
           		<li><a href="#" data-toggle="collapse" data-target="#reports-collapse"><i class="fa fa-bar-chart"></i> Reports</a>
           			<ul class="collapse" id="reports-collapse">
           				<li class="list-unstyled components"><a href="#"><i class="fa fa-arrow-right"></i> Review</a></li>
           				<li class="list-unstyled components"><a href="#"><i class="fa fa-arrow-right"></i> Function</a></li>
           				</li>
           			</ul>
           		</li>
           		-->
           	</ul>
		</nav>

		<!-- Main Content -->
		<div class="container-fluid" id="content">	

			<div class="row" style="margin-top: 50px;">
				<div class="col-md-4">
					<form>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">Search</span>
							</div>
							<input type="text" id="searchReview" class="form-control">
							<div class="input-group-append">
								<button class="btn btn-success" id="searchReview-btn"><i class="fa fa-search fa-fw"></i></button>
							</div>
						</div>
					</form>

					<select class="custom-select mt-1" id="reviewList" size="20" style="width: 100%">
						
					</select>

				</div>

				<div class="col-md-8" id="reportColumn" style="display: none;">
					<div class="row">
						<!--
						<div class="col-md-8">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">Display by</span>
								</div>
								<select class="custom-select col-md-4" id="displayBy">
									<option value="1">Year</option>
									<option value="2">Month</option>
								</select>
								<div class="input-group-append">
									<span class="input-group-text">Month</span>
								</div>
								<select class="custom-select col-md-4" id="displayByMonth">
									<option value="1">Janurary</option>
									<option value="2">February</option>
									<option value="3">March</option>
									<option value="4">April</option>
									<option value="5">May</option>
									<option value="6">June</option>
									<option value="7">July</option>
									<option value="8">August</option>
									<option value="9">September</option>
									<option value="10">October</option>
									<option value="11">November</option>
									<option value="12">December</option>

								</select>
							</div>
						</div>
						-->
						<div class="col-md-12" id="printBtn-container">
							<button class="btn btn-success float-right" id="printBtn"><i class="fa fa-print fa-fw"></i>Print</button>
						</div>
					</div>
					<div class="row mt-3">
						<div class="col-md-12">
							<div class="table-responsive" id='printDiv' data-id data-title data-year style="max-height: 550px; overflow-y: auto;">
								<center><h3 id="reviewTitle"></h3></center>
								<table class="table table-hovered" id="monthlyReport-table" align="center">
									<thead class="bg-dark text-white">
										<tr>
											<th id="mName">Name</th>
											<th id="mSchool">School</th>
											<th id="mCourse">Course</th>
											<th id="mMajor">Major</th>
											<th id="mReviewfee">Review Fee</th>
											<th id="mAmountPaid">Amount Paid</th>
											<th id="mORnum">O.R. No.</th>
											<th id="mDatepaid">Date paid</th>
											<th id="mBalance">Balance</th>
										</tr>
									</thead>
									<tbody id="monthlyReport"></tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!--
			<div class="row">
				<div class="col-md-4">	
					<button class="btn btn-success mt-4" id="reviewSchedules-open-mdl" data-toggle="modal" data-target="#reviewSchedules-modal"><i class="fa fa-search"></i> Search for Review</button>
				</div>
			-->
				<!--	
					<div class="input-group mt-4">
						<div class="input-group-prepend">
							<span class="input-group-text">Search</span>
						</div>
						<input type="text" id="searchYear" class="form-control" placeholder="Year">
						<div class="input-group-append">
							<button class="btn btn-success" id="searchReview-btn"><i class="fa fa-search"></i></button>
						</div>
					</div>				
				</div>
				end here
			</div>
			<!--
			<div class="row mt-2">
				<!--<div class="col-md-4">
					<select id="reviewLists" size="10" class="form-control custom-select">
						
					</select>
				</div>
				end here
				<!--
				<div class="col-md-12">
					<div class="card" id="monthlyReport-card" data-id>
						<div class="card-header bg-dark text-white">
							<h4 class="card-title"><i class="fa fa-clipboard"></i> Monthly Reports</h4>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-7">
									<h3>Review: <span id="review-desc"></span></h3>
								</div>
								<div class="col-md-4 offset-md-1">
									
										
									<p>Review fee(VSU): <span id="review-fee-vsu"></span></p>
										
									
									<p>Review fee(Non-VSU): <span id="review-fee-non-vsu"></span></p>
									
								</div>
							</div>
							<table class="table table-hovered" id="monthlyReport-table">
								<thead class="bg-dark text-white">
									<tr>
										<th id="mName">Name</th>
										<th id="mSchool">School</th>
										<th id="mCourse">Course</th>
										<th id="mMajor">Major</th>
										<th id="mReviewfee">Review Fee</th>
										<th id="mAmountPaid">Amount Paid</th>
										<th id="mORnum">O.R. No.</th>
										<th id="mDatepaid">Date paid</th>
										<th id="mBalance">Balance</th>
									</tr>
								</thead>
								<tbody id="monthlyReport"></tbody>
							</table>
						</div>	
					</div>
				</div>
				end here

			</div>
			<div class="row">
				<div class="col-md-4 offset-md-4">
					<center><button class="btn btn-success mt-3" id="print"><i class="fa fa-print"></i> Print</button></center>
				</div>
			</div>
			-->
		</div><!-- content -->

		<?php 
			include "modals/reports/vw-reviewSched-mdl.php";
		?>

		<div class="overlay">

		</div>
	</div><!-- wrapper -->
</body>	

</html>

<script type="text/javascript" src="../../scripts/reports.js"></script>
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
	});
</script>


