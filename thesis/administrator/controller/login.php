<?php
	session_start();
	include_once '../config/dbConfig.php';
	include_once "../CRUD/crud.php";

	$crud = new CRUD();

	if(isset($_POST["login"])){
		echo json_encode($crud->login($_POST['username'],$_POST["password"]));
	}
?>