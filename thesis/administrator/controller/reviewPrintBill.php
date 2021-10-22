<?php
	
 	session_start();
 	include "../CRUD/reviewPrintBill.php";
 	$print = new PrintBill();

 	if(isset($_POST["function"])){
 		if($_POST["function"]=="getBill"){
 			echo json_encode($print->getBill($_POST["i_rid"],$_POST["i_rev_id"]));
 			//echo $_POST["i_rev_id"];
 		}
 	}
?>