<?php
	
	session_start();
	//include_once '../config/dbConfig.php';
	include_once "../CRUD/admin.php";

	$crud = new CRUD();

	if(isset($_POST["function"])){
		if($_POST["function"]=="getFunctionSched"){
			echo $crud->getFunctionSchedule();
		}
		else if($_POST["function"]=="getReviewSched"){
			echo $crud->getReviewSchedule();
		}
	}

?>