<?php

	session_start();
	include_once "../CRUD/accounts.php";
	$crud = new CRUD();

	if(isset($_POST["function"])){

		if($_POST["function"]=="getAccounts"){
			echo $crud->getAccounts($_POST["search"],$_POST["category"]);
		}

		else if($_POST["function"]=="createAccount"){
			if($crud->checkUsername($_POST["username"])){
				echo "Username is already taken.";
			}
			else{
				echo $crud->createAccount($_POST["username"],$_POST["password"],$_POST["fname"],$_POST["mi"],$_POST["lname"]);
			}
			
		}

		else if($_POST["function"]=="getUserInfo"){
			echo json_encode($crud->getUserInfo($_POST["i_emp_id"]));
		}

		else if($_POST["function"]=="updateUserInfo"){
			if($crud->updateUserInfo_checkUsername($_POST["i_emp_id"],$_POST["username"])){
				echo "Username is already taken.";
			}
			else{
				echo $crud->updateUserInfo($_POST["i_emp_id"],$_POST["username"],$_POST["password"],$_POST["fname"],$_POST["mi"],$_POST["lname"]);
			}
			
		}

		else if($_POST["function"]=="deleteUser"){
			echo $crud->deleteUser($_POST["i_emp_id"]);
		}

	}

?>