<!DOCTYPE html>
<html>
<head>
	<title>Administrator</title>
	<!-- bootstrap v4 -->
	<script type="text/javascript" src="../lib/bootstrap4/js/jquery-3.2.1.min.js"></script>
	
	<link rel="stylesheet" type="text/css" href="../lib/bootstrap4/css/bootstrap.min.css">

   	<link rel="stylesheet" type="text/css" href="../lib/fontawesome-free-5.0.6/web-fonts-with-css/css/fontawesome-all.min.css">

   	<link rel="stylesheet" href="../lib/sidebar/css/jquery.mCustomScrollbar.min.css">

   	<script src="../lib/sidebar/js/jquery.mCustomScrollbar.concat.min.js.download"></script>

   	<script type="text/javascript" src="../lib/bootstrap4/js/popper.min.js"></script>

   	<script type="text/javascript" src="../lib/bootstrap4/js/bootstrap.min.js"></script>

   	<!--<script src="../css/jquery.mCustomScrollbar.concat.min.js.download"></script>-->
	<link rel="stylesheet" type="text/css" href="../css/sidebar.css">

	<link rel="stylesheet" type="text/css" href="../css/home.css">

	<?php
	
		session_start();
		if(!isset($_SESSION['username'])){
			header("Location: ../");
			echo "Session not found";
		}

		else{
			
			include_once "../CRUD/crud.php";
			//include "../CRUD/subQueries.php";
			//$crud = new CRUD();
			//$id = $_SESSION["id"];
			//$name = $crud->getAdmin_name($_SESSION["id"]);
			$name = $_SESSION["name"];
		}
		
	?>

</head>

<body>
	<div class="wrapper">
		<nav class="navbar navbar-expand-md navbar-dark bg-dark" id="navbar-top">
			<button id="sidebarCollapse" class="btn btn-success"  type="button"><i class="fa fa-bars"></i> <span id="hideToggle">Menu</span></button>
			
			<a href="#" class="navbar-brand ml-4" id="expand-title" class="text-white"><img src="../images/vsu-logo(100).png" style="height: 70px;width: 70px;" />Center for Continuing Education Records Management System</a>
			<a href="#" class="navbar-brand"  id="mini-title" data-original-title="Center for Continuing Education Records Management System" rel="tooltip"><strong class="text-white"><img src="../images/vsu-logo(100).png" style="height: 70px;width: 70px;" />CCERMS</strong></a>

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
           		<img src="../images/admin2.png" class="rounded-circle ml-2" id="myProfilepic">
           		<div id="welcome">
	           		<div id="myName"><h5 style="display: inline;"><?php echo utf8_encode($name); ?></h5>
	           			<input type="text" id="myID" style="display: none" value=<?php //echo $id ?>>
	           		</div>
	           		<div id="btn-profile-wrapper">
	           			<a href="profile.php" id="openProfile" class="btn btn-info btn-sm">Profile</a>
	           		</div>
	           	</div>
           	</div>

           	<!-- Sidebar Links -->
           	<ul class="list-unstyled components">
           		<li class="active"><a href="#"><i class="fa fa-home"></i> Home</a></li>
           		<?php 
           			if($_SESSION["username"]=="admin"){
           				echo '<li><a href="accounts/accounts.php"><i class="fa fa-cog"></i> Manage Accounts</a></li>';
           			}
           		?>
           		<li>
           			<a href="#" data-toggle="collapse" data-target="#review-collapse">
           				<i class="fa fa-book fa-fw"></i>Review
           			</a>
           			<ul class="collapse" id="review-collapse">
           				<li class="list-unstyled components">
           					<a href="review/schedule.php"><span class="ml-2"><i class="fa fa-calendar-alt fa-fw"></i>Schedule</span></a>
           				</li>
           				<li class="list-unstyled components">
           					<a href="review/reservations.php"><span class="ml-2"><i class="fa fa-users fa-fw"></i>Reservations</span></a>
           				</li>
           				<li class="list-unstyled components">
           					<a href="review/billing.php"><span class="ml-2"><i class="fa fa-clipboard fa-fw"></i>Billing</span></a>
           				</li>
           				<li class="list-unstyled components">
           					<a href="review/reports.php"><span class="ml-2"><i class="fa fa-chart-bar fa-fw"></i>Reports</span></a>
           				</li>
           				<li class="list-unstyled components">
           					<a href="#" data-toggle="collapse" data-target="#review-manage-collapse"><span class="ml-2"><i class="fa fa-cogs fa-fw"></i> Manage</span></a>
           					<ul class="collapse" id="review-manage-collapse">
           						<li class="list-unstyled components">
           							<a href="review/manage/school.php"><span class="ml-4"><i class="fa fa-university fa-fw"></i>School</span></a>
           						</li>
           						<li class="list-unstyled components">
           							<a href="review/manage/course.php"><span class="ml-4"><i class="fa fa-graduation-cap fa-fw"></i>Course & Major</span></a>
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
           					<a href="venue/schedule.php"><span class="ml-2"><i class="fa fa-calendar-alt fa-fw"></i>Schedule</span></a>
           				</li>
           				<li class="list-unstyled components">
           					<a href="venue/reports.php"><span class="ml-2"><i class="fa fa-chart-bar fa-fw"></i>Reports</span></a>
           				</li>
           				<li class="list-unstyled components">
           					<a href="#" data-toggle="collapse" data-target="#venue-manage-collapse"><span class="ml-2"><i class="fa fa-cogs fa-fw"></i> Manage</span></a>
           					<ul class="collapse" id="venue-manage-collapse">
           						<li class="list-unstyled components">
           							<a href="venue/manage/rates.php"><span class="ml-4"><i class="fa fa-money-bill-alt fa-fw"></i>Rates</span></a>
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
				<div class="col-md-8 offset-md-2">
					<div class="card">
						<img class="img-fluid img-thumbnail" src="../images/CCE.jpg">
					</div>
				</div>
			</div>
			
		</div><!-- content -->

		<div class="overlay">

		</div>
	</div><!-- wrapper -->
