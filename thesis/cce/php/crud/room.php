<?php

	class CRUD{

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

		public function getFunctionSched($date_start,$time_start,$date_end,$time_end){

			////$sql = "SELECT FROM"

		}

		public function getAvailableRoom($dt_arrival,$dt_departure){

			try{

				$dt_arrival = mysqli_real_escape_string($this->conn,utf8_decode($dt_arrival));
				$dt_departure = mysqli_real_escape_string($this->conn,utf8_decode($dt_departure));

				$sql = "SELECT `room`.`i_rm_id`,`room`.`str_rmName`,`room`.`i_capacity` FROM `room` WHERE `room`.`i_rm_id` NOT IN (SELECT `i_rm_id` FROM `function_reservation` WHERE ('$dt_arrival' < `dt_departure`) AND ('$dt_departure' > `dt_arrival`) AND `i_fr_status`=1) AND `room`.`i_rm_id` NOT IN (SELECT `room`.`i_rm_id` FROM `room` WHERE `room`.`i_rm_id` IN(SELECT i_rm_id FROM `review_schedule` WHERE ('$dt_arrival' < dt_end) AND ('$dt_departure' > dt_start) AND `i_status`=1))";
				/*$sql = "SELECT `room`.`i_rm_id`,`room`.`str_rmName` FROM `room`
					WHERE `room`.`i_rm_id` NOT IN (SELECT `i_rm_id` FROM `function_reservation` WHERE ('$date_start' < TIMESTAMP(`d_end`,`t_end`)) AND ('$date_end' > TIMESTAMP(`d_start`,`t_start`)) AND `i_fr_status`=1)";
					*/
				$data = NULL;
				$result = $this->conn->query($sql);
				if($result->num_rows > 0 ){
					while ($row = $result ->fetch_assoc()) {
						$data .= "<option value='" . $row["i_rm_id"] . "'>" . utf8_encode($row["str_rmName"]) . " (Max capacity " . $row["i_capacity"] . ")" . "</option>";
					}
				}
				else{
					return 1;
				}
				/*else{
					$data = "<option value='0'>No available room</option>";
				}*/
				return $data;
			}catch(exception $e){
				return $e;
			}
			
			//return $this->getFunctionSched($date_start,$time_start,$date_end,$time_end);
		}

		public function previewForm($agency,$agency_add,$room,$title,$participants,$date_start,$time_start,$date_end,$time_end,$nature,$reservedBy,$reserved_add,$contact,$email){

			try{

				$room_name = NULL;
				$dt_start = date("Y-m-d h:ia",strtotime($date_start . $time_start));
				$dt_end = date("Y-m-d h:ia",strtotime($date_end . $time_end));
				$sql = "SELECT `str_rmName` FROM `room` WHERE `i_rm_id`=$room";
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						$room_name = utf8_encode($row["str_rmName"]);
					}
				}
				$this->conn->close();
				$data = "<tr><td id='firstCol' style='text-align: right;'>Arrival Date</td><td id='secondCol' style='text-align: left;'>$dt_start</td></tr>";
				$data .= "<tr><td style='text-align: right;'>Departure Date</td><td style='text-align: left;'>$dt_end</td></tr>";
				$data .= "<tr><td style='text-align: right;'>Room</td><td style='text-align: left;'>$room_name</td></tr>";
				$data .= "<tr><td style='text-align: right;'>Agency/Organization</td><td style='text-align: left;'>$agency</td></tr>";
				$data .= "<tr><td style='text-align: right;'>Agency Address</td><td style='text-align: left;'>$agency_add</td></tr>";
				$data .= "<tr><td style='text-align: right;'>Title of activity</td><td style='text-align: left;'>$title</td></tr>";
				$data .= "<tr><td style='text-align: right;'>No. of participants</td><td style='text-align: left;'>$participants</td></tr>";
				$data .= "<tr><td style='text-align: right;'>Nature of activity</td><td style='text-align: left;'>$nature</td></tr>";
				$data .= "<tr><td style='text-align: right;'>Reserved by</td><td style='text-align: left;'>$reservedBy</td></tr>";
				$data .= "<tr><td style='text-align: right;'>Address</td><td style='text-align: left;'>$reserved_add</td></tr>";
				$data .= "<tr><td style='text-align: right;'>Mobile no.</td><td style='text-align: left;'>$contact</td></tr>";
				$data .= "<tr><td style='text-align: right;'>Email</td><td style='text-align: left;'>$email</td></tr>";

				return $data;
			}catch(exception $e){
				return $e;
			}

		}

		public function createRequest($agency,$agency_add,$room,$title,$participants,$dt_arrival,$dt_departure,$nature,$reservedBy,$reserved_add,$contact,$email){

			try{
				$agency = mysqli_real_escape_string($this->conn,utf8_decode($agency));
				$agency_add = mysqli_real_escape_string($this->conn,utf8_decode($agency_add));
				$title = mysqli_real_escape_string($this->conn,utf8_decode($title));
				$dt_arrival = mysqli_real_escape_string($this->conn,utf8_decode($dt_arrival));
				$dt_departure = mysqli_real_escape_string($this->conn,utf8_decode($dt_departure));
				$nature = mysqli_real_escape_string($this->conn,utf8_decode($nature));
				$reservedBy = mysqli_real_escape_string($this->conn,utf8_decode($reservedBy));
				$reserved_add = mysqli_real_escape_string($this->conn,utf8_decode($reserved_add));
				$email = mysqli_real_escape_string($this->conn,utf8_decode($email));

				date_default_timezone_set('Asia/Manila');
				$today = date("Y-m-d H:i:s",strtotime("now"));
				$sql = "INSERT INTO `function_reservation`(`i_rm_id`,`str_agency`,`str_agency_add`,`dt_arrival`,`dt_departure`,`str_nature`,`str_title`,`i_no_participants`,`str_requisitioner`,`str_address`,`str_mobile_no`,`str_email`,`dt_requested`,`i_fr_status`) VALUES($room,'$agency','$agency_add','$dt_arrival','$dt_departure','$nature','$title',$participants,'$reservedBy','$reserved_add','$contact','$email','$today',0)";
				if($this->conn->query($sql)){
					return "Your form has been submitted";
				}
				else{
					return "Error: " . $sql . "<br>" . $this->conn->error;
				}
				$this->conn->close();
				
			}catch(exception $e){
				return $e;
			}

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

		public function checkCapacity($room,$participants){

			try{

				$sql = "SELECT * FROM `room` WHERE `i_rm_id`=$room";
				$result = $this->conn->query($sql);

				$capacity = 0;

				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						$capacity = $row["i_capacity"];
					}
					if($participants > $capacity){
						return 1;
					}
					else{
						return 0;
					}
				}

			}catch(exception $e){
				return $e;
			}

		}

	}

?>