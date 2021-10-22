<html>

<head>
	<title>Welcome!</title>

	<link href="css/home.css" rel="stylesheet">

	<script type="text/javascript" src="lib/bootstrap4/js/jquery-3.2.1.min.js"></script>

	<link rel="stylesheet" type="text/css" href="lib/bootstrap4/css/bootstrap.min.css">	

	<link rel="stylesheet" type="text/css" href="lib/fontawesome-free-5.0.6/web-fonts-with-css/css/fontawesome-all.min.css">

	<script type="text/javascript" src="lib/bootstrap4/js/popper.min.js"></script>

	<script type="text/javascript" src="lib/bootstrap4/js/bootstrap.min.js"></script>



</head>
<body>
	
	<nav class="navbar navbar-expand-md navbar-dark bg-dark" id="navbar-top">
		<div class="container-fluid">
			<a href="#" class="navbar-brand" id="expand-title"><img src="img/vsu-logo(100).png" style="height: 70px;">Center for Continuing Education</a>
			<a href="#" class="navbar-brand"  id="mini-title" data-original-title="Center for Continuing Education Records Management System" rel="tooltip"><strong class="text-white"><img src="img/vsu-logo(100).png" style="height: 70px;"> CCERMS</strong></a>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
			<div class="collapse navbar-collapse" id="navbar-collapse">
				<ul class="navbar-nav">
					<li class="nav-item active">
						<a href="#" class="nav-link">Home</a>
					</li>
					<li class="nav-item">
						<a href="rooms/rooms.php" class="nav-link" id="dropdownSchedule">Venue Reservation</a>
						<!--<div class="dropdown-menu" aria-labelledby="dropdownSchedule">
							<a class="dropdown-item" href="rooms/index.php">First Floor(Training Hall)</a>
							<a class="dropdown-item" href="#">Second Floor(Function Room)</a>
						</div>
						-->
					</li>
					<li class="nav-item">
						<a href="review/schedule.php" class="nav-link">Review Schedule</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container-fluid mt-2">
		<!--<div class="row">
			<a href="#" class="" id="expand-title" class="text-white"><img src="img/vsu-logo(100).png" style="height: 70px;"> Center for Continuing Education</a>
		</div>-->
		<div class="row">
			<div class="col-md-8 offset-md-2">
				<div class="card">
					<img class="img-fluid img-thumbnail" src="img/CCE.jpg">
					<!--
					<div class="row">
						<div class="col-md-10 offset-md-1">
							<div id="carouselIndicatorPictures" class="carousel slide" data-ride="carousel">
								<ol class="carousel-indicators">
									<li data-target="#" data-slide-to="0"></li>
									<li data-target="#" data-slide-to="1"></li>
									<li data-target="#" data-slide-to="2"></li>
								</ol>

								<div class="carousel-inner">
									<div class="carousel-item active">
										<img class="d-block w-100 h-75" src="img/CCE.jpg" alt="First slide">
									</div>
									<div class="carousel-item">
								      	<img class="d-block w-100 h-75" src="img/first.jpg" alt="Second slide">
								    </div>
								    <div class="carousel-item">
								      	<img class="d-block w-100 h-75" src="img/second.jpg" alt="Third slide">
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
							</div><!-- Carousel
						</div>
					</div>
					-->
				</div><!-- card -->
			</div>
		</div><!-- row -->
		<!--
		<div class="row mt-4">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header bg-dark text-white">
						<h3 class="card-title">Rooms</h3>
					</div>
					<div class="card-body" style="background: #e3d5d5">
						<div class="row">
							<div class="col-md-5">
								<img class="img-fluid img-thumbnail" src="img/first.jpg">
							</div>
							<div class="col-md-5 offset-md-1 card" id="firstRoom">
								<h4><b>First floor(Training Hall)</b></h4>
								<p>About this room....</p>
								<div id="firstLink">
									<a href="#">Click here >></a>
								</div>
							</div>
						</div>
						<div class="row" style="padding: 15px;">
							<div style="height: 5px;width: 100%;background: grey;border-radius: 15px;"></div>
						</div>
						<div class="row">
							<div class="col-md-5">
								<img class="img-fluid img-thumbnail" src="img/second.jpg">
							</div>
							<div class="col-md-5 offset-md-1 card" id="secondRoom">
								<h4><b>Second floor(Function Room)</b></h4>
								<p>About this room....</p>
								<div id="secondLink">
									<a href="#">Click here >></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div><!-- row -->
		<!--
		<div class="row mt-4">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header bg-dark text-white">
						<h3 class="card-title">Offers</h3>
					</div>
					<div class="card-body" style="padding: 0;">
						<div id="carouselIndicatorPictures" class="carousel slide" data-ride="carousel">
								<ol class="carousel-indicators">
									<li data-target="#" data-slide-to="0"></li>
									<li data-target="#" data-slide-to="1"></li>
									<li data-target="#" data-slide-to="2"></li>
								</ol>

								<div class="carousel-inner">
									<div class="carousel-item active">
										<img class="d-block w-100 h-75" src="img/CCE.jpg" alt="First slide">
									</div>
									<div class="carousel-item">
								      	<img class="d-block w-100 h-75" src="img/first.jpg" alt="Second slide">
								    </div>
								    <div class="carousel-item">
								      	<img class="d-block w-100 h-75" src="img/second.jpg" alt="Third slide">
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
							</div><!-- Carousel 
					</div>
				</div>
			</div>
		</div>-->
	</div>

</body>

</html>