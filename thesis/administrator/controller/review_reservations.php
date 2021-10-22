<?php
	
	session_start();
	include_once "../CRUD/review_reservations.php";
	include_once "../CRUD/checker.php";

	$crud = new CRUD();
	$checker = new Checker();
	
	
	if(isset($_POST["getReservation"])){
		if($_POST["getReservation"]=="fillReservationScheds"){
			$crud->fillReservedSched();
		}
	}

	else if(isset($_POST["fill_reserved_search_sched"])){
		if($_POST["fill_reserved_search_sched"]=="autofill"){
			$crud->fillReservedSched();
		}
	}

	else if(isset($_POST["getApproved"])){
		if($_POST["getApproved"]=="get"){
			//echo json_encode($crud->getApproved($_POST["review_id"]));
			echo $crud->getApproved($_POST["review_id"]);
		}
	}

	else if(isset($_POST["vw_requests"])){
		if($_POST["vw_requests"]=="get"){
			echo $crud->getRequests($_POST["review_id"],$_POST["search"],$_POST["searchBy"]);
		}
	}

	else if(isset($_POST["reserved_search_sched"])){
		if($_POST["reserved_search_sched"]=="search"){
			echo $crud->searchReservedSched($_POST["search"]);
		}
	}

	else if(isset($_POST["searchApproved"])){
		if($_POST["searchApproved"]=="search"){
			echo $crud->searchApproved($_POST["review_id"],$_POST["search"],$_POST["searchBy"]);
		}
	}

	else if(isset($_POST["accept_reviewer"])){
		if($_POST["accept_reviewer"]=="accept"){
			if($checker->checkReviewerSlot($_POST["review_id"])==1){
				echo "There's no slot left. Please update 'No. of participants'";
			}
			else if($checker->checkReviewerSlot($_POST["review_id"])==0){
				//echo "Request Accepted";
				echo $crud->acceptRequest($_POST["review_id"],$_POST["reviewer_id"]);
			}
		}
	}

	else if(isset($_POST["rejectReviewer"])){
		if($_POST["rejectReviewer"]=="reject"){
			echo $crud->rejectReviewer($_POST["i_rid"],$_POST["i_rev_id"]);
		}
	}

	else if(isset($_POST["vw_reject"])){
		if($_POST["vw_reject"]=="view"){
			echo $crud->viewRejectRequest($_POST["i_rid"],$_POST["search"],$_POST["searchBy"]);
		}
	}

	else if(isset($_POST["recoverReject"])){
		if($_POST["recoverReject"]=="recover"){
			echo $crud->recoverRejectReviewer($_POST["i_rid"],$_POST["i_rev_id"]);
		}
	}

	else if(isset($_POST["deleteReject"])){
		if($_POST["deleteReject"]=="delete"){
			echo $crud->deleteRejectReviewer($_POST["i_rev_id"]);
		}
	}

	else if(isset($_POST["delete_reviewer"])){
		if($_POST["delete_reviewer"]=="delete"){
			echo $crud->deleteReviewer($_POST["i_rev_id"]);
		}
	}

	else if(isset($_POST["remove_reviewer"])){
		if($_POST["remove_reviewer"]=="remove"){
			echo $crud->removeApproved($_POST["review_id"],$_POST["reviewer_id"]);
		}
	}

	//Before modal pop-up, it will get all the course and major from the dbase
	else if(isset($_POST["create_requests"])){
		if($_POST["create_requests"]=="getCourse"){
			echo $crud->getCourse();
		}
		else if($_POST["create_requests"]=="getMajor"){
			echo $crud->getMajor($_POST["course_id"]);
		}
	}

	else if(isset($_POST["getSchool"])){
		echo $crud->getSchool();
	}

	else if(isset($_POST["addSchool"])){
		echo $crud->createSchool($_POST["school"],$_POST["address"],$_POST["schoolType"]);
	}

	else if(isset($_POST["addCourse"])){
		echo $crud->createCourse($_POST["course"]/*,$_POST["major"]*/);
	}

	else if(isset($_POST["addMajor"])){
		echo $crud->createMajor($_POST["course_id"],$_POST["major"]);
	}

	else if(isset($_POST["addReviewer"])){
		if($checker->checkReviewerSlot($_POST["i_rid"])==1){
			echo "There's no slot left.";
		}
		else if($checker->checkReviewerSlot($_POST["i_rid"])==0){
			
			echo $crud->createReviewer($_POST["i_rid"],$_POST["lname"],$_POST["fname"],$_POST["mi"],$_POST["bdate"],$_POST["address"],$_POST["contact"],$_POST["email"],$_POST["i_sid"],$_POST["i_mid"],$_POST["yrGrad"],$_POST["lodge"]);
		}

	}

	else if(isset($_POST["viewReviewer"])){
		if($_POST["viewReviewer"]=="getReviewer"){
			echo json_encode($crud->viewReviewer($_POST["i_rev_id"]));
		}
		
	}

	else if(isset($_POST["updateReviewer"])){
		if($_POST["updateReviewer"]=="updateReviewer"){
			echo $crud->updateReviewer($_POST["i_rev_id"],$_POST["fname"],$_POST["mi"],$_POST["lname"],$_POST["bdate"],$_POST["address"],$_POST["contact"],$_POST["email"],$_POST["sid"],$_POST["mid"],$_POST["yrGrad"],$_POST["lodge"]);
		}
	}

	else if(isset($_POST["cancelReviewer"])){
		if($_POST["cancelReviewer"]=="cancel"){
			echo $crud->cancelReviewer($_POST["i_rev_id"]);
		}
	}

	else if(isset($_POST["goingReviewer"])){
		if($_POST["goingReviewer"]=="going"){
			echo $crud->goingReviewer($_POST["i_rev_id"]);
		}
	}

	else if(isset($_POST["updateSlot"])){
		if($_POST["updateSlot"]=="update"){
			echo json_encode($crud->updateSlotremaining($_POST["i_rid"]));
		}
	}

	else if(isset($_POST["addRequest"])){
		if($_POST["addRequest"]=="create"){
			echo $crud->createRequest($_POST["i_rid"],$_POST["lname"],$_POST["fname"],$_POST["mi"],$_POST["bdate"],$_POST["address"],$_POST["contact"],$_POST["email"],$_POST["i_sid"],$_POST["i_mid"],$_POST["yrGrad"],$_POST["lodge"]);
		}
	}

	else if(isset($_POST["viewRemoved"])){
		if($_POST["viewRemoved"]=="view"){
			echo $crud->getRemoved($_POST["i_rid"],$_POST["search"],$_POST["search_by"]);
		}
	}

	else if(isset($_POST["recoverRemoved"])){
		if($_POST["recoverRemoved"]=="recover"){
			if($checker->checkReviewerSlot($_POST["i_rid"])==1){
				echo "There's no slot left. Please update 'No. of participants'";
			}
			else if($checker->checkReviewerSlot($_POST["i_rid"])==0){
				echo $crud->recoverRemoved($_POST["i_rid"],$_POST["i_rev_id"]);
			}
			
		}
	}

	else if(isset($_POST["deleteRemoved"])){
		if($_POST["deleteRemoved"]=="delete"){
			echo $crud->deleteRemoved($_POST["i_rev_id"]);
		}
	}

?>