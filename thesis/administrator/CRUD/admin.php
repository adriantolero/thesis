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

		public function getFunctionSchedule(){
			//return "HEHEHE";
			try{
				date_default_timezone_set('Asia/Manila');
				$today = date('Y-m-d H:i:s',strtotime("now"));

				$sql = "SELECT `room`.`str_rmName`,`fr`.`str_title`,`fr`.`dt_arrival`, `fr`.`dt_departure`, `fr`.`str_requisitioner`
					FROM `function_reservation` `fr`
					INNER JOIN `room`
					ON `fr`.`i_rm_id`=`room`.`i_rm_id`


					WHERE(`i_fr_status`=1 AND ('$today' < `dt_departure`) AND ('$today' > `dt_arrival`)) OR (`i_fr_status`=4 AND ('$today' < `dt_departure`) AND ('$today' > `dt_checkin`))";

				/*$sql = "SELECT `room`.`str_rmName`,`fr`.`str_title`,`fr`.`dt_arrival`, `fr`.`dt_departure`, `fr`.`str_requisitioner`
					FROM `function_reservation` `fr`
					INNER JOIN `room`
					ON `fr`.`i_rm_id`=`room`.`i_rm_id`
					WHERE `fr`.`dt_arrival`='$today'";
					*/
				$result = $this->conn->query($sql);
				$data = NULL;
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						$data .= "<tr><td>" . $row["str_rmName"] . "</td><td>" . $row["str_title"] . "</td><td>" . date("F d, Y h:ia",strtotime($row["dt_arrival"])) . "</td><td>" .  date("F d, Y h:ia",strtotime($row["dt_departure"])) . "</td><td>" . $row["str_requisitioner"] . "</td></tr>";
					}
				}
				else{
					$data = "<tr><td colspan='5'>There is no event today.</td></tr>";
				}
				return $data;

			}catch(exception $e){
				return $e;
			}

		}

		public function getReviewSchedule(){

			try{

				date_default_timezone_set('Asia/Manila');
				$today = date('Y',strtotime("now"));

				$sql = "SELECT `rm`.`str_rmName`,`rs`.`str_description`,`rs`.`dt_start`,`rs`.`dt_end`,`rs`.`str_reviewee`
					FROM `review_schedule` `rs` 
					INNER JOIN `room` `rm` 
					ON `rs`.`i_rm_id`=`rm`.`i_rm_id`
					WHERE `rs`.`dt_start` LIKE '%$today%'";
				$result = $this->conn->query($sql);
				$data = NULL;
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						$data .= "<tr><td>" . $row["str_rmName"] . "</td><td>" . $row["str_description"] . "</td><td>" . date("F d, Y h:ia",strtotime($row["dt_start"])) . "</td><td>" .  date("F d, Y h:ia",strtotime($row["dt_end"])) . "</td><td>" . $row["str_reviewee"] . "</td></tr>";
					}
				}
				else{
					$data = "<tr><td colspan='5'>There is no event today.</td></tr>";
				}
				return $data;

			}catch(exception $e){
				return $e;
			}

		}

	}
?>