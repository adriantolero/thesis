<html>

<head>

	<link href="../css/schedule.css" rel="stylesheet">

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
						<a href="#" class="nav-link" id="dropdownSchedule">Rooms</a>
						<!--<div class="dropdown-menu" aria-labelledby="dropdownSchedule">
							<a class="dropdown-item" href="rooms/index.php">First Floor(Training Hall)</a>
							<a class="dropdown-item" href="#">Second Floor(Function Room)</a>
						</div>
						-->
					</li>
					<li class="nav-item">
						<a href="../review/schedule.php" class="nav-link">Review Schedule</a>
					</li>
					<li class="nav-item">
						<a href="#" class="nav-link">About</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container-fluid">

		<div class="row mt-3">
			<div class="col-md-10 offset-md-1">
				<div class="card" id="schedule-card" data-id=<?php echo $_GET["rm_id"] ?>>
					<div class="card-header bg-dark text-white">
						<h3 class="card-title">Available Schedule</h3>
					</div>
					<div class="card-body">
						<form>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">Search date</span>
								</div>
								<input type="text" id="searchInput" class="form-control col-md-3" value="2018-04-01">
								<div class="input-group-append">
									<button class="btn btn-success" id="searchDate"><i class="fa fa-search"></i></button>
								</div>	
							</div>
						</form>
						<table class="table table-hovered">
							<thead>
								<th id="start">Date & Time(start)</th>
								<th id="end">Date & Time(end)</th>
								<!--<th id="status">Status</th>-->
							</thead>
							<tbody id="scheduleTable">
								
							</tbody>
						</table>
					</div><!-- card-body -->
				</div><!-- card -->
			</div>	
		</div><!-- row -->

	</div>

</body>

</html>

<script type="text/javascript" src="../js/roomSchedule.js"></script>