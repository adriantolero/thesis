<html>

<head>
	<title>Welcome!</title>

	<link href="../css/review.css" rel="stylesheet">

	<script type="text/javascript" src="../lib/bootstrap4/js/jquery-3.2.1.min.js"></script>

	<link rel="stylesheet" type="text/css" href="../lib/bootstrap4/css/bootstrap.min.css">	

	<link rel="stylesheet" type="text/css" href="../lib/fontawesome-free-5.0.6/web-fonts-with-css/css/fontawesome-all.min.css">

	<script type="text/javascript" src="../lib/bootstrap4/js/popper.min.js"></script>

	<script type="text/javascript" src="../lib/bootstrap4/js/bootstrap.min.js"></script>

</head>
<body>
	
	<nav class="navbar navbar-expand-md navbar-dark bg-dark" id="navbar-top">
		<div class="container-fluid">
			<a href="../" class="navbar-brand" id="expand-title"><img src="../img/vsu-logo(100).png" style="height: 70px;">Center for Continuing Education</a>
			<a href="../" class="navbar-brand"  id="mini-title" data-original-title="Center for Continuing Education Records Management System" rel="tooltip"><strong class="text-white"><img src="../img/vsu-logo(100).png" style="height: 70px;"> CCERMS</strong></a>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
			<div class="collapse navbar-collapse" id="navbar-collapse">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a href="../" class="nav-link">Home</a>
					</li>
					<li class="nav-item">
						<a href="../rooms/rooms.php" class="nav-link" id="dropdownSchedule">Venue Reservation</a>
						<!--<div class="dropdown-menu" aria-labelledby="dropdownSchedule">
							<a class="dropdown-item" href="rooms/index.php">First Floor(Training Hall)</a>
							<a class="dropdown-item" href="#">Second Floor(Function Room)</a>
						</div>
						-->
					</li>
					<li class="nav-item active">
						<a href="#" class="nav-link">Review Schedule</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container-fluid">
		<div class="row" id="review-container">
			<div class="col-md-9">
				<div class="card">
					<div class="card-header bg-dark text-white">
						<h3 class="card-title"><i class="fa fa-calendar-alt fa-fw"></i>Review Schedule</h3>
					</div>
					<div class="card-body">
						<table class="table table-hovered">
							<thead class="bg-dark text-white">
								<th id="room">Room</th>
								<th id="description">Description</th>
								<th id="start">Date start</th>
								<th id="end">Date end</th>
								<th id="slot">Slot(s) left</th>
								<th id="action">Action</th>
							</thead>
							<tbody id="scheduleData">
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="card">
					<div class="card-header bg-dark text-white">
						<h3 class="card-title">Requirements for Review Enrollment:</h3>
					</div>
					<div class="card-body">
						<ul>
							<li>One(1) piece 2 x 2 picture</li>
							<li>Reservation Fee: Php 500.00 (non-refundable)</li>
						</ul>
						<p><b><i>Note:</i></b> Reservation fee serves as down payment and will be deducted from your review fee once payment is made. </p>
					</div>
				</div>
			</div>
		</div><!-- row -->
	</div>

	<?php 
		include "modals/enroll-mdl.php";
		include "modals/addSchool-mdl.php";
		include "modals/addCourse-mdl.php";
		include "modals/addMajor-mdl.php";
		include "modals/viewSubmit-mdl.php";
	?>

</body>

</html>

<script type="text/javascript" src="../js/modal.js"></script>
<script type="text/javascript" src="../js/review.js"></script>