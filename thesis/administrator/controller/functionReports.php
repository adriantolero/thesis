<?php
	
	session_start();
	include_once "../CRUD/functionReports.php";
	$crud = new CRUD();

	if(isset($_POST["function"])){
		if($_POST["function"]=="getReports"){
			//echo json_encode($crud->getReports());
			echo $crud->getReports();
		}
	}

?>