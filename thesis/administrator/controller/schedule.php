<?php

	session_start();
	include_once "../CRUD/crud.php";
	include_once "../CRUD/checker.php";
	$crud = new CRUD();
	$checker = new Checker();

	if(isset($_POST["logout"])){
		if($_POST["logout"]=="logout"){
			echo $crud->logout();
		}
	}

	else if(isset($_POST["reviewSchedule"])){
		if($_POST["reviewSchedule"]=="display"){
			echo $crud->getReviewSched();
		}
	}

	else if(isset($_POST["searchReview"])){
		if($_POST["searchReview"]=="search"){
			echo $crud->searchReviewSched($_POST["search"],$_POST["category"]);
		}
	}

	else if(isset($_POST["createReviewSched"])){
		if($_POST["createReviewSched"]=="create"){

			//echo "Date Start: " . strtotime($_POST["date_start"]) . "Date End: " . strtotime($_POST["date_end"]);
			$d_start = $_POST["date_start"];
			$t_start = $_POST["time_start"];
			$d_end = $_POST["date_end"];
			$t_end = $_POST["time_end"];
			
			$dt_start = date('Y-m-d H:i:s',strtotime("$d_start $t_start")) ;
			$dt_end = date('Y-m-d H:i:s',strtotime("$d_end $t_end")) ;

			if(strtotime($dt_start) >= strtotime($dt_end)){
				echo "Please input a valid date & time.";
			}
			else{
				if($checker->check_ReviewSchedule($_POST["room_id"],$dt_start,$dt_end)){
					echo "This schedule is already booked by someone else. Please select another room or schedule.";
				}	
				else if($checker->check_VenueSchedule($_POST["room_id"],$dt_start,$dt_end)){
					echo "This schedule is already booked by someone else. Please select another room or schedule.";
				}
				else{
					//echo "Nice one-desu";
					$crud->createReview($_POST["room_id"],$_POST["description"],$_POST["reviewee"],$dt_start,$dt_end,$_POST["review_fee_vsu"],$_POST["review_fee_non_vsu"],$_POST["reviewers"]/*,$_POST["status"]*/);
					//header("Location: index.php");
					echo "Successfully created.";
					
				}
			}
	
		}
	}

	else if(isset($_POST["deleteSched_btn"])){
		echo $crud->deleteReview($_POST["sched_id"]);
	}

	else if(isset($_POST["viewReview"])){
		if($_POST["viewReview"]=="view"){
			echo json_encode($crud->modal_getReview($_POST["rev_id"]));
		}
	}

	else if(isset($_POST["editReview"])){
		if($_POST["editReview"]=="edit"){
			echo json_encode($crud->modal_getReview($_POST["rev_id"]));
		}
	}

	else if(isset($_POST["manageReviewSched_btn"])){
		if($_POST["manageReviewSched_btn"]=="update"){

			$d_start = $_POST["date_start"];
			$t_start = $_POST["time_start"];
			$d_end = $_POST["date_end"];
			$t_end = $_POST["time_end"];
			
			$dt_start = date('Y-m-d H:i:s',strtotime("$d_start $t_start")) ;
			$dt_end = date('Y-m-d H:i:s',strtotime("$d_end $t_end")) ;

			if(strtotime($dt_start) >= strtotime($dt_end)){
				echo "Please input a valid date & time.";
			}

			else{
				if($checker->checkReviewSched_update($_POST["review_id"],$_POST["room_id"],$dt_start,$dt_end)){
					echo "This schedule is already booked by someone else. Please select another room or schedule.";
				}

				else if($checker->checkFunctionSched_update($_POST["room_id"],$dt_start,$dt_end)){
					echo "This schedule is already booked by someone else. Please select another room or schedule.";
				}

				else{
			
					$crud->updateReview($_POST["review_id"],$_POST["room_id"],$_POST["description"],$_POST["reviewee"],$dt_start,$dt_end,$_POST["review_fee_vsu"],$_POST["review_fee_non_vsu"],$_POST["reviewers"]/*,$_POST["status"]*/);
					echo "Successfully updated.";

				}
			}

			
			
			/*if($checker->check_schedule($_POST["room_id"],$_POST["date_start"],$_POST["date_end"])){
				echo "There is conflict on the schedule";
			}
			else{
				$crud->updateReview($_POST["review_id"],$_POST["room_id"],$_POST["description"],$_POST["reviewee"],$_POST["date_start"],$_POST["date_end"],$_POST["review_fee_vsu"],$_POST["review_fee_non_vsu"],$_POST["reviewers"],$_POST["status"]);
				echo "Successfully updated...";
			}*/
		}
	}

?>