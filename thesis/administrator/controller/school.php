<?php

	session_start();
	include_once "../CRUD/school.php";
	$crud = new CRUD();

	if(isset($_POST["function"])){
		if($_POST["function"]=="getSchool"){
			echo $crud->getSchool($_POST["schoolName"]);
		}

		else if($_POST["function"]=="addSchool"){
			echo $crud->addSchool($_POST["schoolName"],$_POST["schoolAddress"],$_POST["schoolType"]);
		}

		else if($_POST["function"]=="deleteSchool"){
			echo $crud->deleteSchool($_POST["i_sid"]);
		}

		else if($_POST["function"]=="getSchoolInfo"){
			echo json_encode($crud->getSchoolInfo($_POST["i_sid"]));
		}

		else if($_POST["function"]=="updateSchool"){
			echo $crud->updateSchool($_POST["i_sid"],$_POST["schoolName"],$_POST["schoolAddress"],$_POST["schoolType"]);
		}
	}

?>