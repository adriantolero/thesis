<?php
	
	session_start();
	include "../CRUD/reviewReports.php";
	$reports = new Reports();

	if(isset($_POST["function"])){

		if($_POST["function"]=="logout"){
			echo $reports->logout();
		}

		else if($_POST["function"]=="getReview"){
			echo $reports->getReview($_POST["search"]);
		}

		else if($_POST["function"]=="getReports"){

			echo json_encode($reports->getReports($_POST["i_rid"]/*,$_POST["displayBy"],$_POST["displayMonth"]*/));
		}
		/*
		else if($_POST["function"]=="getMonthlyReports"){
			echo json_encode($reports->getMonthlyReports($_POST["i_rid"]));
		}*/

	}

	else{
		echo "NOT FOUND";
	}

?>