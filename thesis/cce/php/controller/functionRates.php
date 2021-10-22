<?php

	session_start();
	include_once "../CRUD/functionRates.php";
	$crud = new CRUD();

	if(isset($_POST["function"])){
		if($_POST["function"]=="getRate"){
			echo $crud->getRates();
		}
	}

?>