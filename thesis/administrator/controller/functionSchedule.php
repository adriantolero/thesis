<?php
	
	session_start();
	include_once "../CRUD/functionSchedule.php";
	$crud = new CRUD();
	
	if(isset($_POST["function"])){
		if($_POST["function"]=="getSched"){
			echo $crud->getSched($_POST["search"],$_POST["category"]);
		}

		else if($_POST["function"]=="getRoom"){
			echo $crud->getRoom();
		}

		else if($_POST["function"]=="addSchedule"){
			$d_start = $_POST["date_start"];
			$t_start = $_POST["time_start"];
			$d_end = $_POST["date_end"];
			$t_end = $_POST["time_end"];
			
			$dt_arrival = date('Y-m-d H:i:s',strtotime("$d_start $t_start")) ;
			$dt_departure = date('Y-m-d H:i:s',strtotime("$d_end $t_end")) ;

			if($dt_arrival >= $dt_departure){
				echo "Please input a valid date & time.";
			}
			//if($dt_arrival)
			else{
				if($crud->checkFunctionSched($_POST["room"],$dt_arrival,$dt_departure)){
				echo "There is someone already reserved in this schedule.";
				}
				else if($crud->checkReviewSched($_POST["room"],$dt_arrival,$dt_departure)){
					echo "There is someone already reserved in this schedule.";
				}
				else{
					echo $crud->createSched($_POST["agency"],$_POST["agency_add"],$_POST["room"],$_POST["title"],$_POST["participants"],$dt_arrival,$dt_departure,$_POST["nature"],$_POST["reservedBy"],$_POST["reserved_add"],$_POST["contact"],$_POST["email"]);
				}
			}
			
			
		}

		/*
		else if($_POST["function"]=="settleCheckin"){

			echo json_encode($crud->settleCheckin($_POST["i_fr_id"]));

		}
		*/

		else if($_POST["function"]=="checkIn"){

			//Checks if room is in use.
			if($crud->checkCheckin($_POST["i_fr_id"])){
				echo "Room is in use.";
			}
			//Update the status to check-in
			else{
				echo $crud->checkIn($_POST["i_fr_id"],$_POST["i_pid"]);
			}
			
		}

		else if($_POST["function"]=="viewReserved"){
			echo json_encode($crud->getInfo($_POST["i_fr_id"]));
		}

		else if($_POST["function"]=="updateInfo"){
			$d_start = $_POST["date_start"];
			$t_start = $_POST["time_start"];
			$d_end = $_POST["date_end"];
			$t_end = $_POST["time_end"];
			
			$dt_arrival = date('Y-m-d H:i:s',strtotime("$d_start $t_start")) ;
			$dt_departure = date('Y-m-d H:i:s',strtotime("$d_end $t_end")) ;
			
			//There's still bug in this when updating itself(It gets conflict. lol)
			if($dt_arrival >= $dt_departure){
				echo "Please input a valid date & time.";
			}
			else{
				if($crud->checkFunctionSched_update($_POST["i_fr_id"],$_POST["room"],$dt_arrival,$dt_departure)){
					echo "There is someone already reserved in this schedule.";
				}
				else if($crud->checkReviewSched_update($_POST["room"],$dt_arrival,$dt_departure)){
					echo "There is someone already reserved in this schedule.";
				}
				else{
					echo $crud->updateInfo($_POST["i_fr_id"],$_POST["agency"],$_POST["agency_add"],$_POST["room"],$_POST["title"],$_POST["participants"],$dt_arrival,$dt_departure,$_POST["nature"],$_POST["reservedBy"],$_POST["reserved_add"],$_POST["contact"],$_POST["email"]);
				}
			}
			
		}

		else if($_POST["function"]=="deleteSched"){
			echo $crud->deleteSched($_POST["i_fr_id"]);
		}

		else if($_POST["function"]=="getRequest"){
			echo $crud->getRequests($_POST["search"],$_POST["category"]);
		}

		else if($_POST["function"]=="acceptRequest"){
			
			$array = $crud->getDateTime($_POST["i_fr_id"]);
			if($crud->checkFunctionSched_accept($array["room_id"],$array["dt_arrival"],$array["dt_departure"])){
				echo "There is someone already reserved in this schedule.";
			}
			else if($crud->checkReviewSched_accept($array["room_id"],$array["dt_arrival"],$array["dt_departure"])){
				echo "There is someone already reserved in this schedule.";
			}
			else{
				echo $crud->acceptRequest($_POST["i_fr_id"]);
			}
		}

		else if($_POST["function"]=="rejectRequest"){
			echo $crud->rejectRequest($_POST["i_fr_id"]);
		}

		else if($_POST["function"]=="deleteRequest"){
			echo $crud->deleteRequest($_POST["i_fr_id"]);
		}

		else if($_POST["function"]=="addRequest"){

			$d_start = $_POST["date_start"];
			$t_start = $_POST["time_start"];
			$d_end = $_POST["date_end"];
			$t_end = $_POST["time_end"];
			
			$dt_arrival = date('Y-m-d H:i:s',strtotime("$d_start $t_start")) ;
			$dt_departure = date('Y-m-d H:i:s',strtotime("$d_end $t_end")) ;

			if($dt_arrival >= $dt_departure){
				echo "Please input a valid date & time.";
			}
			else{

				echo $crud->createRequest($_POST["agency"],$_POST["agency_add"],$_POST["room"],$_POST["title"],$_POST["participants"],$dt_arrival,$dt_departure,$_POST["nature"],$_POST["reservedBy"],$_POST["reserved_add"],$_POST["contact"],$_POST["email"]);
			}
	
		}

		else if($_POST["function"]=="getReject"){

			echo $crud->getReject($_POST["search"],$_POST["category"]);

		}

		else if($_POST["function"]=="recoverReject"){

			echo $crud->recoverReject($_POST["i_fr_id"]);

		}

		else if($_POST["function"]=="deleteReject"){

			echo $crud->deleteReject($_POST["i_fr_id"]);

		}

		else if($_POST["function"]=="getCheckin"){

			echo $crud->getCheckin();

		}

		/*else if($_POST["function"]=="getCategory"){

			echo $crud->getCategory();

		}*/

		else if($_POST["function"]=="viewCheckinInfo"){

			echo json_encode($crud->viewCheckinInfo($_POST["i_fr_id"]));

		}

		else if($_POST["function"]=="updateCheckinInfo"){
			if($crud->checkCheckin_updateCheckinInfo($_POST["i_fr_id"],$_POST["room"])){
				echo "Room is in use.";
			}
			else{
				echo $crud->updateCheckinInfo($_POST["i_fr_id"],$_POST["agency"],$_POST["agencyAdd"],$_POST["room"],$_POST["title"],$_POST["participants"],$_POST["nature"],$_POST["requisitioner"],$_POST["address"],$_POST["contact"],$_POST["email"]);
			}
		}

		else if($_POST["function"]=="getRegisteredParticular"){
			echo $crud->getRegisteredParticular($_POST["i_fr_id"]);
		}

		else if($_POST["function"]=="getRegisteredAmenity"){
			echo $crud->getRegisteredAmenity($_POST["i_fr_id"]);
		}

		/*
		else if($_POST["function"]=="getBillInfo"){

			echo json_encode($crud->getBillInfo($_POST["i_fr_id"]));
			//echo $crud->getCheckoutInfo($_POST["i_fr_id"]);
		}
		*/

		/*

		else if($_POST["function"]=="getCheckoutBill"){
			echo json_encode($crud->getCheckoutBill($_POST["i_fr_id"],$_POST["hours"]));	
		}*/

		else if ($_POST["function"]=="getParticularDescription") {
			echo $crud->getParticularDescription($_POST["category"],$_POST["aircon"]);
		}

		else if($_POST["function"]=="getRate"){
			echo json_encode($crud->getRate($_POST["i_pid"]));
		}

		else if($_POST["function"]=="getBill"){
			echo json_encode($crud->getBill($_POST["total_hours"],$_POST["first_hour"],$_POST["succeeding_hour"]));
		}

		else if($_POST["function"]=="viewParticularDescription"){
			echo $crud->viewParticularDescription($_POST["category"],$_POST["aircon"]);
		}

		else if($_POST["function"]=="viewParticular"){
			echo json_encode($crud->viewParticular($_POST["i_bid"]));
		}

		else if($_POST["function"]=="updateParticular"){
			echo $crud->updateParticular($_POST["i_pid"],$_POST["i_bid"]);
		}

		

		else if($_POST["function"]=="createAmenity"){
			echo $crud->createAmenity($_POST["i_fr_id"],$_POST["description"],$_POST["payment"]);
		}



		else if($_POST["function"]=="viewAmenity"){
			echo json_encode($crud->viewAmenity($_POST["i_baid"]));
		}

		else if($_POST["function"]=="editAmenity"){
			echo $crud->editAmenity($_POST["i_baid"],$_POST["description"],$_POST["payment"]);
		}

		else if($_POST["function"]=="deleteAmenity"){
			echo $crud->deleteAmenity($_POST["i_baid"]);
		}

		else if($_POST["function"]=="generateCheckoutBill"){
			echo json_encode($crud->generateCheckoutBill($_POST["i_fr_id"]));

		}

		/*

		else if($_POST["function"]=="printBill"){
			echo $crud->printBill($_POST["i_fr_id"],$_POST["hours"]);
		}
		*/
		else if($_POST["function"]=="checkOut"){
			echo $crud->checkOut($_POST["i_fr_id"],$_POST["checkout"],$_POST["particularFee"]/*,$_POST["billStatus"],$_POST["ORNum"]*/);
		}

		else if($_POST["function"]=="deleteCheckin"){
			echo $crud->deleteCheckin($_POST["i_fr_id"]);
		}
		

		else if($_POST["function"]=="getCheckedout"){
			echo $crud->getCheckedout($_POST["category"],$_POST["search"]);
		}
		
		else if($_POST["function"]=="viewCheckoutInfo"){
			echo json_encode($crud->viewCheckoutInfo($_POST["i_fr_id"]));
		}

		else if($_POST["function"]=="updateCheckoutInfo"){
			echo $crud->updateCheckoutInfo($_POST["i_fr_id"],$_POST["agency"],$_POST["agencyAdd"],$_POST["title"],$_POST["participants"],$_POST["nature"],$_POST["requisitioner"],$_POST["address"],$_POST["contact"],$_POST["email"]);
		}

		else if($_POST["function"]=="viewGenerateCheckoutBill"){

			echo json_encode($crud->viewGenerateCheckoutBill($_POST["i_fr_id"]));
			//echo $crud->viewGenerateCheckoutBill($_POST["i_fr_id"]);
		}

		else if($_POST["function"]=="updateGenerateCheckoutBill"){
			echo $crud->updateGenerateCheckoutBill($_POST["i_fr_id"],$_POST["billStatus"],$_POST["ORNum"]);
		}

		else if($_POST["function"]=="deleteCheckout"){
			echo $crud->deleteCheckout($_POST["i_fr_id"]);
		}
		/*
		else if($_POST["function"]=="viewCheckoutBillInfo"){
			echo json_encode($crud->viewCheckoutBillInfo($_POST["i_fr_id"]));
		}

		else if($_POST["function"]=="getCheckoutBill_view"){
			echo json_encode($crud->getCheckoutBill_view($_POST["i_fr_id"],$_POST["hours"]));
		}
		*/

	}

?>