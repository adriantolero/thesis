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

	<link rel="stylesheet" type="text/css" href="../../../css/function_bill.css">

	<script type="text/javascript" src="../../../scripts/modal.js"></script>
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
				
				<a href="#" class="navbar-brand ml-4" id="expand-title" class="text-white">Center for Continuing Education Records Management System</a>
				<a href="#" class="navbar-brand"  id="mini-title" data-original-title="Center for Continuing Education Records Management System" rel="tooltip"><strong class="text-white">CCERMS</strong></a>

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
           		<li><a href="#" data-toggle="collapse" data-target="#schedule-collapse"><i class="fa fa-calendar-alt"></i> Schedule</a>
	           			<ul class="collapse" id="schedule-collapse">
	           				<li class="list-unstyled components"><a href="../../schedule/review/">Review Schedule</a></li>
	           				<li class="list-unstyled components"><a href="../../schedule/function/">Venue Schedule</a></li>
	           			</ul>
	           		</li>
           		<li><a href="#" data-toggle="collapse" data-target="#billing-collapse"><i class="fa fa-clipboard"></i> Billing</a>
	           			<ul class="collapse" id="billing-collapse">
	           				<li class="list-unstyled components"><a href="../../billing/review/">Review</a></li>
	           				<li class="list-unstyled components"><a href="#"> Venue</a></li>
	           			</ul>
	           		</li>
	           		<li><a href="#" data-toggle="collapse" data-target="#reports-collapse"><i class="fa fa-bar-chart"></i> Reports</a>
	           			<ul class="collapse" id="reports-collapse">
	           				<li class="list-unstyled components"><a href="../../reports/review/">Review</a></li>
	           				<li class="list-unstyled components"><a href="#">Function</a></li>
	           				</li>
	           			</ul>
	           		</li>
           	</ul>
		</nav>

		<!-- Main Content -->
		<div class="container-fluid" id="content">		
			<div class="row">
			</div>
		</div><!-- Main content -->	

		<?php 
			
			//include "modals/vw-checkin-mdl.php";
		?>


		<div class="overlay">

		</div>
	</div><!-- wrapper -->
</body>	

</html>

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
	            url: "../../../controller/subQueries.php",
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
