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
   	<?php 
   		session_start();
   		if(!isset($_SESSION['username'])){
			header("Location: ../../..");
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
   	?>
</head>
<body>
	<div class="row" style="margin-top: 100px;">
		<div class="col-md-8 offset-md-2" style="border: solid black 1px">
			<div class="row">
				<div class="col-md-12">
					<div style="text-align: center;margin-top: 50px;">
						<h3><img src="../../../images/vsu-logo(100).png" style="height: 50px;width: 50px;">Center for Continuing Education</h3>
						<h3><span id="reviewTitle"></span></h3>
					</div>
					<div style="margin-top: 50px;">
						<p>Name: <span id="name" style="margin-left: 5px;"></span></p>
						<p>School:<span id="school" style="margin-left: 5px;"></span></p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table align="center" class="table table-bordered">
						<thead>
							<th style="text-align: center;">Description</th>
							<th style="text-align: center;">Amount</th>
						</thead>
						<tbody id="tbodyFee">
						</tbody>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8">
					<p class="float-right">Review fee:</p>
				</div>
				<div class="col-md-4">
					<span id="reviewFee"></span>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8">
					<p class="float-right">Amount paid:</p>
				</div>
				<div class="col-md-4">
					<span id="amountPaid"></span>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8">
					<p class="float-right">Balance:</p>
				</div>
				<div class="col-md-4">
					<span id="balance"></span>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<script type="text/javascript" src="../../../scripts/reviewPrintBill.js"></script>