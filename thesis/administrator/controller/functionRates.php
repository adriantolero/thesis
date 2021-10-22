<?php

	session_start();
	include_once "../CRUD/functionRates.php";
	$crud = new CRUD();

	if(isset($_POST["function"])){
		if($_POST["function"]=="getRates"){
			echo $crud->getRates();
		}

		else if($_POST["function"]=="getRateInfo"){
			echo json_encode($crud->getRateInfo($_POST["i_pid"]));
		}

		else if($_POST["function"]=="updateRate"){
			echo $crud->updateRate($_POST["i_pid"],$_POST["firstHour"],$_POST["succeedingHour"]);
		}

	}

?>