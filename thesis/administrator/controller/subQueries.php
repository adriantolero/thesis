<?php
	
	session_start();
	include_once "../CRUD/subQueries.php";

	$crud = new CRUD();

	if(isset($_POST["function"])){
		if($_POST["function"]=="login"){
			echo $crud->login($_POST["username"],$_POST["password"]);
		}
		else if($_POST["function"]=="logout"){
			echo $crud->logout();
		}
	}

?>