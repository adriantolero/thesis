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

	<link rel="stylesheet" type="text/css" href="../../css/schedule.css">

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
           					<a href="#"><span class="ml-2"><i class="fa fa-calendar-alt fa-fw"></i>Schedule</span></a>
           				</li>
           				<li class="list-unstyled components">
           					<a href="reservations.php"><span class="ml-2"><i class="fa fa-users fa-fw"></i>Reservations</span></a>
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
           		<!--
           		<li><a href="#" data-toggle="collapse" data-target="#schedule-collapse"><i class="fa fa-calendar-alt"></i> Schedule</a>
           			<ul class="collapse" id="schedule-collapse">
           				<li class="list-unstyled components"><a href="#"> Review Schedule</a></li>
           				<li class="list-unstyled components"><a href="../function/">Venue Schedule</a></li>
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
           		-->
           		<!--
           		<li><a href="#" data-toggle="collapse" data-target="#reports-collapse"><i class="fa fa-bar-chart"></i> Reports</a>
           			<ul class="collapse" id="reports-collapse">
           				<li class="list-unstyled components"><a href="../../reports/review/">Review</a></li>
           				<li class="list-unstyled components"><a href="#"> Function</a></li>
           				</li>
           			</ul>
           		</li>
           		-->
           	</ul>
		</nav>

		<!-- Main Content -->
		<div class="container-fluid" id="content">		
		
			<div class="row mb-2" style="margin-top: 100px;">
				<div class="col-md-4 offset-md-4">
					<form id="searchForm">
						<div class="input-group">

							<div class="input-group-prepend">
								<button class="btn btn-success dropdown-toggle" id="searchCategory" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-id="1">Search by</button>
								<div class="dropdown-menu">
									<a href="#" class="dropdown-item" id="searchBy-description">Description</a>
									<a href="#" class="dropdown-item" id="searchBy-room">Room</a>
									<a href="#" class="dropdown-item" id="searchBy-year">Year</a>
								</div>
							</div>
							<input type="text" id="searchInput" class="form-control" placeholder="Description">
							<div class="input-group-append">
								<button class="btn btn-success" id="searchBtn"><i class="fa fa-search fa-fw"></i></button>
							</div>
						</div>
					</form>
				</div>
			</div>
			
			<!-- Schedule Table -->
			<div class="row">
				<div class="col-md-12" style="/*height: 300px;/*overflow-x: auto;overflow-y: auto;*/">
					<div class="card" style="max-height: 300px;overflow-y: auto;">
						<table class="table table-hover table-bordered" id="tableSchedule">
							<thead class="thead-primary">
								<tr class="bg-dark text-white">
									<th style="width: 10%;text-align: center;">Room</th>
									<th style="width: 40%;text-align: center;">Description</th>
									<th style="width: 15%;text-align: center;">Date Start</th>
									<th style="width: 15%;text-align: center;">Date End</th>			
									<th colspan="3" style="width: 20%;"><center>Actions</center></th>
									<!--<th ><center>Edit</center></th>
									<th ><center>Delete</center></th>-->
								</tr>	
							</thead>
							<tbody id="dataSchedule">
								<!-- Data here  -->
							</tbody>
							
						</table>
					</div>
				</div>
			</div><!-- row table -->
			<div class="row mt-2">
				<div class="col-md-12" id="btn-wrapper">
					<center>
					<button class="btn btn-success" id="open-addReview-modal" data-toggle="modal" data-target="#addReview-modal"><i class="fa fa-calendar-plus"></i> Create Review Schedule</button></center>
				</div>
			</div>
		</div><!-- Main content -->

		<?php
			include "modals/schedule/create-review-mdl.php";
			include "modals/schedule/view-review-mdl.php";
			//include "../modals/edit-review-mdl.php";
			
		?>		
		<div class="overlay">

		</div>
	</div><!-- wrapper -->
</body>	

</html>

<script type="text/javascript" src="../../scripts/review.js"></script>
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
