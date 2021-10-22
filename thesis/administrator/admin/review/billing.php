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

	   	<link rel="stylesheet" type="text/css" href="../../lib/datetimepicker/jquery.datetimepicker.min.css">

	   	<script type="text/javascript" src="../../lib/datetimepicker/jquery.datetimepicker.full.min.js"></script>

	   	<!--<script src="../css/jquery.mCustomScrollbar.concat.min.js.download"></script>-->
		<link rel="stylesheet" type="text/css" href="../../css/sidebar.css">

		<link rel="stylesheet" type="text/css" href="../../css/billing.css">

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
				$name = $crud->getAdmin_name($_SESSION["id"]);*/
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
	           					<a href="#"><span class="ml-2"><i class="fa fa-clipboard fa-fw"></i>Billing</span></a>
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
				<div class="row">	
					<div class="col-md-12">	
						<div class="mt-2">			
							<button type="button" class="btn btn-success" data-toggle="modal" data-target="#vw-review-sched-modal" id="searchReview-open-mdl"><i class="fa fa-search"></i> Search for Review</button>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 col-sm-3">
						<div class="row mt-2">
							<form>
								<div class="input-group col-md-12">
									<div class="input-group-prepend">
										<span class="input-group-text">Search</span>
									</div>
									<input type="text" class="form-control" id="searchReviewer" placeholder="Last name">
									<div class="input-group-append">
										<button class="btn btn-success" id="searchReviewer-btn"><i class="fa fa-search fa-fw"></i></button>
									</div>
								</div>
							</form>
						</div>
						<div class="row mt-2">
							<div class="col-md-12">
								<div id="reviewerList-wrapper">
									<select size="20" id="reviewerList">
										
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-9  col-sm-9 ">
						<div class="card mt-2" id="invoice_info" data-id>
							<div class="card-header bg-dark text-white">
								<h3 class="card-title"><i class="fa fa-money-alt"></i>Record Bill</h3>
							</div>
							<div class="card-body" id="invoice_body">
								<div class="row">
									<!--<div class="col-md-2" style="display: inline;text-align: right;">
										<p>Name: </p>
									</div>-->
									<label class="col-form-label col-md-2" for="bill_name">Name: </label>
									<div class="col-md-5">
										<input type="text" class="form-control" id="bill_name" disabled>
										<!--<p id="bill_name_p"><span id="bill_name"></span></p>-->
									</div>
									
									<label class="col-form-label col-md-2" for="bill_school">School: </label>
									<div class="col-md-3">
										<input type="text" class="form-control" id="bill_school" disabled>
										<!--<select class="custom-select form-control" id="bill_school">
											
										</select>-->
									</div>
								</div>
								<div class="row mt-2">
									<label class="col-form-label col-md-2" for="bill_review_title">Review Title:</label>
									<div class="col-md-5">
										<input type="text" class="form-control" id="bill_review_title" disabled>
									</div>
									<label class="col-form-label col-md-2" for="bill_review_title">Review Fee:</label>
									<div class="col-md-2">
										<input type="text" class="form-control" id="bill_review_fee" data-fee disabled>
									</div>
								</div>
								<div class="row mt-2">
										<div class="col-md-12">
										<div id="open-bill-modal-cont" class="float-right">
											<button class="btn btn-success" id="open-bill-modal"><i class="fa fa-plus-circle"></i> Add record</button>
											<button class="btn btn-success" id="print-bill"><i class="fa fa-print"></i> Print Bill</button>
										</div>
									</div>
								</div>
								<div class="row">
									<table class="table table-hover table-bordered mt-2">
										<thead>
											<tr>
												<th id="descr-hdr">Description</th>
												<th id='ORnum-hdr'>OR#</th>
												<th id='amt-paid-hdr'>Date paid</th>
												<th id='date-paid-hdr'>Amount paid</th>
												<th id="action-hdr" colspan="2">Action</th>
											</tr>
										</thead>
										<tbody id="billLists">
										</tbody>
									</table>
								</div>
								<div class="row" style="margin-top: 50px;">
									<label class="col-md-4 offset-md-6 col-form-label" for="total-amount">Total amount paid:</label>
									<div class="col-md-2 col-sm-">
										<input class="form-control" id="total-amount" disabled>
									</div>
								</div>
								<div class="row mt-2">
									<label class="col-md-4 offset-md-6 col-form-label" for="total-amount">Remaining Balance:</label>
									<div class="col-md-2 col-sm-2">
										<input class="form-control" id="remaining-bal" disabled>
									</div>
								</div>
								<!--<div class="row">
									<button class="btn btn-primary" id="printBill">Print</button>
								</div>
								-->
							</div>
						</div>
					</div>
				</div>
			</div><!-- content -->

			<?php 
				include "modals/billing/view-review-schedule-mdl.php";
				include "modals/billing/add-bill-review-mdl.php";
				include "modals/billing/edit-bill-review-mdl.php";
				include "modals/billing/create-school-mdl.php";
			?>

			<div class="overlay">

			</div>
		</div><!-- wrapper -->
	</body>	

</html>

<script type="text/javascript" src="../../scripts/billing.js"></script>
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


