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
				include "../../CRUD/crud.php";

				$crud = new CRUD();
				$id = $_SESSION["id"];
				$name = $crud->getAdmin_name($_SESSION["id"]);
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
			<nav class="navbar navbar-expand-md navbar-dark bg-dark">
				<button id="sidebarCollapse" class="btn btn-success"  type="button"><i class="fa fa-bars"></i> <span id="hideToggle">Toggle Sidebar</span></button>
				
				<a href="#" class="navbar-brand ml-4" data-original-title="Center for Continuing Education Records Management System" rel="tooltip">CCERMS</a>
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
	           		<li><a href=".."><i class="fa fa-home"></i> Home</a></li>
	           		<li><a href="#"><i class="fa fa-cog"></i> Manage Accounts</a></li>
	           		<li class="active"><a href="#" data-toggle="collapse" data-target="#schedule-collapse"><i class="fa fa-calendar-alt"></i> Schedule</a>
	           			<ul class="collapse" id="schedule-collapse">
	           				<li class="list-unstyled components"><a href="review/index.php"><i class="fa fa-arrow-right"></i> Review Schedule</a></li>
	           				<li class="list-unstyled components"><a href="#"><i class="fa fa-arrow-right"></i> Function Schedule</a></li>
	           			</ul>
	           		</li>
	           		<li><a href="#"><i class="fa fa-cog"></i> Requests</a></li>
	           		<li><a href="#"><i class="fa fa-bar-chart"></i> Reports</a></li>
	           	</ul>
			</nav>

			<!-- Main Content -->
			<div class="container-fluid" id="content">			
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<nav aria-label="breadcrumb" role="navigation">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href=".."><i class="fa fa-home"></i> Home</a>
								</li>
								<li class="breadcrumb-item active" aria-curret="page"><i class="fa fa-calendar-alt"></i> Schedule
								</li>
							</ol>
						</nav>
					</div>
				</div><!-- Breadcrumb -->
				
				<!-- Schedule wrapper -->
				<div class="row">
					<div class="col-md-12">
					
						<div class="nav nav-tabs" id="nav-tab" role="tablist">	
							<a href="#v-pills-review-sched" class="nav-link active" data-toggle="pill" id="v-pills-review-sched-tab" role="tab" aria-controls="v-pills-review-sched" aria-selected="false">Review Schedule</a>
							<a href="#v-pills-function-sched" class="nav-link" data-toggle="pill" id="v-pills-function-sched-tab" role="tab" aria-controls="v-pills-function-sched" aria-selected="false">Function Schedule</a>	
						</div>
				
						<div class="tab-content mt-4" id="v-pills-tabContent">

							<!-- v-pills-home -->
							<!--
							<div class="tab-pane fade" id="v-pills-home" role="tabpanel" arialabelledby="v-pills-home-tab">
								<div class="row">
									<div class="col-md-12">
										<div class="card">
											<div class="card-header  bg-dark text-white">
												<h4 class="card-title">Today's Event</h4>
											</div>
											<div class="card-body" style="overflow-x: auto;">
												<table class="table table-hover">
													<thead>
														<tr class="bg-secondary text-white">
															<th>Room</th>
															<th>Description</th>
															<th>Date Start</th>
															<th>Time Start</th>
															<th>Date End</th>
															<th>Time End</th>
														</tr>
													</thead>
													<tbody id="dataTodaySchedule">
														<?php
															//$crud->getschedToday();
														?>
													</tbody>
												</table>
											</div><!-- end card-body 
										</div><!-- end card 
										
									</div>
								</div><!-- end row 

								<div class="row mt-3">
									<div class="col-md-12">
										<div class="card">
											<div class="card-header bg-dark text-white">
												<h4 class="card-title">Upcoming event(s)</h4>
											</div>
											<div class="card-body">

											</div>	
										</div>
									</div>
								</div>
							</div>--><!-- end v-pills-home -->

							<!-- Search Schedule form -->
							<div class="tab-pane fade show active" id="v-pills-review-sched" role="tabpanel" arialabelledby="v-pills-review-sched-tab">
								<form id="searchForm">
									<div class="form-group row">
										<label for="searchInput" class="col-md-1 col-form-label">Search</label>
										<div class="col-md-3">
											<input type="text" id="searchInput" class="form-control" placeholder="Description">
										</div>

										<label for="roomOption" class="col-md-1 col-form-label">Room</label>
										<div class="col-md-2">
											<select id="roomOption" class="form-control">
												<option value=""></option>
												<?php
													$crud->getRoom();
												?>
											</select>
										</div>

										<label for="searchDate" class="col-md-1 col-form-label">Date</label>
										<div class="col-md-2">
											<input type="text" id="searchDate" class="form-control" placeholder="yyyy-mm-dd">
										</div>
										
									</div>
								</form>

								<!-- Schedule Table -->
								<div class="row">
									<div class="col-md-12" style="height: 300px;overflow-x: auto;overflow-y: auto;">
										<table class="table table-hover" id="tableSchedule">
											<thead class="thead-primary">
												<tr class="bg-dark text-white">
													<th style="width: 10%">Room</th>
													<th style="width: 20%">Description</th>
													<th style="width: 15%">Date Start</th>
													<th style="width: 10%">Time Start</th>
													<th style="width: 15%">Date End</th>
													<th style="width: 10%">Time End</th>
													<th colspan="3"><center>Actions</center></th>
													<!--<th ><center>Edit</center></th>
													<th ><center>Delete</center></th>-->
												</tr>	
											</thead>
											<tbody id="dataSchedule">
												<?php
													//$crud->getReviewsched();
													/*
													include "../../php/connect.php";

													$sql= "SELECT `rm`.`str_rmName`,`rs`.`i_rid`,`rs`.`str_description`,`rs`.`dt_start`,`rs`.`dt_end` FROM `room` `rm`
														INNER JOIN `review_schedule` `rs` 
														ON `rm`.`i_rm_id`=`rs`.`i_rm_id` ORDER BY `rs`.`dt_start` DESC";
													$result = $conn->query($sql);
													if($result->num_rows > 0){
														while ($row= $result->fetch_assoc()) {
															/*
															echo "<tr><td>" . $row["str_rmName"] . "</td><td>" . $row["str_description"] . "</td><td>" . date("F d, Y",strtotime($row["dt_start"])) . "</td><td>" . date("g:ia",strtotime($row["dt_start"])) . "</td><td>" . date("F d, Y",strtotime($row["dt_end"])) . "</td><td>" . date("g:ia",strtotime($row["dt_end"])) . "</td><td>" . "<a href='manage.php?sid=" . $row["i_rid"] . "'" . "target='_blank' class='btn btn-primary' id='viewSched-btn' data-id='" . $row["i_rid"] . "'>View</a>";
															//end here

															echo "<tr><td>" . $row["str_rmName"] . "</td><td>" . $row["str_description"] . "</td><td>" . date("F d, Y",strtotime($row["dt_start"])) . "</td><td>" . date("g:ia",strtotime($row["dt_start"])) . "</td><td>" . date("F d, Y",strtotime($row["dt_end"])) . "</td><td>" . date("g:ia",strtotime($row["dt_end"])) . "</td><td>" . "<a href='#' class='btn btn-primary' id='viewSched-btn' data-id='" . $row["i_rid"] . "'>View</a>";
														}
													}
													*/
												?>
											</tbody>
											
										</table>
									</div>
								</div><!-- row table -->
								<div class="row">
									<div class="col-md-4 offset-md-4" id="btn-wrapper" style="text-align: center;">
										<button class="btn btn-success" id="open-addReview-modal" data-toggle="modal" data-target="#addReview-modal"><i class="fa fa-calendar-plus"></i> Book Review</button>
									</div>
								</div>
							</div><!-- end v-pills-home -->

							<!-- v-pills-function-sched -->
							<div class="tab-pane fade" id="v-pills-function-sched" role="tabpanel" arialabelledby="v-pills-function-sched-tab">
								<h1>Function Schedule</h1>
							</div><!-- end v-pills-create-sched -->
						</div><!-- Tab-content -->
					</div><!-- col-md-10 -->
				</div><!-- Schedule wrapper -->

			</div><!-- Main content -->

			<!-- MY INFO MODAL -->
			<div class="modal fade" id="profile" tabindex="-1" role="dialog" aria-labelledby="profile" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header text-white" style="background-color: #487aad;">	
							<h5 class="modal-title">Profile</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
        					</button>
						</div>
						<div class="modal-body text-white" style="background-color: #8ab8e6;">
							
							<div class="row">
								<div class="col-md-4 offset-md-4" style="text-align: center;">
									<img src="../../images/admin2.png" class="img-fluid rounded" id="myImage" style="min-width: 150px;min-width: 150px;">
									<div style="height:0px;overflow:hidden">
									   <input type="file" id="fileInput" name="fileInput" onchange="loadFile(event)" />
									</div>
									<button type="button" class="btn btn-primary btn-sm mt-1" onclick="chooseFile()">Change</button>
								</div>	
							</div>
							<div class="row">
								<div class="col-md-12">
									<form class="mt-4">
										<div class="form-group row">
											
											<div class="col-md-4 col-sm-4">
												<label class="col-form-label" for="fname">First Name</label>
												<input type="text" id="fname" class="form-control" placeholder="First Name">
											</div>
											<div class="col-md-4 col-sm-4">
												<label class="col-form-label" for="mi">M.I</label>
												<input type="text" id="mi" class="form-control" placeholder="M.I">
											</div>
											<div class="col-md-4 col-sm-4">
												<label class="col-form-label" for="lname">Last Name</label>
												<input type="text" id="lname" class="form-control" placeholder="M.I">
											</div>
										</div>
										<div class="form-group row">
											<div class="col-md-5 offset-md-1 offset-sm-1 col-sm-5">
												<label class="col-form-label" for="username">Username</label>
												<input type="text" id="username" class="form-control" placeholder="username">
											</div>
											<div class="col-md-5 col-sm-5">
												<label class="col-form-label" for="password">Password</label>
												<input type="password" id="password" class="form-control" placeholder="password">
											</div>
										</div>
									</form>
								</div>
							</div>
						</div><!-- modal-body -->
						<div class="modal-footer bg-dark text-white">
							<button class="btn btn-primary" id="save-myInfo" style="width: 100%;">Save <i class="fa fa-save"></i></button>
						</div>
					</div>
				</div>	
			</div><!-- My Info modal -->

			<!-- View Schedule Modal -->
			<div class="modal fade" id="viewSched-modal"  tabindex="-1" role="dialog" aria-labelledby="View Schedule" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Schedule</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
        					</button>
						</div>
						<div class="modal-body">
						</div>
						<div class="modal-footer">
						</div>
					</div>
				</div>
			</div>

			<!-- Create Schedule Modal -->
			<div class="modal fade" id="addReview-modal" tabindex="-1" role="dialog" aria-labelledby="Add Schedule" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content bg-dark text-white">
						<div class="modal-header">
							<h3 class="modal-title">
								Review Schedule
							</h3>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
        					</button>
						</div>
						<div class="modal-body">
							<form>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">Room</span>
									</div>
									<select id="create-room" class="col-md-4 form-control">
										<option value="0"></option>
										<?php
											$crud->getRoom();
										?>
									</select>								
								</div>
								<div class="mr-auto mb-3" id="create-room-msg"></div>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">Description</span>
									</div>
									<input type="text" id="create-description" class="form-control" placeholder="Title of the review" />
								</div>
								<div class="mr-auto mb-3" id="create-description-msg"></div>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">Reviewee</span>
									</div>
									<input type="text" id="create-reviewee" class="form-control" placeholder="Name of reviewee">
								</div>
								<div class="mr-auto mb-3" id="create-reviewee-msg"></div>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">No. of participants</span>
									</div>
									<input type="text" id="create-num-reviewers" class="col-md-4 form-control" placeholder="0">
								</div>
								<div class="mr-auto mb-3" id="create-num-reviewers-msg"></div>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">Date start</span>
									</div>
									<input type="text" id="create-date-start" class="col-md-6 form-control">
								</div>
								<div class="mr-auto mb-3" id="create-date-start-msg"></div>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">Date end</span>
									</div>
									<input type="text" id="create-date-end" class="col-md-6  form-control">
								</div>
								<div class="mr-auto mb-3" id="create-date-end-msg"></div>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">Review Fee</span>
									</div>
									<input type="text" id="create-reviewFee-vsu" class="col-md-4 form-control" placeholder="VSU graduate">
								</div>
								<div class="mr-auto mb-3" id="create-reviewFee-vsu-msg"></div>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">Review Fee</span>
									</div>
									<input type="text" id="create-reviewFee-nonVsu" class="col-md-4 form-control" placeholder="Non-VSU graduate">
								</div>
								<div class="mr-auto mb-3" id="create-reviewFee-nonVsu-msg"></div>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">Status</span>
									</div>
									<select id="create-status" class="col-md-4 form-control">
										<option value="0">Inactive</option>
										<option value="1">Active</option>
									</select>						
								</div>
								<div class="mr-auto mb-3" id="create-status-msg"></div>
							</form>
						</div>
						<div class="modal-footer">							
							<button class="btn btn-success mr-auto" id="createReviewSched"><i class="fa fa-calendar-check"></i> Book now</button>
						</div>
					</div>
				</div>
			</div>

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
                url: "../../controller/schedule.php",
                data: {logout: "logout"},
                success: function(data){
                    if(data=="User Logout"){
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

        /**********************************
        		SET DATETIME PICKER
        **********************************/

        $("#searchDate").datetimepicker({
        	timepicker: false,
        	format: 'Y-m-d',
        	formatDate: 'Y/m/d'
        });

        var dateToday = new Date();
        $("#create-date-start, #create-date-end").datetimepicker({
        	format: 'Y-m-d H:i',
        	step: 30,
        	minDate: dateToday,
        	onSelect: function(selectedDate) {
		        var option = this.id == "create-date-end" ? "minDate" : "maxDate",
		            instance = $(this).data("datepicker"),
		            date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
		        dates.not(this).datepicker("option", option, date);
		    }
        });
        /*
        $("#create-date-end").datetimepicker({
        	format: 'Y-m-d H:i',
        	step: 30
        });
		*/
		/**********************************
					GET MY INFO
		**********************************/

		/**********************************
					DISPLAY SCHEDULE
		**********************************/
		function getReviewSched(){
			$.ajax({
				type: "POST",
				url: "../../controller/schedule.php",
				data: {reviewSchedule: "display"},
				success: function(data){
					console.log(data);
					$("#dataSchedule").html(data);
				}
			});
		}

		getReviewSched();
		/**********************************
					SEARCH SCHEDULE
		**********************************/

		function searchReview(){
			$.ajax({
				type: "POST",
				url: "../../controller/schedule.php",
				data:{
					description: $("#searchInput").val(),
					room: $("#roomOption").val(),
					//sort: $("#sortSchedule").val(),
					date: $("#searchDate").val(),
					searchReview: "search"
				},
				success: function(data){
					console.log(data);
					$("#dataSchedule").html(data);
				}
			});
		}

		$("#searchInput").on("input",function(){
			searchReview();
		});

		$("#roomOption").on("change",function(){
			searchReview();
		});

		$("#searchDate").on("input",function(){
			searchReview();
		});
		$("#searchDate").on("change",function(){
			searchReview();
		});

		/**************************
				Create Review
		***************************/

		$("#createReviewSched").click(function(event){

			event.preventDefault();
			
			if($("#create-room").val() == 0 || $("#create-description").val() == "" || $("#create-reviewee").val() == "" || $("#create-date-start").val() == "" || $("#create-date-end").val() == "" || $("#create-reviewFee-vsu").val() == "" || $("#create-reviewFee-nonVsu").val() == "" || $("#create-num-reviewers").val() == ""){

				if($("#create-room").val() == 0){
					$("#create-room-msg").html("*Please select room.");
				}
				else{
					$("#create-room-msg").html("");
				}

				if($("#create-description").val()==""){
					$("#create-description-msg").html("*Please fill this field.");
				}
				else{
					$("#create-description-msg").html("");
				}
				if($("#create-reviewee").val() == ""){
					$("#create-reviewee-msg").html("*Please fill this field.");
				}
				else{
					$("#create-reviewee-msg").html("");
				}
				if($("#create-date-start").val() == ""){
					$("#create-date-start-msg").html("*Please fill this field.");
				} 
				else{
					$("#create-date-start-msg").html("");
				}
				if($("#create-date-end").val() == "" ){
					$("#create-date-end-msg").html("*Please fill this field.");
				}
				else{
					$("#create-date-end-msg").html("");
				}
				if($("#create-reviewFee-vsu").val() == ""){
					$("#create-reviewFee-vsu-msg").html("*Please fill this field.");
				}
				else{
					$("#create-reviewFee-vsu-msg").html("");
				}
				if($("#create-reviewFee-nonVsu").val() == ""){
					$("#create-reviewFee-nonVsu-msg").html("*Please fill this field.");
				} 
				else{
					$("#create-reviewFee-nonVsu-msg").html("");
				}
				if($("#create-num-reviewers").val() == ""){
					$("#create-num-reviewers-msg").html("*Please fill this field.");	
				}
				else{
					$("#create-num-reviewers-msg").html("");	
				}
		
			}

			else{
				$.ajax({
					type: "POST",
					url: "../../controller/schedule.php",
					data: {
						room_id: $("#create-room").val(),
						description: $("#create-description").val(),
						reviewee: $("#create-reviewee").val(),
						date_start: $("#create-date-start").val(),
						date_end: $("#create-date-end").val(),
						review_fee_vsu: $("#create-reviewFee-vsu").val(),
						review_fee_non_vsu: $("#create-reviewFee-nonVsu").val(),
						reviewers: $("#create-num-reviewers").val(),
						status: $("#create-status").val(),
						createReviewSched: "create"
					},
					success: function(data){
						console.log(data);
						alert(data);
						/*var input = confirm("Do you want to input?");
						if(input==true){
							$("#create-description").val("");
							$("#create-reviewee").val("");
							$("#create-date-start").val("");
							$("#create-date-end").val("");
							$("#create-reviewFee-vsu").val("");
							$("#create-reviewFee-nonVsu").val("");
							$("#create-num-reviewers").val("");
							//$("#create-status").val("1");
						}
						else{
							//alert("WOW!!!!");
						}*/
						getReviewSched();
					},
					error: function(data){
						console.log(data);
					}
				});
			}
			
		});

		/*$("#sortSchedule").on("change",function(){
			searchSchedule();
		});*/

		/*
		$('#searchYear').datetimepicker({
			formatTime:'h:i a',
			formatDate:'d.m.Y',
			//defaultDate:'8.12.1986', // it's my birthday
			/*defaultDate:'+03.01.1970', // it's my birthday
			defaultTime:'10:00',
			
			timepickerScrollbar:false
		});
		*/
		//END SEARCH SCHEDULE


		// View schedule details
		$("#tableSchedule").on("click","#viewSched-btn",function(){
			alert($(this).data("id"));
		});

		$("#tableSchedule").on("click","#editSched-btn",function(){
			alert($(this).data("id"));
		});

		$("#tableSchedule").on("click","#deleteSched-btn",function(){
			$.ajax({
				type: "POST",
				url: "../../controller/schedule.php",
				data:{
					sched_id: $(this).data("id"),
					deleteSched_btn: "delete"
				},
				success: function(data){
					alert(data);
					getReviewSched();
				}
			});
		});

		$("#btn-add-reviewSched").click(function(){
			/*var c = confirm("You want to view this?");
			if(c == false) return false;*/
		});
		
     });
</script>

