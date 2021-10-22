<?php
	include_once "../crud/roomSchedule.php";
	$crud = new CRUD();

	if(isset($_POST["function"])){
		if($_POST["function"]=="getVaccant"){
			echo $crud->getSchedule($_POST["room"],$_POST["search"]);
		}
	}
?>