</body>	

</html>

<script>
	function chooseFile(){
		 $("#fileInput").click();
	}

	var loadFile = function(event) {
	    var myImage = document.getElementById('myImage');
	    myImage.src = URL.createObjectURL(event.target.files[0]);
	};
	
     $(document).ready(function () {
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


		$("#logout-btn").click(function(){
            $.ajax({
                type: "POST",
                url: "../controller/subQueries.php",
                data: {function: "logout"},
                success: function(data){
                    if(data==true){
                        window.location.href = "../index.php";
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

        function getFunctionSched(){
        	$.ajax({
        		type: "POST",
        		url: "../controller/admin.php",
        		data: {
        			function: "getFunctionSched"
        		},
        		success: function(data){
        			$("#functionSched").html(data);
        		}
        	});
        }

        getFunctionSched();

        function getReviewSched(){
        	$.ajax({
        		type: "POST",
        		url: "../controller/admin.php",
        		data: {
        			function: "getReviewSched"
        		},
        		success: function(data){
        			//alert(data);
        			$("#reviewSched").html(data);
        		}
        	});
        }

        getReviewSched();

		/*
		$("#openProfile").click(function(){
			$.ajax({
				type: "POST",
				url: "../controller/admin.php",
				data: {
					profile: "open",

				},
			});
		});*/
		/*
		$.ajax({
			type: "POST",
			url: "getData/getmyInfo.php",
			data: {
				id: $("#myID").val()
			},
			success: function(data){
				console.log(data);
				var data = jQuery.parseJSON(data);
				$("#fname").val(data.fname);
				$("#mi").val(data.mi);
				$("#lname").val(data.lname);
				$("#username").val(data.username);
				$("#password").val(data.password);

			},
			error:function(data){
				console.log(data);
			}
		});
		*/
     });
</script>

