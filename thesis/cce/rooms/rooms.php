<html>

<head>

	<link href="../css/room.css" rel="stylesheet">

	<script type="text/javascript" src="../lib/bootstrap4/js/jquery-3.2.1.min.js"></script>

	<link rel="stylesheet" type="text/css" href="../lib/bootstrap4/css/bootstrap.min.css">	

	<link rel="stylesheet" type="text/css" href="../lib/fontawesome-free-5.0.6/web-fonts-with-css/css/fontawesome-all.min.css">

	<script type="text/javascript" src="../lib/bootstrap4/js/popper.min.js"></script>

	<script type="text/javascript" src="../lib/bootstrap4/js/bootstrap.min.js"></script>

	<link rel="stylesheet" type="text/css" href="../lib/datetimepicker/jquery.datetimepicker.min.css">

   	<script type="text/javascript" src="../lib/datetimepicker/jquery.datetimepicker.full.min.js"></script>

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
					<li class="nav-item active">
						<a href="#" class="nav-link" id="dropdownSchedule">Venue Reservation</a>
						<!--<div class="dropdown-menu" aria-labelledby="dropdownSchedule">
							<a class="dropdown-item" href="rooms/index.php">First Floor(Training Hall)</a>
							<a class="dropdown-item" href="#">Second Floor(Function Room)</a>
						</div>
						-->
					</li>
					<li class="nav-item">
						<a href="../review/schedule.php" class="nav-link">Review Schedule</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container-fluid">

		<div class="row mt-3">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header bg-dark text-white">
						<h3 class="card-title">Rooms</h3>
					</div>
					<div class="card-body" style="background: #e3d5d5">
						<div class="row" style="padding-bottom: 1em;">
							<div class="col-md-7">
								<div id="carouselIndicatorPictures" class="carousel slide" data-ride="carousel">
									<ol class="carousel-indicators">
										<li data-target="#" data-slide-to="0"></li>
										<li data-target="#" data-slide-to="1"></li>
										<!--<li data-target="#" data-slide-to="2"></li>-->
									</ol>

									<div class="carousel-inner">
										
										<div class="carousel-item active">
									      	<img class="d-block w-100" src="../img/first.jpg" alt="First slide">
									      	<div class="carousel-caption d-none d-md-block">
									      		<h5>Training Hall</h5>
									      	</div>
									    </div>
									    <div class="carousel-item">
									      	<img class="d-block w-100" src="../img/second.jpg" alt="Second slide">
									      	<div class="carousel-caption d-none d-md-block">
									      		<h5>Function Hall</h5>
									      	</div>
									    </div>
									</div>

									<a class="carousel-control-prev" href="#carouselIndicatorPictures" role="button" data-slide="prev">
									    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
									    <span class="sr-only">Previous</span>
								  	</a>
								  	<a class="carousel-control-next" href="#carouselIndicatorPictures" role="button" data-slide="next">
								    	<span class="carousel-control-next-icon" aria-hidden="true"></span>
								    	<span class="sr-only">Next</span>
								  	</a>
								</div><!-- Carousel -->
							</div>
							<div class="col-md-4 offset-md-1">
								<div class="row">
									<div class="col-md-12">
										<div class="card">
											<div class="card-body" style="height: 250px;overflow: auto;">
												<p><i><b>Note:</b></i> Reservation form is only valid for 3 days. We will contact you if we have accepted your form request.</p>
												<!--<table class="table table-hovered table-bordered">
													<col>
													<colgroup span="2"></colgroup>
 													<colgroup span="2"></colgroup>
 													<tr>
 														<td rowspan="2"></td>
 														<th colspan="2"><center>Rates</center></th>
 													</tr>
 													<tr>
 														<th scope="col"><center>Without aircon</center></th>
 														<th scope="col"><center>With aircon</center></th>
 													</tr>
 													<tr>
 														<th scope="row"><center>A. Training Hall (1st Floor)</center></th>
 														<td></td>
 														<td></td>
 													</tr>
 													<tr>
 														<th rowspan="2" scope="row">1. VSU Personnel</th>
 														<td>First Hour: 350.00/hr<br>
 															Succeeding Hour: 50.00/hr
 														</td>
 														<td>First Hour: 350.00/hr<br>
 															Succeeding Hour: 50.00/hr
 														</td>
 													</tr>

												</table>
											-->
											</div>
										</div>
									</div>
								</div>
								<div class="row mt-1">
									<div class="col-md-6" id="create-reservation-outside">
										<div class="mr-auto ml-2">
											<button class="btn btn-success" id="toggle-viewRate" data-toggle="modal" data-target="#viewRates-modal"><i class="fa fa-search"></i> View Rate</button>
										</div>
									</div>
									<div class="col-md-6" id="create-reservation-outside">
										<div id="create-reservation-inside">
											<button class="btn btn-success" id="toggle-createReservation" data-toggle="modal" data-target="#createReservation-modal"><i class="fa fa-calendar-plus"></i> Create Reservation</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div><!-- row -->
	</div>

	<?php 

		include "modals/create-reservation-mdl.php";
		include "modals/previewForm-mdl.php";
		include "modals/viewRates-mdl.php";

	?>

</body>

</html>

<script type="text/javascript" src="../js/room.js"></script>
<script type="text/javascript" src="../js/modal.js"></script>