<?php
	
	session_start();
	include_once "../CRUD/profile.php";
	$crud = new CRUD();

	if(isset($_POST["function"])){
		if($_POST["function"]=="getProfile"){
			echo json_encode($crud->getProfile($_SESSION["id"]));
		}

		else if($_POST["function"]=="updateProfile"){
			echo $crud->updateProfile($_POST["i_emp_id"],$_POST["fname"],$_POST["mi"],$_POST["lname"],$_POST["password"]);
		}
	}

?>