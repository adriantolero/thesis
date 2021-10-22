<?php
	/**
	* 
	*/
	class CRUD
	{
		
		private $host = 'localhost';
	    private $username = 'root';
	    private $password = '';
	    private $database = 'thesis';

	    protected $conn;

		public function __construct(){
			//parent::__construct();
			 
		    if (!isset($this->conn)) {
	            
	            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
	            
	            if (!$this->conn) {
	                echo 'Cannot connect to database server';
	                exit;
	            }

	            else{
	            	//echo "Connected to database server";
	            }            
	        }    
	        
	        return $this->conn;
		}

		public function getSched($search,$category){

			try{

				$search = mysqli_real_escape_string($this->conn,utf8_decode($search));
				//	$sql = "";
				if($category==1){
					$sql = "SELECT `rm`.`str_rmName`,`fr`.`i_fr_id`, `fr`.`str_title`,`fr`.`dt_arrival`,`fr`.`dt_departure`,`fr`.`str_requisitioner` 
					FROM `function_reservation` `fr`
					INNER JOIN `room` `rm`
					ON `fr`.`i_rm_id`=`rm`.`i_rm_id`
					WHERE `str_title` LIKE '$search%' AND `i_fr_status`=1 ORDER BY `fr`.`dt_arrival` DESC";
				}

				else if($category==2){
					$sql = "SELECT `rm`.`str_rmName`,`fr`.`i_fr_id`, `fr`.`str_title`,`fr`.`dt_arrival`,`fr`.`dt_departure`,`fr`.`str_requisitioner` 
					FROM `function_reservation` `fr`
					INNER JOIN `room` `rm`
					ON `fr`.`i_rm_id`=`rm`.`i_rm_id`
					WHERE `str_requisitioner` LIKE '$search%' AND `i_fr_status`=1 ORDER BY `fr`.`dt_arrival` DESC";
				}

				else{
					if($search != ""){
						$search = date("Y-m-d h:i:s",strtotime($search));
						//$search = "2018-05-10 08:00:00";
						$sql = "SELECT `rm`.`str_rmName`,`fr`.`i_fr_id`, `fr`.`str_title`,`fr`.`dt_arrival`,`fr`.`dt_departure`,`fr`.`str_requisitioner` 
							FROM `function_reservation` `fr`	
							INNER JOIN `room` `rm`
							ON `fr`.`i_rm_id`=`rm`.`i_rm_id`
							WHERE ('$search' <= dt_departure) AND ('$search' >= dt_arrival ) AND `i_fr_status`=1 ORDER BY `fr`.`dt_arrival` DESC";
					}
					else{
						$sql = "SELECT `rm`.`str_rmName`,`fr`.`i_fr_id`, `fr`.`str_title`,`fr`.`dt_arrival`,`fr`.`dt_departure`,`fr`.`str_requisitioner` 
							FROM `function_reservation` `fr`
							INNER JOIN `room` `rm`
							ON `fr`.`i_rm_id`=`rm`.`i_rm_id`
							 AND `i_fr_status`=1 ORDER BY `fr`.`dt_arrival` DESC";
					}
					
				}

				$data = "";
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						$data .= "<tr><td><center>" . utf8_encode($row["str_rmName"]) . "</center></td><td><center>" . utf8_encode($row["str_title"]) .  "</center></td><td><center>" . date("F d, Y h:ia",strtotime($row["dt_arrival"])) .  "</center></td><td><center>" . date("F d, Y h:ia",strtotime($row["dt_departure"])) .  "</center></td><td><center>" . utf8_encode($row["str_requisitioner"]) . "</center></td><td><center><button class='btn btn-primary' id='vw-info' data-id='" . $row["i_fr_id"] . "' data-toggle='modal' data-target='#vwFunctionSched-modal'><i class='fa fa-search'></i> View</button></center></td><td><center><button class='btn btn-primary' id='checkin-sched' data-id='" . $row["i_fr_id"] . "'><i class='fa fa-sign-in-alt'></i> Check-in</button></center></td><td><center><button class='btn btn-danger' id='delete-sched' data-id='" . $row["i_fr_id"] . "'><i class='fa fa-times'></i> Delete</button></center></td></tr>";
					}
				}
				else{
					$data = "<tr class='bg-danger text-white'><td colspan='6'><center><h3>No record found</h3></center></td></tr>";
				}
				return $data;
				//return $data;
				$this->conn->close();
			}catch(exception $e){
				return $e;
			}

		}

		public function getRoom(){

			try{

				$sql = "SELECT * FROM `room`";
				$result = $this->conn->query($sql);
				$data = "";
				if($result->num_rows > 0 ){
					while ($row = $result->fetch_assoc()) {
						$data .= "<option value='" . $row["i_rm_id"] . "'>" . utf8_encode($row["str_rmName"]) . "</option>";
					}
				}
				return $data;

			}catch(exception $e){
				return $e;
			}
			$this->conn->close();

		}

		public function checkFunctionSched($room,$dt_arrival,$dt_departure){
			//$dt_start =;
			//$dt_end = ; 
			$sql = "SELECT * FROM `function_reservation` WHERE ('$dt_arrival' < `dt_departure`) AND ('$dt_departure' > `dt_arrival`) AND `i_rm_id`=$room AND `i_fr_status`=1";
			$result = $this->conn->query($sql);
			if($result->num_rows > 0){
				return true;
			}
			else{
				return false;
			}
			$this->conn->close();
		}

		public function checkReviewSched($room,$dt_arrival,$dt_departure){
			$sql = "SELECT * FROM `review_schedule` WHERE ('$dt_arrival' < dt_end) AND ('$dt_departure' > dt_start) AND `i_rm_id`=$room AND `i_status`=1";
			$result = $this->conn->query($sql);
			if($result->num_rows > 0){
				return true;
			}
			else{
				return false;
			}
			$this->conn->close();
		}

		public function createSched($agency,$agency_add,$room,$title,$participants,$dt_arrival,$dt_departure,$nature,$reservedBy,$reserved_add,$contact,$email){

			try{

				$agency = mysqli_real_escape_string($this->conn,utf8_decode($agency));
				$agency_add = mysqli_real_escape_string($this->conn,utf8_decode($agency_add));
				$title = mysqli_real_escape_string($this->conn,utf8_decode($title));
				$nature = mysqli_real_escape_string($this->conn,utf8_decode($nature));
				$reservedBy = mysqli_real_escape_string($this->conn,utf8_decode($reservedBy));
				$reserved_add = mysqli_real_escape_string($this->conn,utf8_decode($reserved_add));
				$contact = mysqli_real_escape_string($this->conn,utf8_decode($contact));
				$email = mysqli_real_escape_string($this->conn,utf8_decode($email));

				$i_emp_id = $_SESSION["id"];

				$sql = "INSERT INTO `function_reservation`(`i_rm_id`,`str_agency`,`str_agency_add`,`dt_arrival`,`dt_departure`,`str_nature`,`str_title`,`i_no_participants`,`str_requisitioner`,`str_address`,`str_mobile_no`,`str_email`,`i_fr_status`,`i_emp_id`) VALUES($room,'$agency','$agency_add','$dt_arrival','$dt_departure','$nature','$title',$participants,'$reservedBy','$reserved_add','$contact','$email',1,$i_emp_id)";
				if($this->conn->query($sql)){
					return "Created new schedule";
				}
				else{
					return "Error: " . $sql . "<br>" . $this->conn->error;
				}
				$this->conn->close();

			}catch(exception $e){
				return $e;
			}

		}

		/*
		public function settleCheckin($i_fr_id){

			try{

				$sql = "SELECT `rm`.`str_rmName`,`fr`.`str_title`,`fr`.`str_nature`,`fr`.`str_requisitioner`
					FROM `function_reservation` `fr`
					INNER JOIN `room` `rm`
					ON `fr`.`i_rm_id`=`rm`.`i_rm_id`
					WHERE `i_fr_id`=$i_fr_id";

				$result = $this->conn->query($sql);
				if($result->num_rows > 0){

					date_default_timezone_set('Asia/Manila');
					$dt_checkin = date("Y-m-d H:i:s",strtotime("now"));

					while ($row = $result->fetch_assoc()) {
						return array("room"=>$row["str_rmName"],"title"=>$row["str_title"],"nature"=>$row["str_nature"],"requisitioner"=>$row["str_requisitioner"],"checkin"=>$dt_checkin);
					}
				}

			}catch(exception $e){
				return $e;
			}

		}*/

		public function checkCheckin($i_fr_id){

			try{


				//GET ROOM FROM function_reservation
				$sql = "SELECT `i_rm_id` FROM `function_reservation` WHERE `i_fr_id`=$i_fr_id";
				$room_id = NULL;
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						$room_id = $row["i_rm_id"];
					}
				}

				
				$sql = "SELECT * FROM function_reservation WHERE i_rm_id =$room_id AND i_fr_status = 4";
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					/*while ($row = $result->fetch_assoc()) {
						return 
					}*/
					return 1;
				}

			}catch(exception $e){
				return $e;
			}

		}

		public function checkIn($i_fr_id,$i_pid){

			try{

				//Creating Data in Billing
				$sql = "INSERT INTO `billing`(`i_fr_id`,`i_pid`) VALUES($i_fr_id,$i_pid)";
				if($this->conn->query($sql)){

					//Updating Status
					date_default_timezone_set('Asia/Manila');

					//Original
					$dt_checkin = date("Y-m-d H:i:s",strtotime("now"));

					$sql = "UPDATE `function_reservation` SET `dt_checkin`='$dt_checkin',`i_fr_status`=4 WHERE `i_fr_id`=$i_fr_id";


					if($this->conn->query($sql)){
						return "Successfully checked-in.";		
					}
					else{
						return "Error updating record: " . $sql . "<br>" . $this->conn->error();
					}
				}
				else{
					return "Error: " . $sql . "<br>" . $this->conn->error();
				}
				/*
				date_default_timezone_set('Asia/Manila');
				$dt_checkin = date("Y-m-d H:i:s",strtotime("now"));

				$sql = "UPDATE `function_reservation` SET `dt_checkin`='$dt_checkin',`i_fr_status`=4 WHERE `i_fr_id`=$i_fr_id";


				if($this->conn->query($sql)){
					return "Successfully checked-in.";
				}
				else{
					return "Error updating record: " . $this->conn->error;
				}*/

			}catch(exception $e){
				return $e;
			}

		}

		public function getInfo($i_fr_id){

			try{

				$sql = "SELECT * FROM `function_reservation` WHERE `i_fr_id`=$i_fr_id";
				$result = $this->conn->query($sql);
				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						$data = array("id"=>$row["i_fr_id"],"rm_id"=>$row["i_rm_id"],"agency"=>utf8_encode($row["str_agency"]),"agency_add"=>utf8_encode($row["str_agency_add"]),"d_arrival"=>date("Y-m-d",strtotime($row["dt_arrival"])),"t_arrival"=>date("H:i",strtotime($row["dt_arrival"])),"d_departure"=>date("Y-m-d",strtotime($row["dt_departure"])),"t_departure"=>date("H:i",strtotime($row["dt_departure"])),"nature"=>utf8_encode($row["str_nature"]),"title"=>utf8_encode($row["str_title"]),"participants"=>$row["i_no_participants"],"requisitioner"=>utf8_encode($row["str_requisitioner"]),"address"=>utf8_encode($row["str_address"]),"mobile"=>utf8_encode($row["str_mobile_no"]),"email"=>utf8_encode($row["str_email"]),"status"=>$row["i_fr_status"]);
						return $data;
					}
				}
				//return $i_fr_id;

			}catch(exception $e){
				return $e;
			}

		}

		public function checkFunctionSched_update($i_fr_id,$room,$dt_arrival,$dt_departure){
			//$dt_start =;
			//$dt_end = ; 
			$sql = "SELECT * FROM `function_reservation` WHERE ('$dt_arrival' < `dt_departure`) AND ('$dt_departure' > `dt_arrival`) AND `i_fr_id`<> $i_fr_id AND `i_rm_id`=$room AND `i_fr_status`=1";
			$result = $this->conn->query($sql);
			if($result->num_rows > 0){
				return true;
			}
			else{
				return false;
			}
			$this->conn->close();
		}

		public function checkReviewSched_update($room,$dt_arrival,$dt_departure){
			$sql = "SELECT * FROM `review_schedule` WHERE ('$dt_arrival' < dt_end) AND ('$dt_departure' > dt_start) AND `i_rm_id`=$room AND `i_status`=1";
			$result = $this->conn->query($sql);
			if($result->num_rows > 0){
				return true;
			}
			else{
				return false;
			}
			$this->conn->close();
		}

		public function updateInfo($i_fr_id,$agency,$agency_add,$room,$title,$participants,$dt_arrival,$dt_departure,$nature,$reservedBy,$reserved_add,$contact,$email){

			try{

				$agency = mysqli_real_escape_string($this->conn,utf8_decode($agency));
				$agency_add = mysqli_real_escape_string($this->conn,utf8_decode($agency_add));
				$title = mysqli_real_escape_string($this->conn,utf8_decode($title));
				$nature = mysqli_real_escape_string($this->conn,utf8_decode($nature));
				$reservedBy = mysqli_real_escape_string($this->conn,utf8_decode($reservedBy));
				$reserved_add = mysqli_real_escape_string($this->conn,utf8_decode($reserved_add));
				$contact = mysqli_real_escape_string($this->conn,utf8_decode($contact));
				$email = mysqli_real_escape_string($this->conn,utf8_decode($email));

				$sql = "UPDATE `function_reservation` SET `i_rm_id`=$room, `str_agency`='$agency',`str_agency_add`='$agency_add',`dt_arrival`='$dt_arrival',`dt_departure`='$dt_departure',`str_nature`='$nature',`str_title`='$title',`i_no_participants`=$participants,`str_requisitioner`='$reservedBy',`str_address`='$reserved_add',`str_mobile_no`='$contact',`str_email`='$email'
				WHERE `i_fr_id`=$i_fr_id";

				if($this->conn->query($sql)){
					return "Successfully updated...";
				}
				else{
					return "Error updating record: " . $this->conn->error;
				}

			}catch(exception $e){
				return $e;
			}

		}

		public function deleteSched($i_fr_id){

			try{

				$sql = "DELETE FROM `function_reservation` WHERE `i_fr_id`=$i_fr_id";

				if($this->conn->query($sql) === TRUE){
					return "Schedule has been deleted";
				}
				else{
					return "Error: " . $this->conn->error;
				}

			}catch(exception $e){
				return $e;
			}

		}

		public function getRequests($search,$category){
			try{
				//	$sql = "";
				$search = mysqli_real_escape_string($this->conn,utf8_decode($search));
				if($category==1){
					/*$sql = "SELECT `rm`.`str_rmName`,`fr`.`i_fr_id`, `fr`.`str_title`,`fr`.`d_start`,`fr`.`t_start`,`fr`.`d_end`,`fr`.`t_end`,`fr`.`str_requisitioner`,`fr`.`dt_requested`
					FROM `function_reservation` `fr`
					INNER JOIN `room` `rm`
					ON `fr`.`i_rm_id`=`rm`.`i_rm_id`
					WHERE `str_title` LIKE '$search%' AND `i_fr_status`=0 ORDER BY TIMESTAMP(`d_start`,`t_start`) ASC";*/
					$sql = "SELECT `rm`.`str_rmName`,`fr`.`i_fr_id`, `fr`.`str_title`,`fr`.`dt_arrival`,`fr`.`dt_departure`,`fr`.`str_requisitioner`,`fr`.`dt_requested`
					FROM `function_reservation` `fr`
					INNER JOIN `room` `rm`
					ON `fr`.`i_rm_id`=`rm`.`i_rm_id`
					WHERE `str_title` LIKE '$search%' AND `i_fr_status`=0 ORDER BY `fr`.`dt_requested` DESC";
				}

				else if($category==2){
					/*$sql = "SELECT `rm`.`str_rmName`,`fr`.`i_fr_id`, `fr`.`str_title`,`fr`.`d_start`,`fr`.`t_start`,`fr`.`d_end`,`fr`.`t_end`,`fr`.`str_requisitioner`,`fr`.`dt_requested` 
					FROM `function_reservation` `fr`
					INNER JOIN `room` `rm`
					ON `fr`.`i_rm_id`=`rm`.`i_rm_id`
					WHERE `str_requisitioner` LIKE '$search%' AND `i_fr_status`=0 ORDER BY TIMESTAMP(`d_start`,`t_start`) ASC";
					*/
					$sql = "SELECT `rm`.`str_rmName`,`fr`.`i_fr_id`, `fr`.`str_title`,`fr`.`dt_arrival`,`fr`.`dt_departure`,`fr`.`str_requisitioner`,`fr`.`dt_requested` 
					FROM `function_reservation` `fr`
					INNER JOIN `room` `rm`
					ON `fr`.`i_rm_id`=`rm`.`i_rm_id`
					WHERE `str_requisitioner` LIKE '$search%' AND `i_fr_status`=0 ORDER BY `fr`.`dt_requested` DESC";
				}

				else{
					if($search != ""){
						$search = date("Y-m-d h:i:s",strtotime($search));
						/*$sql = "SELECT `rm`.`str_rmName`,`fr`.`i_fr_id`, `fr`.`str_title`,`fr`.`d_start`,`fr`.`t_start`,`fr`.`d_end`,`fr`.`t_end`,`fr`.`str_requisitioner`,`fr`.`dt_requested` 
							FROM `function_reservation` `fr`
							INNER JOIN `room` `rm`
							ON `fr`.`i_rm_id`=`rm`.`i_rm_id`
							WHERE ('$search' <= d_end) AND ('$search' >= d_start ) AND `i_fr_status`=0 ORDER BY TIMESTAMP(`d_start`,`t_start`) ASC";
							*/
						$sql = "SELECT `rm`.`str_rmName`,`fr`.`i_fr_id`, `fr`.`str_title`,`fr`.`dt_arrival`,`fr`.`dt_departure`,`fr`.`str_requisitioner`,`fr`.`dt_requested` 
							FROM `function_reservation` `fr`
							INNER JOIN `room` `rm`
							ON `fr`.`i_rm_id`=`rm`.`i_rm_id`
							WHERE ('$search' <= `dt_departure`) AND ('$search' >= `dt_arrival` ) AND `i_fr_status`=0 ORDER BY `fr`.`dt_requested` DESC";
					}
					else{
						/*$sql = "SELECT `rm`.`str_rmName`,`fr`.`i_fr_id`, `fr`.`str_title`,`fr`.`d_start`,`fr`.`t_start`,`fr`.`d_end`,`fr`.`t_end`,`fr`.`str_requisitioner`,`fr`.`dt_requested` 
							FROM `function_reservation` `fr`
							INNER JOIN `room` `rm`
							ON `fr`.`i_rm_id`=`rm`.`i_rm_id`
							WHERE `i_fr_status`=0 ORDER BY TIMESTAMP(`d_start`,`t_start`) ASC";
							*/
						$sql = "SELECT `rm`.`str_rmName`,`fr`.`i_fr_id`, `fr`.`str_title`,`fr`.`dt_arrival`,`fr`.`dt_departure`,`fr`.`str_requisitioner`,`fr`.`dt_requested` 
							FROM `function_reservation` `fr`
							INNER JOIN `room` `rm`
							ON `fr`.`i_rm_id`=`rm`.`i_rm_id`
							WHERE `i_fr_status`=0 ORDER BY `fr`.`dt_requested` DESC";
					}
					
				}

				$data = "";
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					date_default_timezone_set('Asia/Manila');
					while ($row = $result->fetch_assoc()) {
						$request_date = $row["dt_requested"];
						//$request_date = "2018-05-09 22:35:00";
						$expire = strtotime($request_date. ' + 3 days');
						$today = strtotime("now");//gets the date & time(Asia/Manila GMT +8)

						$seconds = $expire - time();
						$days = floor($seconds / 86400);
						$seconds %= 86400;
						$strdays = $days . " day(s), ";
				
						$hours = floor($seconds / 3600);
						$seconds %= 3600;
						$strhours = $hours . " hour(s) and ";

						$minutes = floor($seconds / 60);
						$seconds %= 60;
						$strminutes = $minutes . " minute(s) remaining";
						$strleft = "";

						if($days!=0 && $hours!=0 && $minutes!=0){
							$strleft = $strdays . $strhours . $strminutes;
						}
						else if($days==0 && $hours!=0 && $minutes!=0){
							$strdays = "";
							$strleft = $strhours . $strminutes;
						}
						else if($days==0 && $hours==0 && $minutes!=0){
							$strdays = "";
							$strhours = "";
							$strleft = $strminutes;
						}
						else if($days==0 && $hours==0 && $minutes==0){
							$strleft = "Few seconds remaining";
						}
						else{
							$strleft = $strdays . $strhours . $strminutes;
						}

						if($today >=$expire){
							$data .= "<tr class='bg-danger text-white'><td><center>" . utf8_encode($row["str_rmName"]) . "</center></td><td><center>" . utf8_encode($row["str_title"]) .  "</center></td><td><center>" . date("F d, Y h:ia",strtotime($row["dt_arrival"])) . "</center></td><td><center>" . date("F d, Y h:ia",strtotime($row["dt_departure"])) .  "</center></td><td><center>" . utf8_encode($row["str_requisitioner"]) . "</center></td><td><center>" . date("F d, Y h:ia",strtotime($row["dt_requested"])) . "</center></td><td><center>" . "Expired" . "</center></td><td colspan='3'><center><a href='#' id='delete-request' data-id='" . $row["i_fr_id"] . "'><i class='fa fa-trash fa-2x'></i></a></center></td></tr>";
						}
						else{
							$data .= "<tr><td><center>" . utf8_encode($row["str_rmName"]) . "</center></td><td><center>" . utf8_encode($row["str_title"]) .  "</center></td><td><center>" . date("F d, Y h:ia",strtotime($row["dt_arrival"])) . "</center></td><td><center>" . date("F d, Y h:ia",strtotime($row["dt_departure"])) .  "</center></td><td><center>" . utf8_encode($row["str_requisitioner"]) . "</center></td><td><center>" . date("F d, Y h:ia",strtotime($row["dt_requested"])) . "</center></td><td><center>" . $strleft . "</center></td><td><center><button class='btn btn-primary' id='view-request' data-id='" . $row["i_fr_id"] . "'><i class='fa fa-search'></i> View</button></center></td><td><center><button class='btn btn-primary' id='accept-request' data-id='" . $row["i_fr_id"] . "'><i class='fa fa-check'></i> Accept</button></center></td><td><center><button class='btn btn-danger' id='reject-request' data-id='" . $row["i_fr_id"] . "'><i class='fa fa-times'></i> Reject</button></center></td></tr>";
						}
					}
				}
				else{
					$data = "<tr class='bg-danger text-white'><td colspan='8'><center><h3>Empty Result</h3></center></td></tr>";
				}
				return $data;
				$this->conn->close();
			}catch(exception $e){
				return $e;
			}
		}

		public function getDateTime($i_fr_id){

			try{

				$sql = "SELECT * FROM `function_reservation` WHERE `i_fr_id`=$i_fr_id";
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					$room = NULL;
					$dt_start = NULL;
					$dt_end = NULL;
					while ($row = $result->fetch_assoc()) {
						$room = $row["i_rm_id"];
						$dt_arrival = $row["dt_arrival"];
						$dt_departure = $row["dt_departure"];
						/*$d_start = $row["d_start"];
						$t_start = $row["t_start"];
						$d_end = $row["d_end"];
						$t_end = $row["t_end"];
						$dt_start = date('Y-m-d H:i:s',strtotime("$d_start $t_start")) ;
						$dt_end = date('Y-m-d H:i:s',strtotime("$d_end $t_end")) ;*/
					}
					return array("room_id"=>$room,"dt_arrival"=>$dt_arrival,"dt_departure"=>$dt_departure);
				}

			}catch(exception $e){
				return $e;
			}

		}

		public function checkFunctionSched_accept($room,$dt_arrival,$dt_departure){
			//$dt_start =;
			//$dt_end = ; 
			$sql = "SELECT * FROM `function_reservation` WHERE ('$dt_arrival' < `dt_departure`) AND ('$dt_departure' > `dt_arrival`) AND `i_rm_id`=$room AND `i_fr_status`=1";
			$result = $this->conn->query($sql);
			if($result->num_rows > 0){
				return true;
			}
			else{
				return false;
			}
			$this->conn->close();
		}

		public function checkReviewSched_accept($room,$dt_arrival,$dt_departure){
			$sql = "SELECT * FROM `review_schedule` WHERE ('$dt_arrival' < dt_end) AND ('$dt_departure' > dt_start) AND `i_rm_id`=$room AND `i_status`=1";
			$result = $this->conn->query($sql);
			if($result->num_rows > 0){
				return true;
			}
			else{
				return false;
			}
			$this->conn->close();
		}

		public function acceptRequest($i_fr_id){

			try{

				$i_emp_id = $_SESSION["id"];

				$sql = "UPDATE `function_reservation` SET `i_fr_status`=1, `i_emp_id`=$i_emp_id WHERE `i_fr_id`=$i_fr_id";


				if($this->conn->query($sql)){
					return "Request has been accepted.";
				}
				else{
					return "Error updating record: " . $this->conn->error;
				}

			}catch(exception $e){
				return $e;
			}

		}

		public function rejectRequest($i_fr_id){
			try{

				$sql = "UPDATE `function_reservation` SET `i_fr_status`=2 WHERE `i_fr_id`=$i_fr_id";


				if($this->conn->query($sql)){
					return "Request has been rejected.";
				}
				else{
					return "Error updating record: " . $this->conn->error;
				}

			}catch(exception $e){
				return $e;
			}
		}

		public function deleteRequest($i_fr_id){

			try{

				$sql = "DELETE FROM `function_reservation` WHERE `i_fr_id`=$i_fr_id";

				if($this->conn->query($sql) === TRUE){
					return "This request has been deleted";
				}
				else{
					return "Error: " . $this->conn->error;
				}

			}catch(exception $e){
				return $e;
			}

		}

		public function createRequest($agency,$agency_add,$room,$title,$participants,$dt_arrival,$dt_departure,$nature,$reservedBy,$reserved_add,$contact,$email){

			try{

				$agency = mysqli_real_escape_string($this->conn,utf8_decode($agency));
				$agency_add = mysqli_real_escape_string($this->conn,utf8_decode($agency_add));
				$title = mysqli_real_escape_string($this->conn,utf8_decode($title));
				$nature = mysqli_real_escape_string($this->conn,utf8_decode($nature));
				$reservedBy = mysqli_real_escape_string($this->conn,utf8_decode($reservedBy));
				$reserved_add = mysqli_real_escape_string($this->conn,utf8_decode($reserved_add));
				$contact = mysqli_real_escape_string($this->conn,utf8_decode($contact));
				$email = mysqli_real_escape_string($this->conn,utf8_decode($email));

				date_default_timezone_set('Asia/Manila');
				$today = date("Y-m-d H:i:s",strtotime("now"));

				$sql = "INSERT INTO `function_reservation`(`i_rm_id`,`str_agency`,`str_agency_add`,`dt_arrival`,`dt_departure`,`str_nature`,`str_title`,`i_no_participants`,`str_requisitioner`,`str_address`,`str_mobile_no`,`str_email`,`dt_requested`,`i_fr_status`) VALUES($room,'$agency','$agency_add','$dt_arrival','$dt_departure','$nature','$title',$participants,'$reservedBy','$reserved_add','$contact','$email','$today',0)";
				if($this->conn->query($sql)){
					return "Created new schedule";
				}
				else{
					return "Error: " . $sql . "<br>" . $this->conn->error;
				}
				$this->conn->close();
				
			}catch(exception $e){
				return $e;
			}

		}

		public function getReject($search,$category){
			//	$sql = "";
			try{
				$search = mysqli_real_escape_string($this->conn,utf8_decode($search));

				if($category==1){
					$sql = "SELECT `rm`.`str_rmName`,`fr`.`i_fr_id`, `fr`.`str_title`,`fr`.`dt_arrival`,`fr`.`dt_departure`,`fr`.`str_requisitioner`,`fr`.`dt_requested`
					FROM `function_reservation` `fr`
					INNER JOIN `room` `rm`
					ON `fr`.`i_rm_id`=`rm`.`i_rm_id`
					WHERE `str_title` LIKE '$search%' AND `i_fr_status`=2 ORDER BY `fr`.`dt_requested` DESC";
				}

				else if($category==2){
					$sql = "SELECT `rm`.`str_rmName`,`fr`.`i_fr_id`, `fr`.`str_title`,`fr`.`dt_arrival`,`fr`.`dt_departure`,`fr`.`str_requisitioner`,`fr`.`dt_requested` 
					FROM `function_reservation` `fr`
					INNER JOIN `room` `rm`
					ON `fr`.`i_rm_id`=`rm`.`i_rm_id`
					WHERE `str_requisitioner` LIKE '$search%' AND `i_fr_status`=2 ORDER BY `fr`.`dt_requested` DESC";
				}

				else{
					if($search != ""){
						$search = date("Y-m-d h:i:s",strtotime($search));
						$sql = "SELECT `rm`.`str_rmName`,`fr`.`i_fr_id`, `fr`.`str_title`,`fr`.`dt_arrival`,`fr`.`dt_departure`,`fr`.`str_requisitioner`,`fr`.`dt_requested` 
							FROM `function_reservation` `fr`
							INNER JOIN `room` `rm`
							ON `fr`.`i_rm_id`=`rm`.`i_rm_id`
							WHERE ('$search' <= `fr`.`dt_departure`) AND ('$search' >= `fr`.`dt_arrival` ) AND `i_fr_status`=2 ORDER BY `fr`.`dt_requested` DESC";
					}
					else{
						$sql = "SELECT `rm`.`str_rmName`,`fr`.`i_fr_id`, `fr`.`str_title`,`fr`.`dt_arrival`,`fr`.`dt_departure`,`fr`.`str_requisitioner`,`fr`.`dt_requested` 
							FROM `function_reservation` `fr`
							INNER JOIN `room` `rm`
							ON `fr`.`i_rm_id`=`rm`.`i_rm_id`
							WHERE `i_fr_status`=2 ORDER BY `fr`.`dt_requested` DESC";
					}
					
				}
				$data = "";
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					//date_default_timezone_set('Asia/Manila');
					while ($row = $result->fetch_assoc()) {
						$data .= "<tr><td><center>" . utf8_encode($row["str_rmName"]) . "</center></td><td><center>" . utf8_encode($row["str_title"]) .  "</center></td><td><center>" . date("F d, Y h:ia",strtotime($row["dt_arrival"])) . "</center></td><td><center>" . date("F d, Y h:ia",strtotime($row["dt_departure"])) .  "</center></td><td><center>" . utf8_encode($row["str_requisitioner"]) . "</center></td><td><center>" . date("F d, Y h:ia",strtotime($row["dt_requested"])) . "</center></td><td><center><button class='btn btn-primary' id='recover-reject' data-id='" . $row["i_fr_id"] . "'><i class='fa fa-undo'></i> Recover</button></center></td><td><center><button class='btn btn-danger' id='delete-reject' data-id='" . $row["i_fr_id"] . "'><i class='fa fa-trash'></i> Delete</button></center></td></tr>";
					}
				}

				else{
					$data = "<tr class='bg-danger text-white'><td colspan='8'><center><h3>Empty Result</h3></center></td></tr>";
				}
				return $data;

			}catch(exception $e){
				return $e;
			}

		}

		public function recoverReject($i_fr_id){

			try{

				$sql = "UPDATE `function_reservation` SET `i_fr_status`=0 WHERE `i_fr_id`=$i_fr_id";


				if($this->conn->query($sql)){
					return "Request has been recovered.";
				}
				else{
					return "Error updating record: " . $this->conn->error;
				}

			}catch(exception $e){
				return $e;
			}

		}

		public function deleteReject($i_fr_id){

			try{

				$sql = "DELETE FROM `function_reservation` WHERE `i_fr_id`=$i_fr_id";

				if($this->conn->query($sql) === TRUE){
					return "This request has been deleted";
				}
				else{
					return "Error: " . $this->conn->error;
				}

			}catch(exception $e){
				return $e;
			}

		}

		public function getCheckin(){

			try{

				$sql = "SELECT `fr`.`i_fr_id`, `rm`.`str_rmName`,`fr`.`str_title`,`fr`.`str_requisitioner`,`fr`.`dt_arrival`,`fr`.`dt_departure`,`fr`.`dt_checkin`
					FROM `function_reservation` `fr` 
					INNER JOIN `room` `rm`
					ON `fr`.`i_rm_id`=`rm`.`i_rm_id`
					WHERE `fr`.`i_fr_status`=4";
				$data = NULL;
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						$data .= "<tr><td><center>" . utf8_encode($row["str_rmName"]) . "</center></td><td><center>" . utf8_encode($row["str_title"]) . "</center></td><td><center>" . utf8_encode($row["str_requisitioner"]) . "</center></td><td><center>" . date("F d, Y h:ia",strtotime($row["dt_checkin"])) . "</center></td><td><center>" . date("F d, Y h:ia",strtotime($row["dt_departure"])) . "</center></td><td><center><button class='btn btn-primary' id='view-checkin' data-id='" . $row["i_fr_id"] . "'><i class='fa fa-search'></i> View</button></center></td><td><center><button class='btn btn-primary' id='viewRate-checkin' data-id='" . $row["i_fr_id"] . "'><i class='fa fa-search'></i> View Rate</button></center></td><td><center><button class='btn btn-primary' id='checkout-checkin' data-id='" . $row["i_fr_id"] . "'><i class='fa fa-sign-out-alt'></i> Check-out</button></center></td><td><center><button class='btn btn-danger' id='delete-checkin' data-id='" . $row["i_fr_id"] . "'><i class='fa fa-times'></i> Delete</button></center></td></tr>";

						//<td><center>" . date("F d, Y h:ia",strtotime($row["dt_arrival"])) . "</center></td>
					}
				}
				else{
					$data = "<tr class='bg-danger text-white'><td colspan='7'><center><h3>No record found</h3></center></td></tr>";
				}
				return $data;

			}catch(exception $e){
				return $e;
			}

		}

		public function viewCheckinInfo($i_fr_id){

			try{

				$sql = "SELECT `fr`.`i_fr_id`, `fr`.`i_rm_id`, `fr`.`str_agency`,`fr`.`str_agency_add`,`fr`.`dt_arrival`,`fr`.`dt_departure`,`fr`.`dt_checkin`,`fr`.`str_nature`,`fr`.`str_title`,`fr`.`i_no_participants`,`fr`.`str_requisitioner`,`fr`.`str_address`,`fr`.`str_address`,`fr`.`str_mobile_no`,`fr`.`str_email`,`fr`.`i_fr_status`
					FROM `function_reservation` `fr` 
					INNER JOIN `room` `rm`
					ON `fr`.`i_rm_id`=`rm`.`i_rm_id`
					WHERE `fr`.`i_fr_id`=$i_fr_id";

				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						return array("i_fr_id"=>$row["i_fr_id"],"room"=>$row["i_rm_id"],"agency"=>utf8_encode($row["str_agency"]),"agencyAdd"=>utf8_encode($row["str_agency_add"]),"checkin"=>$row["dt_checkin"],"departure"=>$row["dt_departure"],"nature"=>utf8_encode($row["str_nature"]),"title"=>utf8_encode($row["str_title"]),"participants"=>$row["i_no_participants"],"requisitioner"=>utf8_encode($row["str_requisitioner"]),"address"=>utf8_encode($row["str_address"]),"contact"=>utf8_encode($row["str_mobile_no"]),"email"=>utf8_encode($row["str_email"]),"status"=>$row["i_fr_status"]);
					}
				}

			}catch(exception $e){
				return $e;
			}
			
			//return array("i_fr_id"=>$i_fr_id);

		}

		public function checkCheckin_updateCheckinInfo($i_fr_id,$room){

			try{

				//GET ROOM FROM function_reservation
				/*$sql = "SELECT `i_rm_id` FROM `function_reservation` WHERE `i_fr_id`=$i_fr_id";//2
				$room_id = NULL;
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						$room_id = $row["i_rm_id"];
					}
				}*/

				
				$sql = "SELECT * FROM function_reservation WHERE i_rm_id=$room AND i_fr_status = 4 AND i_fr_id<>$i_fr_id";
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					/*while ($row = $result->fetch_assoc()) {
						return 
					}*/
					return 1;
				}

			}catch(exception $e){
				return $e;
			}

		}

		public function updateCheckinInfo($i_fr_id,$agency,$agencyAdd,$room,$title,$participants,$nature,$requisitioner,$address,$contact,$email){

			try{

				$agency = mysqli_real_escape_string($this->conn,utf8_decode($agency));
				$agencyAdd = mysqli_real_escape_string($this->conn,utf8_decode($agencyAdd));
				$title = mysqli_real_escape_string($this->conn,utf8_decode($title));
				$nature = mysqli_real_escape_string($this->conn,utf8_decode($nature));
				$requisitioner = mysqli_real_escape_string($this->conn,utf8_decode($requisitioner));
				$address = mysqli_real_escape_string($this->conn,utf8_decode($address));
				$contact = mysqli_real_escape_string($this->conn,utf8_decode($contact));
				$email = mysqli_real_escape_string($this->conn,utf8_decode($email));

				$sql = "UPDATE `function_reservation` SET `i_rm_id`=$room, `str_agency`='$agency', `str_agency_add`='$agencyAdd', `str_nature`='$nature', `str_title`='$title', `i_no_participants`=$participants, `str_requisitioner`='$requisitioner', `str_address`='$address', `str_mobile_no`='$contact', `str_email`='$email' WHERE `i_fr_id`=$i_fr_id";

				if($this->conn->query($sql)){
					return "Successfully updated";
				}
				else{
					return "Error: " . $sql . "<br>" . $this->conn->error;
				}

			}catch(exception $e){
				return $e;
			}

		}

		/*public function getParticularsCategory($room_id){

			try{

				$sql = "SELECT i_pid, enum_category FROM particulars";
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					$temp = NULL;
					while ($row = $result->fetch_assoc()) {
						
					}
				}

			}catch(exception $e){
				return $e;
			}

		}*/

		public function getTotalHours($checkin,$checkout){
			
			$d_start = date("Y-m-d",strtotime($checkin));
			$t_start = date("H:i:s",strtotime($checkin));
			
			$d_end = date("Y-m-d",strtotime($checkout));
			$t_end = date("H:i:s",strtotime($checkout));

			$open_time = "08:00:00";
			$close_time = "17:00:00";

			$hours = 0;
			$total_hours = 0;

			
			if($d_start == $d_end){


				if($t_start <= $close_time && $t_end >= $close_time){
					$total_hours = round(abs(strtotime($close_time) - strtotime($t_start))/3600);
					//$total_hours = 1;
				}

				else if($t_start <= $close_time && $t_end < $close_time){
					$total_hours = round(abs(strtotime($t_end) - strtotime($t_start))/3600);
					//$total_hours = 2;
				}
				
				//else if($)

				//ORIGINAL
				/*if($t_end >= $close_time){
					$total_hours = round(abs(strtotime($close_time) - strtotime($t_start))/3600);
				}
				else if($t_start > $close_time){
					$total_hours = 0;
				}
				//else if($)
				else{
					$total_hours = round(abs(strtotime($t_end) - strtotime($t_start))/3600);
				}*/
				//echo "<br>Date: " . $array["d_start"] . "&nbsp&nbsp&nbspFrom: " . $array["t_start"] . "&nbsp&nbsp&nbspTo: " . $array["t_end"];
				//echo "&nbsp&nbsp&nbsp Total Hours: " . $total_hours;
			}

			else{
				
				
				$temp_start = NULL;
				$temp_end = NULL;
				
				for($temp_date = $d_start; $temp_date <= $d_end;){
					if($temp_date == $d_start){

						//ORIGINAL
						if($t_start < $close_time){ //16:30 < 17:00:00
							$temp_start = $t_start;//8:03
							$temp_end = $close_time;//17:00
							$hours = round(abs(strtotime($temp_end) - strtotime($temp_start))/3600);
							//$hours = round(abs(strtotime($temp_end) - strtotime($temp_start))/3600,2);
							$total_hours+=$hours;
						}
						
					}
					
					else if($temp_date > $d_start && $temp_date < $d_end){
						$temp_start = $open_time;
						$temp_end = $close_time;
						$hours = round(abs(strtotime($temp_end) - strtotime($temp_start))/3600);
						//$hours = round(abs(strtotime($temp_end) - strtotime($temp_start))/3600,2);
						$total_hours+=$hours;
					}

					else if($temp_date == $d_end){

						if($t_end < $open_time){ //02:30 < 8:00:00

						}

						else if($t_end >= $open_time && $t_end <= $close_time){ // 02:00
							$temp_start = $open_time;
							$temp_end = $t_end;
							$hours = round(abs(strtotime($temp_end) - strtotime($temp_start))/3600);
							//$hours = round(abs(strtotime($temp_end) - strtotime($temp_start))/3600,2);
							$total_hours+=$hours;
						}

						else{
							$temp_start = $open_time;
							$temp_end = $close_time;
							$hours = round(abs(strtotime($temp_end) - strtotime($temp_start))/3600);
							//$hours = round(abs(strtotime($temp_end) - strtotime($temp_start))/3600,2);
							$total_hours+=$hours;
						}
						
						/*if($t_end >= $close_time){ //if 02:05am >= 17:00:00
							$temp_start = $open_time;
							$temp_end = $close_time;
						}
						
						else{
							if($t_end < $open_time){ //

							}
							else{
								$temp_start = $open_time;
								$temp_end = $t_end;
							}
						}*/
						
					}

					$temp_date = date("Y-m-d",strtotime("+1 day", strtotime($temp_date)));
	
					//return $total_hours;
				}
			
			}
			return $total_hours;

		}

		public function getCheckoutBill($i_fr_id,$hours){

			try{

				$sql = "SELECT `bill`.`i_bid`,`bill`.`i_fr_id`,`bill`.`i_pid`,`part`.`enum_category`,`part`.`str_description`,`part`.`enum_aircon`,`part`.`f_first_hour`,`part`.`f_succeeding_hour`
					FROM `billing` `bill`

					INNER JOIN `particulars` `part`
					ON `bill`.`i_pid`=`part`.`i_pid`
					WHERE `bill`.`i_fr_id`=$i_fr_id";
				$data = NULL;
				
				$category = NULL;
				$description = NULL;
				$aircon = NULL;
				$first_hour = 0;
				$succeeding_hour = 0;
				$total_amount = 0;
				$i_bid = NULL;

				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						$first_hour = $row["f_first_hour"];
						$succeeding_hour = $row["f_succeeding_hour"];
						$category = $row["enum_category"];
						$description = $row["str_description"];
						$aircon = $row["enum_aircon"];
						$i_bid = $row["i_bid"];
					}

					//Calculate total amount

					if($hours == 0){
						$total_amount+=$first_hour;
					}
					else{
						for($i = 0; $i<$hours;$i++){
							if($i==0){
								$total_amount+=$first_hour;
							}
							else{
								$total_amount+=$succeeding_hour;
							}
						}
					}

					
					$data = "<tr><td><center>$category - $description - $aircon</center></td>";
					$data .= "<td><center>" . number_format($total_amount,2) . "</center></td>";
					$data .= "<td colspan='2'><center><button id='createBill-viewParticular' class='btn btn-primary' data-id='$i_bid' data-category='particular'><i class='fa fa-search'></i> View</button></center></td></tr>";
				}


				//Get all ameneity data depending on i_fr_id
				$sql = "SELECT `fr`.`i_fr_id`, `fr`.`str_requisitioner`,`bam`.`i_baid`,`bam`.`i_fr_id`,`bam`.`i_aid`,`am`.`i_aid`,`am`.`str_description`,`am`.`f_rate`
					FROM `bill_ameneties` `bam`
					INNER JOIN `ameneties` `am` 
					ON `bam`.`i_aid`=`am`.`i_aid`
					INNER JOIN `function_reservation` `fr`
					ON `bam`.`i_fr_id`=`fr`.`i_fr_id`
					WHERE `bam`.`i_fr_id`=$i_fr_id";

				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {

						$total_amount += $row["f_rate"];
						$data .= "<tr><td><center>" . $row["str_description"] . "</center></td>";
						$data .= "<td><center>" . number_format($row["f_rate"],2) . "</center></td>";
						$data .= "<td><center><button id='createBill-viewAmenity' class='btn btn-primary' data-category='amenity' data-id='" . $row["i_baid"] . "'><i class='fa fa-search'></i> View</button></center></td>";
						$data .= "<td><center><button id='createBill-deleteAmenity' class='btn btn-danger' data-category='amenity' data-id='" . $row["i_baid"] . "'><i class='fa fa-times'></i> Delete</button></center></td></tr>";
					}
				}

				return array("data"=>$data,"totalAmount"=>number_format($total_amount,2));
				//return $data;


				//return $total_amount;

			}catch(exception $e){
				return $e;
			}

		}

		public function getRegisteredParticular($i_fr_id){

			try{

				$sql = "SELECT `bill`.`i_bid`, `bill`.`i_fr_id`, `bill`.`i_pid`, `part`.`enum_category`, `part`.`str_description`, `part`.`enum_aircon`, `part`.`f_first_hour`, `part`.`f_succeeding_hour`
					FROM `billing` `bill`
					INNER JOIN `particulars` `part` 
					ON `bill`.`i_pid`=`part`.`i_pid`
					WHERE `bill`.`i_fr_id` = $i_fr_id";
				$data = NULL;
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						$data .= "<tr>";
						$data .= "<td>" . utf8_encode($row["enum_category"]) . " - " . utf8_encode($row["str_description"]) . " - " . utf8_encode($row["enum_aircon"]) . "</td>";
						
						$data .= "<td><center>" .number_format($row["f_first_hour"],2) . "</center></td>";
						$data .= "<td><center>" . number_format($row["f_succeeding_hour"],2) . "</center></td>";//number_format($total_amount,2) . "</center></td>";
						$data .= "<td><center><button id='createBill-viewParticular' class='btn btn-primary' data-id='" . $row["i_bid"]  . "'><i class='fa fa-search'></i> View</button></center></td>";
						$data .= "</tr>";
					}
				}
				else{
					$data = "<tr class='bg-danger text-white'><td colspan='3'><center>No record found</center></td></tr>";
				}
				return $data;

			}catch(exception $e){
				return $e;
			}

		}

		public function getRegisteredAmenity($i_fr_id){
			$sql = "SELECT `fr`.`i_fr_id`, `fr`.`str_requisitioner`,`bam`.`i_baid`,`bam`.`i_fr_id`,`bam`.`i_aid`,`am`.`i_aid`,`am`.`str_description`,`am`.`f_rate`
				FROM `bill_ameneties` `bam`
				INNER JOIN `ameneties` `am` 
				ON `bam`.`i_aid`=`am`.`i_aid`
				INNER JOIN `function_reservation` `fr`
				ON `bam`.`i_fr_id`=`fr`.`i_fr_id`
				WHERE `bam`.`i_fr_id`=$i_fr_id";
			$data = NULL;
			$result = $this->conn->query($sql);
			if($result->num_rows > 0){
				while ($row = $result->fetch_assoc()) {

					//$total_amount += $row["f_rate"];
					$data .= "<tr><td><center>" . utf8_encode($row["str_description"]) . "</center></td>";
					$data .= "<td><center>" . number_format($row["f_rate"],2) . "</center></td>";
					$data .= "<td><center><button id='createBill-viewAmenity' class='btn btn-primary' data-category='amenity' data-id='" . $row["i_baid"] . "'><i class='fa fa-search'></i> View</button></center></td>";
					$data .= "<td><center><button id='createBill-deleteAmenity' class='btn btn-danger' data-category='amenity' data-id='" . $row["i_baid"] . "'><i class='fa fa-times'></i> Delete</button></center></td></tr>";
				}
			}
			else{
				$data = "<tr class='bg-danger text-white'><td colspan='3'><center>No record found</center></td></tr>";
			}
			return $data;
		}

		public function getBillInfo($i_fr_id){

			try{

				$sql = "SELECT `fr`.`str_requisitioner`,`fr`.`str_title`,`rm`.`str_rmName`,`fr`.`dt_checkin`
					FROM `function_reservation` `fr` 
					INNER JOIN `room` `rm`
					ON `fr`.`i_rm_id`=`rm`.`i_rm_id`
					WHERE `fr`.`i_fr_id`=$i_fr_id";

				date_default_timezone_set('Asia/Manila');
				$today = date("Y-m-d H:i:s",strtotime("now"));

				$name = NULL;
				$title = NULL;
				$room = NULL;
				$checkin = NULL;
				$checkout = $today;
				$total_hours = NULL;

				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						$name = $row["str_requisitioner"];
						$title = $row["str_title"];
						$room = $row["str_rmName"];
						$checkin = $row["dt_checkin"];
					}
				}

				$hours = $this->getTotalHours($checkin,$checkout);
				//$data = $this->getCheckoutBill($i_fr_id,$hours);

				return array("name"=>$name,"title"=>$title,"room"=>$room,"checkin"=>date("Y-m-d h:ia",strtotime($checkin)),"checkout"=>date("Y-m-d h:ia",strtotime($checkout)),"checkout_dataTime"=>$checkout,"hours"=>$hours/*,"data"=>$data*/);
				//return array("name"=>$name,"title"=>$title,"room"=>$room,"checkin"=>date("Y-m-d h:ia",strtotime($checkin)),"checkout"=>date("Y-m-d h:ia",strtotime($checkout)),"hours"=>$hours,"payment"=>$payment);

			}catch(exception $e){
				return $e;
			}

		}

		public function getParticularDescription($category,$aircon){

			try{

				$arr_cat = array("VSU Personnel(First Floor)","VSU Students(First Floor)","Non VSU Employees and Students(First Floor)","VSU Employees and Students(Second Floor)","Non-VSU Employees(Second Floor)");
				if($category == 1){
					if($aircon == 0){
						$sql = "SELECT `i_pid`, `enum_category`, `str_description`, `enum_category` FROM `particulars` WHERE `enum_category`='$arr_cat[0]' AND enum_aircon='Without Aircon'";
					}
					else{
						$sql = "SELECT `i_pid`, `enum_category`, `str_description`, `enum_category` FROM `particulars` WHERE `enum_category`='$arr_cat[0]' AND enum_aircon='With Aircon'";
					}
				}
				else if($category == 2){
					if($aircon == 0){
						$sql = "SELECT `i_pid`, `enum_category`, `str_description`, `enum_category` FROM `particulars` WHERE `enum_category`='$arr_cat[1]' AND enum_aircon='Without Aircon'";
					}
					else{
						$sql = "SELECT `i_pid`, `enum_category`, `str_description`, `enum_category` FROM `particulars` WHERE `enum_category`='$arr_cat[1]' AND enum_aircon='With Aircon'";
					}
				}
				else if($category == 3){
					if($aircon == 0){
						$sql = "SELECT `i_pid`, `enum_category`, `str_description`, `enum_category` FROM `particulars` WHERE `enum_category`='$arr_cat[2]' AND enum_aircon='Without Aircon'";
					}
					else{
						$sql = "SELECT `i_pid`, `enum_category`, `str_description`, `enum_category` FROM `particulars` WHERE `enum_category`='$arr_cat[2]' AND enum_aircon='With Aircon'";
					}
				}
				else if($category == 4){
					if($aircon == 0){
						$sql = "SELECT `i_pid`, `enum_category`, `str_description`, `enum_category` FROM `particulars` WHERE `enum_category`='$arr_cat[3]' AND enum_aircon='Without Aircon'";
					}
					else{
						$sql = "SELECT `i_pid`, `enum_category`, `str_description`, `enum_category` FROM `particulars` WHERE `enum_category`='$arr_cat[3]' AND enum_aircon='With Aircon'";
					}
				}
				else if($category == 5){
					if($aircon == 0){
						$sql = "SELECT `i_pid`, `enum_category`, `str_description`, `enum_category` FROM `particulars` WHERE `enum_category`='$arr_cat[4]' AND enum_aircon='Without Aircon'";
					}
					else{
						$sql = "SELECT `i_pid`, `enum_category`, `str_description`, `enum_category` FROM `particulars` WHERE `enum_category`='$arr_cat[4]' AND enum_aircon='With Aircon'";
					}
				}
				$data = NULL;
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						$data .= "<option value='" . $row["i_pid"] . "'>" . $row["str_description"] . "</option>";
					}
				}
				return $data;

			}catch(exception $e){
				return $e;
			}

		}

		
		public function getRate($i_pid){

			$sql = "SELECT `f_first_hour`,`f_succeeding_hour` FROM `particulars` WHERE `i_pid`=$i_pid";
			$result = $this->conn->query($sql);
			if($result->num_rows > 0){
				while ($row = $result->fetch_assoc()) {
					return array("first_hour"=>$row["f_first_hour"],"succeeding_hour"=>$row["f_succeeding_hour"]);
				}
			}
		}

		public function getBill($total_hours,$first_hour,$succeeding_hour){

			try{

				$total_amount = 0;
				for($i = 0; $i<$total_hours;$i++){
					if($i==0){
						$total_amount+=$first_hour;
					}
					else{
						$total_amount+=$succeeding_hour;
					}
				}

				return array("total_amount"=>$total_amount);

			}catch(exception $e){
				return $e;
			}

		}

		public function viewParticularDescription($category,$aircon){
			try{

				$arr_cat = array("VSU Personnel(First Floor)","VSU Students(First Floor)","Non VSU Employees and Students(First Floor)","VSU Employees and Students(Second Floor)","Non-VSU Employees(Second Floor)");
				if($category == 1){
					if($aircon == 0){
						$sql = "SELECT `i_pid`, `enum_category`, `str_description`, `enum_category` FROM `particulars` WHERE `enum_category`='$arr_cat[0]' AND enum_aircon='Without Aircon'";
					}
					else{
						$sql = "SELECT `i_pid`, `enum_category`, `str_description`, `enum_category` FROM `particulars` WHERE `enum_category`='$arr_cat[0]' AND enum_aircon='With Aircon'";
					}
				}
				else if($category == 2){
					if($aircon == 0){
						$sql = "SELECT `i_pid`, `enum_category`, `str_description`, `enum_category` FROM `particulars` WHERE `enum_category`='$arr_cat[1]' AND enum_aircon='Without Aircon'";
					}
					else{
						$sql = "SELECT `i_pid`, `enum_category`, `str_description`, `enum_category` FROM `particulars` WHERE `enum_category`='$arr_cat[1]' AND enum_aircon='With Aircon'";
					}
				}
				else if($category == 3){
					if($aircon == 0){
						$sql = "SELECT `i_pid`, `enum_category`, `str_description`, `enum_category` FROM `particulars` WHERE `enum_category`='$arr_cat[2]' AND enum_aircon='Without Aircon'";
					}
					else{
						$sql = "SELECT `i_pid`, `enum_category`, `str_description`, `enum_category` FROM `particulars` WHERE `enum_category`='$arr_cat[2]' AND enum_aircon='With Aircon'";
					}
				}
				else if($category == 4){
					if($aircon == 0){
						$sql = "SELECT `i_pid`, `enum_category`, `str_description`, `enum_category` FROM `particulars` WHERE `enum_category`='$arr_cat[3]' AND enum_aircon='Without Aircon'";
					}
					else{
						$sql = "SELECT `i_pid`, `enum_category`, `str_description`, `enum_category` FROM `particulars` WHERE `enum_category`='$arr_cat[3]' AND enum_aircon='With Aircon'";
					}
				}
				else if($category == 5){
					if($aircon == 0){
						$sql = "SELECT `i_pid`, `enum_category`, `str_description`, `enum_category` FROM `particulars` WHERE `enum_category`='$arr_cat[4]' AND enum_aircon='Without Aircon'";
					}
					else{
						$sql = "SELECT `i_pid`, `enum_category`, `str_description`, `enum_category` FROM `particulars` WHERE `enum_category`='$arr_cat[4]' AND enum_aircon='With Aircon'";
					}
				}
				$data = NULL;
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						$data .= "<option value='" . $row["i_pid"] . "'>" . $row["str_description"] . "</option>";
					}
				}
				return $data;

			}catch(exception $e){
				return $e;
			}
		}

		public function viewParticular($i_bid){


			try{

				$sql = "SELECT `bill`.`i_bid`,`bill`.`i_fr_id`,`bill`.`i_pid`,`part`.`enum_category`,`part`.`str_description`,`part`.`enum_aircon`,`part`.`f_first_hour`,`part`.`f_succeeding_hour`
					FROM `billing` `bill` 
					INNER JOIN
					`particulars` `part` 
					ON `bill`.`i_pid`=`part`.`i_pid`
					WHERE `bill`.`i_bid`=$i_bid";

				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						return array("i_bid"=>$row["i_bid"],"i_fr_id"=>$row["i_fr_id"],"i_pid"=>$row["i_pid"],"category"=>$row["enum_category"],"description"=>$row["str_description"],"aircon"=>$row["enum_aircon"],"first_hour"=>$row["f_first_hour"],"succeeding_hour"=>$row["f_succeeding_hour"]);
					}
				}

			}catch(exception $e){
				return $e;
			}
			//return array("i_bid"=>$i_bid);

		}

		public function updateParticular($i_pid,$i_bid){

			try{

				//return "PID: " . $i_pid . " BID: " . $i_bid;
				$sql = "UPDATE `billing` SET `i_pid`=$i_pid WHERE `i_bid`=$i_bid";
				if($this->conn->query($sql)){
					return "Particular has successfully updated.";
				}

				else{
					return "Error: " . $sql . "<br>" . $this->conn->error();
				}

			}catch(exception $e){
				return $e;
			}

		}

		public function createAmenity($i_fr_id,$description,$payment){

			try{
				$description = mysqli_real_escape_string($this->conn,utf8_decode($description));
				$payment = sprintf("%.2f",$payment);
				$sql = "INSERT INTO `ameneties`(`str_description`,`f_rate`) VALUES('$description',$payment)";

				//Success create amenity
				if($this->conn->query($sql)){
					
					$i_aid = $this->conn->insert_id; //Get last insert ID
					$sql = "INSERT INTO `bill_ameneties`(`i_fr_id`,`i_aid`) VALUES($i_fr_id,$i_aid)";
					if($this->conn->query($sql)){
						return "Amenity has been added.";
					}
					else{
						return "Error: " . $sql . "<br>" . $this->conn->error;
					}
				}
				else{
					return "Error: " . $sql . "<br>" . $this->conn->error;
				}

			}catch(exception $e){
				return $e;
			}

		}

		public function viewAmenity($i_baid){

			try{

				$sql = "SELECT `bam`.`i_baid`,`bam`.`i_fr_id`,`bam`.`i_aid`,`am`.`str_description`,`am`.`f_rate` 
				FROM `bill_ameneties` `bam` 
				INNER JOIN `ameneties` `am`
				ON `bam`.`i_aid`=`am`.`i_aid` WHERE `bam`.`i_baid`=$i_baid";

				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						return array("description"=>utf8_encode($row["str_description"]),"rate"=>$row["f_rate"]);
					}
				}

			}catch(exception $e){
				return $e;
			}

		}

		public function editAmenity($i_baid,$description,$payment){
 
			try{

				$description = mysqli_real_escape_string($this->conn,utf8_decode($description));
				$payment = sprintf("%.2f",$payment);
				//Get amenity ID
				$sql = "SELECT `bam`.`i_baid`,`bam`.`i_fr_id`,`bam`.`i_aid`
					FROM `bill_ameneties` `bam` 
					INNER JOIN `ameneties` `am`
					ON `bam`.`i_aid`=`am`.`i_aid` WHERE `bam`.`i_baid`=$i_baid";

				$i_aid = NULL;
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						$i_aid = $row["i_aid"];
						//return array("description"=>$row["str_description"],"rate"=>$row["f_rate"]);
					}
				}

				$sql = "UPDATE `ameneties` SET `str_description`='$description', `f_rate`=$payment WHERE `i_aid`=$i_aid";

				if($this->conn->query($sql)){
						return "Amenity has been updated";		
					}
					else{
						return "Error updating record: " . $sql . "<br>" . $this->conn->error();
					}

				//return $i_aid;

			}catch(exception $e){
				return $e;
			}

		}

		public function deleteAmenity($i_baid){

			try{

				//Get amenity ID
				$sql = "SELECT `bam`.`i_baid`,`bam`.`i_fr_id`,`bam`.`i_aid`
					FROM `bill_ameneties` `bam` 
					INNER JOIN `ameneties` `am`
					ON `bam`.`i_aid`=`am`.`i_aid` WHERE `bam`.`i_baid`=$i_baid";

				$i_aid = NULL;
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						$i_aid = $row["i_aid"];
						//return array("description"=>$row["str_description"],"rate"=>$row["f_rate"]);
					}
				}

				//DELETE bill_amenity and amenity
				$sql = "DELETE FROM `bill_ameneties` WHERE `i_baid`=$i_baid";
				if($this->conn->query($sql) === TRUE){
					//return "Amenity has been deleted";
					$sql = "DELETE FROM `ameneties` WHERE `i_aid`=$i_aid";
					if($this->conn->query($sql) === TRUE){
						return "Amenity has been deleted";
					}
					else{
						return "Error: " . $sql . "<br>" . $this->conn->error;
					}
				}
				else{
					return "Error: " . $sql . "<br>" . $this->conn->error;
				}

			}catch(exception $e){
				return $e;
			}

		}

		public function generateCheckoutBill($i_fr_id){

			try{

				$room = NULL;
				$name = NULL;
				$checkin = NULL;
				$checkout = NULL;
				$hours = NULL;
				$particular_fee = 0;
				$amenity_fee = 0;
				$total_fee = 0;

				$sql = "SELECT `rm`.`str_rmName`,`fr`.`str_requisitioner`,`fr`.`dt_checkin`
						FROM `function_reservation` `fr` 
						INNER JOIN `room` `rm`
						ON `fr`.`i_rm_id`=`rm`.`i_rm_id`
						WHERE `i_fr_id`=$i_fr_id";
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					date_default_timezone_set('Asia/Manila');
					//$checkout = date("2018-05-14 15:30:00");

					//temp
					//$checkout = "2018-05-27 15:45:00";
					//ORIGINAL
					$checkout = date("Y-m-d H:i:s",strtotime("now"));
					while ($row = $result->fetch_assoc()) {
						$room = $row["str_rmName"];
						$name = $row["str_requisitioner"];
						$checkin = $row["dt_checkin"];
					}

					$hours = $this->getTotalHours($checkin,$checkout);//Get total hours

					//Get particular fee
					$sql = "SELECT `bill`.`i_bid`,`bill`.`i_fr_id`,`bill`.`i_pid`,`part`.`f_first_hour`,`part`.`f_succeeding_hour`
					FROM `billing` `bill`

					INNER JOIN `particulars` `part`
					ON `bill`.`i_pid`=`part`.`i_pid`
					WHERE `bill`.`i_fr_id`=$i_fr_id";
					//$data = NULL;
					
					//$category = NULL;
					//$description = NULL;
					//$aircon = NULL;
					$first_hour = 0;
					$succeeding_hour = 0;
					$i_bid = NULL;

					$result = $this->conn->query($sql);
					if($result->num_rows > 0){
						while ($row = $result->fetch_assoc()) {
							$first_hour = $row["f_first_hour"];
							$succeeding_hour = $row["f_succeeding_hour"];
							$i_bid = $row["i_bid"];
						}

						//Calculate total amount

						if($hours == 0){
							$particular_fee+=$first_hour;
						}
						else{
							for($i = 0; $i<$hours;$i++){
								if($i==0){
									$particular_fee+=$first_hour;
								}
								else{
									$particular_fee+=$succeeding_hour;
								}
							}
						}

					}

					$particular_fee = sprintf("%.2f",$particular_fee);


					//Get all ameneity data depending on i_fr_id
					$sql = "SELECT `fr`.`i_fr_id`,`bam`.`i_baid`,`bam`.`i_fr_id`,`bam`.`i_aid`,`am`.`i_aid`,`am`.`f_rate`
						FROM `bill_ameneties` `bam`
						INNER JOIN `ameneties` `am` 
						ON `bam`.`i_aid`=`am`.`i_aid`
						INNER JOIN `function_reservation` `fr`
						ON `bam`.`i_fr_id`=`fr`.`i_fr_id`
						WHERE `bam`.`i_fr_id`=$i_fr_id";

					$result = $this->conn->query($sql);
					if($result->num_rows > 0){
						while ($row = $result->fetch_assoc()) {

							$amenity_fee += $row["f_rate"];
							
						}
					}

					$amenity_fee = sprintf("%.2f",$amenity_fee);

					$total_fee = $particular_fee + $amenity_fee;
					$total_fee = sprintf("%.2f",$total_fee);
					return array("room"=>$room,"name"=>utf8_encode($name),"checkin"=>date("F d, Y h:ia",strtotime($checkin)),"checkinData"=>$checkin,"checkout"=>date("F d, Y h:ia",strtotime($checkout)),"checkoutData"=>$checkout,"hours"=>$hours,"particularFee"=>$particular_fee,"amenityFee"=>$amenity_fee,"totalFee"=>$total_fee);
					
				}

			}catch(exception $e){
				return $e;
			}

		}

		public function checkOut($i_fr_id,$checkout,$particularFee/*,$billStatus,$ORNum*/){

			try{

				$i_bid = NULL;
				$sql = "SELECT * FROM `billing` WHERE `i_fr_id`=$i_fr_id";
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						$i_bid = $row["i_bid"];
					}
				}

				//Update Billing
				/*
				if($billStatus==0){
					$sql = "UPDATE `billing` SET `f_amount`=$particularFee,`i_bill_status`=0 WHERE `i_bid`=$i_bid";
				}
				else{
					if($ORNum==""){
						$ORNum = NULL;
					}
					$sql = "UPDATE `billing` SET `f_amount`=$particularFee, `i_b_ORnum`=$ORNum,`i_bill_status`=1 WHERE `i_bid`=$i_bid";
				}*/
				//Execute query
				$sql = "UPDATE `billing` SET `f_amount`=$particularFee,`i_bill_status`=0 WHERE `i_bid`=$i_bid";
				if($this->conn->query($sql)){

				}
				else{
					return "Error: " . $sql . "<br>" . $this->conn->error;
				}

				//Get all data where from that i_fr_id
				$sql = "SELECT `bam`.`i_baid`,`bam`.`i_fr_id`,`bam`.`i_aid`,`bam`.`f_amount`,`am`.`f_rate`,`am`.`enum_amen_category`
					FROM `bill_ameneties` `bam`
					INNER JOIN `ameneties` `am`
					ON `bam`.`i_aid`=`am`.`i_aid`
					WHERE `bam`.`i_fr_id`=$i_fr_id";
				$result = $this->conn->query($sql);

				if($result->num_rows > 0){
					//Update amount per i_baid
					while ($row = $result->fetch_assoc()) {
						$i_baid = $row["i_baid"];
						$f_rate = $row["f_rate"];

						$sql = "UPDATE `bill_ameneties` SET `f_amount`=$f_rate WHERE `i_baid`=$i_baid";
						if($this->conn->query($sql)){

						}
						else{
							return "Error: " . $sql . "<br>" . $this->conn->error;
						}
					}
				}

				$sql = "UPDATE `function_reservation` SET `dt_checkout`='$checkout', `i_fr_status`=5 WHERE `i_fr_id`=$i_fr_id";

				if($this->conn->query($sql)){
					return "Successfully checked-out";
				}
				else{
					return "Error: " . $sql . "<br>" . $this->conn->error;
				}

				//$sql = "UPDATE `billing` SET ``";
				

			}catch(exception $e){
				return $e;
			}

		}

		public function deleteCheckin($i_fr_id){

			try{
				
				$i_aid = [];
				$data = NULL;
				//get ALL id from amenity
				$sql = "SELECT * FROM `bill_ameneties` WHERE `i_fr_id`=$i_fr_id";
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					$i = 0;
					while ($row = $result->fetch_assoc()) {
						$i_aid[$i] = $row["i_aid"];
						$i++;
					}

					/*$data .= "Amenity Id to be deleted: ";
					for($j = 0;$j<count($i_aid);$j++){
						$data .= $i_aid[$j] . " ,";
					}*/
				
				}

				$sql = "DELETE FROM `function_reservation` WHERE `i_fr_id`=$i_fr_id";
				if($this->conn->query($sql)){
					for($j = 0; $j<count($i_aid);$j++){
						$sql = "DELETE FROM `ameneties` WHERE `i_aid` =" . $i_aid[$j];
						if($this->conn->query($sql)){

						}
						else{

						}
					}
				}
				else{
					return "Error: " . $sql . "<br>" . $this->conn->error;
				}

				return "Successfully deleted";

			}catch(exception $e){
				return $e;
			}

		}

		public function printBill($i_fr_id,$hours){

			$sql = "SELECT `bill`.`i_bid`,`bill`.`i_fr_id`,`bill`.`i_pid`,`part`.`enum_category`,`part`.`str_description`,`part`.`enum_aircon`,`part`.`f_first_hour`,`part`.`f_succeeding_hour`
				FROM `billing` `bill`

				INNER JOIN `particulars` `part`
				ON `bill`.`i_pid`=`part`.`i_pid`
				WHERE `bill`.`i_fr_id`=$i_fr_id";
			$data = NULL;
			
			$category = NULL;
			$description = NULL;
			$aircon = NULL;
			$first_hour = 0;
			$succeeding_hour = 0;
			$total_amount = 0;
			$i_bid = NULL;

			$result = $this->conn->query($sql);
			if($result->num_rows > 0){
				while ($row = $result->fetch_assoc()) {
					$first_hour = $row["f_first_hour"];
					$succeeding_hour = $row["f_succeeding_hour"];
					$category = $row["enum_category"];
					$description = $row["str_description"];
					$aircon = $row["enum_aircon"];
					$i_bid = $row["i_bid"];
				}

				//Calculate total amount

				if($hours == 0){
					$total_amount+=$first_hour;
				}
				else{
					for($i = 0; $i<$hours;$i++){
						if($i==0){
							$total_amount+=$first_hour;
						}
						else{
							$total_amount+=$succeeding_hour;
						}
					}
				}

				
				$data = "<tr><td>$category - $description - $aircon</td>";
				$data .= "<td><center>" . number_format($total_amount,2) . "</center></td>";
				/*$data .= "<td colspan='2'><center><button id='createBill-viewParticular' class='btn btn-primary' data-id='$i_bid' data-category='particular'>View</button></center></td></tr>";*/
			}

			//Get all ameneity data depending on i_fr_id
			$sql = "SELECT `fr`.`i_fr_id`, `fr`.`str_requisitioner`,`bam`.`i_baid`,`bam`.`i_fr_id`,`bam`.`i_aid`,`am`.`i_aid`,`am`.`str_description`,`am`.`f_rate`
				FROM `bill_ameneties` `bam`
				INNER JOIN `ameneties` `am` 
				ON `bam`.`i_aid`=`am`.`i_aid`
				INNER JOIN `function_reservation` `fr`
				ON `bam`.`i_fr_id`=`fr`.`i_fr_id`
				WHERE `bam`.`i_fr_id`=$i_fr_id";

			$result = $this->conn->query($sql);
			if($result->num_rows > 0){
				while ($row = $result->fetch_assoc()) {

					$total_amount += $row["f_rate"];
					$data .= "<tr><td>" . $row["str_description"] . "</td>";
					$data .= "<td><center>" . number_format($row["f_rate"],2) . "</center></td>";
					/*$data .= "<td><center><button id='createBill-viewAmenity' class='btn btn-primary' data-category='amenity' data-id='" . $row["i_baid"] . "'><i class='fa fa-search'></i> View</button></center></td>";
					$data .= "<td><center><button id='createBill-deleteAmenity' class='btn btn-danger' data-category='amenity' data-id='" . $row["i_baid"] . "'><i class='fa fa-times'></i> Delete</button></center></td></tr>";*/
					
				}
			}
			$total_amount = number_format($total_amount,2);
			$data .= "<tr><td style='text-align: right;'>Total</td><td><center>$total_amount</center></td></tr>";
			return $data;
			//echo "<tr><td>w</td><td>a</td></tr>";
		}



		public function getCheckedout($category,$search){

			$search = mysqli_real_escape_string($this->conn,utf8_decode($search));


			if($category == 1){
				$sql = "SELECT `fr`.`i_fr_id`,`rm`.`str_rmName`,`fr`.`str_title`,`fr`.`str_requisitioner`,`fr`.`dt_checkin`,`fr`.`dt_checkout`
				FROM `function_reservation` `fr` 
				INNER JOIN `room` `rm` 
				ON `fr`.`i_rm_id`=`rm`.`i_rm_id`
				WHERE `fr`.`i_fr_status`=5 AND `fr`.`str_title` LIKE '$search%' ORDER BY `fr`.`dt_checkin` DESC";
			}
			else{
				$sql = "SELECT `fr`.`i_fr_id`,`rm`.`str_rmName`,`fr`.`str_title`,`fr`.`str_requisitioner`,`fr`.`dt_checkin`,`fr`.`dt_checkout`
				FROM `function_reservation` `fr` 
				INNER JOIN `room` `rm` 
				ON `fr`.`i_rm_id`=`rm`.`i_rm_id`
				WHERE `fr`.`i_fr_status`=5 AND `fr`.`str_requisitioner` LIKE '$search%'  ORDER BY `fr`.`dt_checkin` DESC";
			}
			
			$data = NULL;
			$result = $this->conn->query($sql);
			if($result->num_rows > 0){
				while ($row = $result->fetch_assoc()) {
					$data .= "<tr><td><center>" . utf8_encode($row["str_rmName"]) . "</center></td><td><center>" . utf8_encode($row["str_title"]) . "</center></td><td><center>" . utf8_encode($row["str_requisitioner"]) . "</center></td><td><center>" . date("F d, Y h:ia",strtotime($row["dt_checkin"])) . "</center></td><td><center>" .  date("F d, Y h:ia",strtotime($row["dt_checkout"])) . "</center></td><td><center><button class='btn btn-primary' id='viewCheckoutInfo' data-id='" . $row["i_fr_id"] . "'><i class='fa fa-search'></i> View Info</button></center></td><td><center><button class='btn btn-primary' id='viewCheckoutBill' data-id='" . $row["i_fr_id"] . "'><i class='fa fa-search'></i> View Bill</button></center></td><td><center><button class='btn btn-danger' id='deleteCheckoutBill' data-id='" . $row["i_fr_id"] . "'><i class='fa fa-times'></i> Delete</button></center></td></tr>";
					//$data .= "<td><center><button class='btn btn-primary' id='viewCheckoutInfo' data-id='" . $row["i_fr_id"] . "'><i class='fa fa-search'></i> View Info</button></center></td><td><center><button class='btn btn-primary' id='viewCheckoutBill' data-id='" . $row["i_fr_id"] . "'><i class='fa fa-search'></i> View Bill</button></center></td></tr>";
				}
			}
			else{
				$data = "<tr class='bg-danger text-white'><td colspan='6'><center><h3>No record</h3></center></td></tr>";
			}

			return $data;

		}

		public function viewCheckoutInfo($i_fr_id){
			try{

				$sql = "SELECT `fr`.`i_fr_id`, `fr`.`i_rm_id`, `fr`.`str_agency`,`fr`.`str_agency_add`,`fr`.`dt_arrival`,`fr`.`dt_departure`,`fr`.`str_nature`,`fr`.`str_title`,`fr`.`i_no_participants`,`fr`.`str_requisitioner`,`fr`.`str_address`,`fr`.`str_address`,`fr`.`str_mobile_no`,`fr`.`str_email`,`fr`.`i_fr_status`
					FROM `function_reservation` `fr` 
					INNER JOIN `room` `rm`
					ON `fr`.`i_rm_id`=`rm`.`i_rm_id`
					WHERE `fr`.`i_fr_id`=$i_fr_id";

				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						return array("i_fr_id"=>$row["i_fr_id"],"room"=>$row["i_rm_id"],"agency"=>utf8_encode($row["str_agency"]),"agencyAdd"=>utf8_encode($row["str_agency_add"]),"nature"=>utf8_encode($row["str_nature"]),"title"=>utf8_encode($row["str_title"]),"participants"=>$row["i_no_participants"],"requisitioner"=>utf8_encode($row["str_requisitioner"]),"address"=>utf8_encode($row["str_address"]),"contact"=>utf8_encode($row["str_mobile_no"]),"email"=>utf8_encode($row["str_email"]),"status"=>$row["i_fr_status"]);
					}
				}

			}catch(exception $e){
				return $e;
			}
		}

		public function updateCheckoutInfo($i_fr_id,$agency,$agencyAdd,$title,$participants,$nature,$requisitioner,$address,$contact,$email){

			try{

				$agency = mysqli_real_escape_string($this->conn,utf8_decode($agency));
				$agencyAdd = mysqli_real_escape_string($this->conn,utf8_decode($agencyAdd));
				$title = mysqli_real_escape_string($this->conn,utf8_decode($title));
				$nature = mysqli_real_escape_string($this->conn,utf8_decode($nature));
				$requisitioner = mysqli_real_escape_string($this->conn,utf8_decode($requisitioner));
				$address = mysqli_real_escape_string($this->conn,utf8_decode($address));
				$contact = mysqli_real_escape_string($this->conn,utf8_decode($contact));
				$email = mysqli_real_escape_string($this->conn,utf8_decode($email));


				$sql = "UPDATE `function_reservation` SET `str_agency`='$agency', `str_agency_add`='$agencyAdd', `str_nature`='$nature', `str_title`='$title', `i_no_participants`=$participants, `str_requisitioner`='$requisitioner', `str_address`='$address', `str_mobile_no`='$contact', `str_email`='$email' WHERE `i_fr_id`=$i_fr_id";

				if($this->conn->query($sql)){
					return "Successfully updated";
				}
				else{
					return "Error: " . $sql . "<br>" . $this->conn->error;
				}

			}catch(exception $e){
				return $e;
			}

		}

		public function viewGenerateCheckoutBill($i_fr_id){

			try{

				//Get all data in function reservation depending on i_fr_id
				$sql = "SELECT `fr`.`str_requisitioner`,`rm`.`str_rmName`,`fr`.`dt_checkin`,`fr`.`dt_checkout`
					FROM `function_reservation` `fr` 
					INNER JOIN `room` `rm` 
					ON `fr`.`i_rm_id`=`rm`.`i_rm_id`
					WHERE `fr`.`i_fr_id`=$i_fr_id";
				$name = NULL;
				$room = NULL;
				$checkin = NULL;
				$checkout = NULL;
				$hours = NULL;

				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						$name = $row["str_requisitioner"];
						$room = $row["str_rmName"];
						$checkin = $row["dt_checkin"];
						$checkout = $row["dt_checkout"];
					}
				}

				$hours = $this->getTotalHours($checkin,$checkout);

				$sql = "SELECT `i_b_ORnum`,`f_amount`,`i_bill_status` FROM `billing` WHERE `i_fr_id`=$i_fr_id";
				$result = $this->conn->query($sql);
				$ORnum = NULL;
				$particularFee = 0;
				$billStatus = 0;
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						$ORnum = $row["i_b_ORnum"];
						$particularFee = $row["f_amount"];
						$billStatus = $row["i_bill_status"];
					}
				}
				$particularFee = sprintf("%.2f",$particularFee);

				$sql = "SELECT `i_fr_id`,`i_aid`,`f_amount` FROM `bill_ameneties` WHERE `i_fr_id`=$i_fr_id";
				$i_aid = NULL;
				$i_fr_id = NULL;
				$amenityFee = 0;
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						$i_fr_id = $row["i_fr_id"];
						$i_aid = $row["i_aid"];
						$amenityFee += $row["f_amount"];
					}
				}

				$amenityFee = sprintf("%.2f",$amenityFee);

				$totalFee = $particularFee + $amenityFee;
				$totalFee = sprintf("%.2f",$totalFee);

				return array("name"=>utf8_encode($name),"room"=>utf8_encode($room),"checkin"=>date("F d, Y h:ia",strtotime($checkin)),"checkout"=>date("F d, Y h:ia",strtotime($checkout)),"hours"=>$hours,"ORNum"=>$ORnum,"particularFee"=>$particularFee,"billStatus"=>$billStatus,"i_fr_id"=>$i_fr_id,"amenityFee"=>$amenityFee,"totalFee"=>$totalFee);
				//return $i_fr_id;

			}catch(exception $e){
				return $e;
			}

		}

		public function updateGenerateCheckoutBill($i_fr_id,$billStatus,$ORNum){
			//return $i_fr_id . " " . $billStatus . " " . $ORNum;
			if($ORNum == ""){
				$sql = "UPDATE `billing` SET `i_b_ORnum`=NULL, `i_bill_status`=$billStatus WHERE `i_fr_id`=$i_fr_id";
			}
			else{
				$sql = "UPDATE `billing` SET `i_b_ORnum`=$ORNum, `i_bill_status`=$billStatus WHERE `i_fr_id`=$i_fr_id";
			}
			
			if($this->conn->query($sql)){
				return "Successfully updated";
			}
			else{
				return "Error: " . $sql . "<br>" . $this->conn->error;
			}

		}

		public function viewCheckoutBillInfo($i_fr_id){
			
			try{

				$sql = "SELECT `fr`.`str_requisitioner`,`fr`.`str_title`,`rm`.`str_rmName`,`fr`.`dt_checkin`,`fr`.`dt_checkout`,`bill`.`i_bill_status`,`bill`.`i_b_ORnum`
					FROM `function_reservation` `fr` 
					INNER JOIN `room` `rm`
					ON `fr`.`i_rm_id`=`rm`.`i_rm_id`
					INNER JOIN `billing` `bill`
					ON `fr`.`i_fr_id`=`bill`.`i_fr_id`
					WHERE `fr`.`i_fr_id`=$i_fr_id";

				/*date_default_timezone_set('Asia/Manila');
				$today = date("Y-m-d H:i:s",strtotime("now"));*/

				$name = NULL;
				$title = NULL;
				$room = NULL;
				$checkin = NULL;
				$checkout = NULL;//$today;
				$total_hours = NULL;
				$bill_status = NULL;
				$bill_ORnum = NULL;

				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						$name = $row["str_requisitioner"];
						$title = $row["str_title"];
						$room = $row["str_rmName"];
						$checkin = $row["dt_checkin"];
						$checkout = $row["dt_checkout"];
						$bill_status = $row["i_bill_status"];
						$bill_ORnum = $row["i_b_ORnum"];
					}
				}

				$hours = $this->getTotalHours($checkin,$checkout);
				//$data = $this->getCheckoutBill($i_fr_id,$hours);

				return array("name"=>$name,"title"=>$title,"room"=>$room,"checkin"=>date("Y-m-d h:ia",strtotime($checkin)),"checkout"=>date("Y-m-d h:ia",strtotime($checkout)),"checkout_dataTime"=>$checkout,"hours"=>$hours,"billing_status"=>$bill_status,"ORNum"=>$bill_ORnum/*,"data"=>$data*/);
				//return array("name"=>$name,"title"=>$title,"room"=>$room,"checkin"=>date("Y-m-d h:ia",strtotime($checkin)),"checkout"=>date("Y-m-d h:ia",strtotime($checkout)),"hours"=>$hours,"payment"=>$payment);

			}catch(exception $e){
				return $e;
			}

		}

		public function deleteCheckout($i_fr_id){
			try{
				
				$i_aid = [];
				$data = NULL;
				//get ALL id from amenity
				$sql = "SELECT * FROM `bill_ameneties` WHERE `i_fr_id`=$i_fr_id";
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					$i = 0;
					while ($row = $result->fetch_assoc()) {
						$i_aid[$i] = $row["i_aid"];
						$i++;
					}

					/*$data .= "Amenity Id to be deleted: ";
					for($j = 0;$j<count($i_aid);$j++){
						$data .= $i_aid[$j] . " ,";
					}*/
				
				}

				$sql = "DELETE FROM `function_reservation` WHERE `i_fr_id`=$i_fr_id";
				if($this->conn->query($sql)){
					for($j = 0; $j<count($i_aid);$j++){
						$sql = "DELETE FROM `ameneties` WHERE `i_aid` =" . $i_aid[$j];
						if($this->conn->query($sql)){

						}
						else{

						}
					}
				}
				else{
					return "Error: " . $sql . "<br>" . $this->conn->error;
				}

				return "Successfully deleted";

			}catch(exception $e){
				return $e;
			}
		}

		public function getCheckoutBill_view($i_fr_id,$hours){
			try{

				$sql = "SELECT `bill`.`i_bid`,`bill`.`i_fr_id`,`bill`.`i_pid`,`part`.`enum_category`,`part`.`str_description`,`part`.`enum_aircon`,`part`.`f_first_hour`,`part`.`f_succeeding_hour`
					FROM `billing` `bill`

					INNER JOIN `particulars` `part`
					ON `bill`.`i_pid`=`part`.`i_pid`
					WHERE `bill`.`i_fr_id`=$i_fr_id";
				$data = NULL;
				
				$category = NULL;
				$description = NULL;
				$aircon = NULL;
				$first_hour = 0;
				$succeeding_hour = 0;
				$total_amount = 0;
				$i_bid = NULL;

				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						$first_hour = $row["f_first_hour"];
						$succeeding_hour = $row["f_succeeding_hour"];
						$category = $row["enum_category"];
						$description = $row["str_description"];
						$aircon = $row["enum_aircon"];
						$i_bid = $row["i_bid"];
					}

					//Calculate total amount

					if($hours == 0){
						$total_amount+=$first_hour;
					}
					else{
						for($i = 0; $i<$hours;$i++){
							if($i==0){
								$total_amount+=$first_hour;
							}
							else{
								$total_amount+=$succeeding_hour;
							}
						}
					}

					
					$data = "<tr><td>$category - $description - $aircon</td>";
					$data .= "<td><center>" . number_format($total_amount,2) . "</center></td>";
					$data .= "<td colspan='2'><center><button id='viewBill-viewParticular' class='btn btn-primary' data-id='$i_bid' data-category='particular'><i class='fa fa-search'></i> View</button></center></td></tr>";
				}


				//Get all ameneity data depending on i_fr_id
				$sql = "SELECT `fr`.`i_fr_id`, `fr`.`str_requisitioner`,`bam`.`i_baid`,`bam`.`i_fr_id`,`bam`.`i_aid`,`am`.`i_aid`,`am`.`str_description`,`am`.`f_rate`
					FROM `bill_ameneties` `bam`
					INNER JOIN `ameneties` `am` 
					ON `bam`.`i_aid`=`am`.`i_aid`
					INNER JOIN `function_reservation` `fr`
					ON `bam`.`i_fr_id`=`fr`.`i_fr_id`
					WHERE `bam`.`i_fr_id`=$i_fr_id";

				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {

						$total_amount += $row["f_rate"];
						$data .= "<tr><td>" . $row["str_description"] . "</td>";
						$data .= "<td><center>" . number_format($row["f_rate"],2) . "</center></td>";
						$data .= "<td><center><button id='viewBill-viewAmenity' class='btn btn-primary' data-category='amenity' data-id='" . $row["i_baid"] . "'><i class='fa fa-search'></i> View</button></center></td>";
						$data .= "<td><center><button id='viewBill-deleteAmenity' class='btn btn-danger' data-category='amenity' data-id='" . $row["i_baid"] . "'><i class='fa fa-times'></i> Delete</button></center></td></tr>";
					}
				}

				return array("data"=>$data,"totalAmount"=>number_format($total_amount,2));
				//return $data;


				//return $total_amount;

			}catch(exception $e){
				return $e;
			}
		}

	}
?>