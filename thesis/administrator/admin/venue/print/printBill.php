<html>

<head>

	<title>Print Bill</title>

	<script type="text/javascript" src="../../../lib/bootstrap4/js/jquery-3.2.1.min.js"></script>

	<link rel="stylesheet" type="text/css" href="../../../lib/bootstrap4/css/bootstrap.min.css">	

	<link rel="stylesheet" type="text/css" href="../../../lib/fontawesome-free-5.0.6/web-fonts-with-css/css/fontawesome-all.min.css">

	<link rel="stylesheet" href="../../../lib/sidebar/css/jquery.mCustomScrollbar.min.css">

	<script src="../../../lib/sidebar/js/jquery.mCustomScrollbar.concat.min.js.download"></script>

	<script type="text/javascript" src="../../../lib/bootstrap4/js/popper.min.js"></script>

	<script type="text/javascript" src="../../../lib/bootstrap4/js/bootstrap.min.js"></script>

</head>

<body onload="window.print()">

	<?php 
		session_start();
		if(!isset($_SESSION['username'])){
			header("Location: ../../../");
			//echo "Session not found";
		}

		else{
			$id= $_SESSION["id"];
			$name = $_SESSION["name"];
		}
	?>

	<div class="container-fluid">
		<div style="border: solid black 1px;padding: 1em;padding-bottom: 5em;">
			<div class="row">
				<div class="col-md-8 offset-md-2">
					<center><h3><img src="../../../images/vsu-logo(100).png" style="height: 50px;width: 50px;">CENTER FOR CONTINUING EDUCATION</h3></center>
					<center><h3>INVOICE</h3></center>
					<div class="float-right">
						
						<p>Invoice date: <?php echo date("F d, Y",strtotime($_GET["checkout"])) ?></p>
					</div>
				</div>
			</div>
			<div class="row" style="margin-top: 100px;">
				<div class="col-md-8 offset-md-2">
					<p>Name: <?php echo $_GET["name"] ?></p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8 offset-md-2">
					<p>Room used: <?php echo $_GET["room"] ?></p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8 offset-md-2">
					<p>Checked-in: <?php echo $_GET["checkin"] ?></p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8 offset-md-2">
					<p>Checked-out: <?php echo $_GET["checkout"] ?></p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8 offset-md-2">
					<p>Total Hours: <?php echo $_GET["hours"] ?></p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8 offset-md-2">
					<table class="table table-hover table-bordered">
						<thead>
							<th style="text-align: center;">Description</th>
							<th style="text-align: center;">Amount</th>
						</thead>
						<tbody>
							<?php 

								$data = "<tr>";
								$data .= "<td><center>Charge</center></td>";
								$data .= "<td><center>" . number_format($_GET["particularFee"],2)  . "</center></td>";
								$data .= "</tr>";
								if($_GET["amenityFee"]!=0){

									$data .= "<tr>";
									$data .= "<td><center>Equipment(s)</center></td>";
									$data .= "<td><center>" . number_format($_GET["amenityFee"],2)  . "</center></td>";
									$data .= "</tr>";
								}

								$data .= "<tr>";
								$data .= "<td style='text-align:right;'><b>Total</b></td>";
								$data .= "<td><center>" . number_format($_GET["totalFee"],2)  . "</center></td>";
								$data .= "</tr>";

								echo $data;
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	

</body>

</html>

<script>

	$(document).ready(function(){

			$.urlParam = function(name){
			var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
			if(results==null){
				return null;
			}
			else{
				return decodeURI(results[1]) || 0;
			}
		}

		

	});

</script>