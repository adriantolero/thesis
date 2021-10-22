<?php
	
	include_once "../crud/room.php";

	$crud = new CRUD();

	if(isset($_POST["function"])){
		if($_POST["function"]=="getSched"){
			echo $crud->getSched($_POST["search"],$_POST["category"]);
		}

		else if($_POST["function"]=="getAvailRoom"){
			$d_start = $_POST["date_start"];
			$t_start = $_POST["time_start"];
			$d_end = $_POST["date_end"];
			$t_end = $_POST["time_end"];
			
			$dt_arrival = date('Y-m-d H:i:s',strtotime("$d_start $t_start")) ;
			$dt_departure = date('Y-m-d H:i:s',strtotime("$d_end $t_end")) ;
			if((strtotime($dt_arrival) >= strtotime($dt_departure))){
				echo 0;
			}
			else{
				echo $crud->getAvailableRoom($dt_arrival,$dt_departure);
			}

		}

		else if($_POST["function"]=="previewForm"){

			$d_start = $_POST["date_start"];
			$t_start = $_POST["time_start"];
			$d_end = $_POST["date_end"];
			$t_end = $_POST["time_end"];
			
			$dt_arrival = date('Y-m-d H:i:s',strtotime("$d_start $t_start")) ;
			$dt_departure = date('Y-m-d H:i:s',strtotime("$d_end $t_end")) ;

			if((strtotime($dt_arrival) >= strtotime($dt_departure))){
				echo "The date & time you have inputted are invalid.";
			}
			else{
				if($crud->checkFunctionSched($_POST["room"],$dt_arrival,$dt_departure)){
					echo "Room not available in this schedule. Please select another room or schedule.";
				}
				else if($crud->checkReviewSched($_POST["room"],$dt_arrival,$dt_departure)){
					echo "Room not available in this schedule. Please select another room or schedule.";
				}
				else{
					if($crud->checkCapacity($_POST["room"],$_POST["participants"])){
						echo "Number of participants cannot exceed max capacity.";
					}
					else{
						echo $crud->previewForm($_POST["agency"],$_POST["agency_add"],$_POST["room"],$_POST["title"],$_POST["participants"],$_POST["date_start"],$_POST["time_start"],$_POST["date_end"],$_POST["time_end"],$_POST["nature"],$_POST["reservedBy"],$_POST["reserved_add"],$_POST["contact"],$_POST["email"]);
					}
					
				}
			}
			
			//echo $crud->previewForm($_POST["agency"],$_POST["agency_add"],$_POST["room"],$_POST["title"],$_POST["participants"],$_POST["date_start"],$_POST["time_start"],$_POST["date_end"],$_POST["time_end"],$_POST["nature"],$_POST["reservedBy"],$_POST["reserved_add"],$_POST["contact"],$_POST["email"]);
		}

		else if($_POST["function"]=="addRequest"){

			$d_start = $_POST["date_start"];
			$t_start = $_POST["time_start"];
			$d_end = $_POST["date_end"];
			$t_end = $_POST["time_end"];
			
			$dt_arrival = date('Y-m-d H:i:s',strtotime("$d_start $t_start")) ;
			$dt_departure = date('Y-m-d H:i:s',strtotime("$d_end $t_end")) ;

			echo $crud->createRequest($_POST["agency"],$_POST["agency_add"],$_POST["room"],$_POST["title"],$_POST["participants"],$dt_arrival,$dt_departure,$_POST["nature"],$_POST["reservedBy"],$_POST["reserved_add"],$_POST["contact"],$_POST["email"]);
	
		}
	}

?>