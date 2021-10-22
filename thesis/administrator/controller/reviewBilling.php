<?php

	session_start();
	include_once "../CRUD/reviewBilling.php";
	include_once "../CRUD/checker.php";
	$crud = new CRUD();
	$checker = new Checker();

	if(isset($_POST["function"])){
		if($_POST["function"]=="searchReview"){
			echo $crud->getReviewSchedule($_POST["search"]);
		}

		else if($_POST["function"]=="searchReviewer"){
			echo $crud->getReviewer($_POST["i_rid"],$_POST["search"]);
		}

		/*else if($_POST["function"]=="getSchool"){
			echo $crud->getSchool();
		}*/

		else if($_POST["function"]=="getInfo"){
			echo json_encode($crud->getInfo($_POST["i_rev_id"]));
		}

		else if($_POST["function"]=="getBills"){
			echo json_encode($crud->getBills($_POST["i_rev_id"],$_POST["fee"]));
		}

		else if($_POST["function"]=="getSchoolFee"){
			echo $crud->getSchoolFee($_POST["i_rev_id"],$_POST["school_id"]);
		}

		else if($_POST["function"]=="addBill"){
			
			if($checker->checkBill($_POST["i_rid"],$_POST["i_rev_id"],$_POST["amount_paid"])==1){
				echo "This reviewee has 0 balance.";
			}
			else if($checker->checkBill($_POST["i_rid"],$_POST["i_rev_id"],$_POST["amount_paid"])==2){
				echo "The payment you input exceeds the remaining balance.";
			}
			else if($checker->checkBill($_POST["i_rid"],$_POST["i_rev_id"],$_POST["amount_paid"])==0){
				echo $crud->createBill($_POST["i_rid"],$_POST["i_rev_id"],$_POST["description"],$_POST["or_num"],$_POST["amount_paid"],$_POST["date_paid"]);
			}
		}

		else if($_POST["function"]=="deleteBill"){
			echo $crud->deleteBill($_POST["bill_id"]);
		}

		else if($_POST["function"]=="getBill"){
			echo json_encode($crud->getBill($_POST["bill_id"]));
		}

		else if($_POST["function"]=="updateBill"){
			if($checker->checkBill_update($_POST["i_rid"],$_POST["i_rev_id"],$_POST["bill_id"],$_POST["amount_paid"])==1){
				echo "This reviewee has 0 balance.";
			}
			else if($checker->checkBill_update($_POST["i_rid"],$_POST["i_rev_id"],$_POST["bill_id"],$_POST["amount_paid"])==2){
				echo "The payment you input exceeds the remaining balance.";
			}
			else if($checker->checkBill_update($_POST["i_rid"],$_POST["i_rev_id"],$_POST["bill_id"],$_POST["amount_paid"])==0){
				echo $crud->updateBill($_POST["bill_id"],$_POST["description"],$_POST["or_num"],$_POST["amount_paid"],$_POST["date_paid"]);
			}
			
			//
			
		}

		else if($_POST["function"]=="createSchool"){
			echo $crud->createSchool($_POST["school"],$_POST["address"],$_POST["school_type"]);
		}
	}
?>