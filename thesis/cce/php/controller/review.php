<?php
	
	session_start();
	include_once "../crud/review.php";

	$crud = new CRUD();
	
	if (isset($_POST["function"])) {
		if($_POST["function"]=="getReview"){
			echo $crud->getReview();
		}

		else if($_POST["function"]=="getSchool"){
			echo $crud->getSchool();
		}

		else if($_POST["function"]=="getCourse"){
			echo $crud->getCourse();
		}

		else if($_POST["function"]=="getMajor"){
			echo $crud->getMajor($_POST["course_id"]);
		}

		else if($_POST["function"]=="createSchool"){
			echo $crud->createSchool($_POST["school_name"],$_POST["school_address"]);
		}

		else if($_POST["function"]=="createCourse"){
			echo $crud->createCourse($_POST["course"]);
		}

		else if($_POST["function"]=="createMajor"){
			echo $crud->createMajor($_POST["course_id"],$_POST["major"]);
		}

		else if($_POST["function"]=="submitForm"){
			echo $crud->createReservation($_POST["i_rid"],$_POST["fname"],$_POST["mi"],$_POST["lname"],$_POST["bdate"],$_POST["address"],$_POST["contact"],$_POST["email"],$_POST["school"],$_POST["course"],$_POST["major"],$_POST["yrGrad"],$_POST["lodge"]);
		}

		else if($_POST["function"]=="viewSubmit-form"){
			echo $crud->viewSubmittedForm($_POST["i_rid"],$_POST["fname"],$_POST["mi"],$_POST["lname"],$_POST["bdate"],$_POST["address"],$_POST["contact"],$_POST["email"],$_POST["school"],$_POST["major"],$_POST["yrGrad"],$_POST["lodge"]);
		}
	}

?>