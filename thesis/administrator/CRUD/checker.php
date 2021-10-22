<?php 

	class Checker{
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

		public function check_ReviewSchedule($room_id,$date_start,$date_end){

			try{	
				
				$sql = "SELECT * FROM review_schedule WHERE ('$date_start' < dt_end) AND ('$date_end' > dt_start) AND `i_rm_id`=$room_id AND `i_status`=1";
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					return true;
				}
				else{
					return false;
				}
			}catch(exception $e){
				return $e;
			}
			//return false;
		}

		public function check_VenueSchedule($room_id,$dt_start,$dt_end){

			try{
				$sql = "SELECT * FROM `function_reservation` WHERE ('$dt_start' < `dt_departure`) AND ('$dt_end' > `dt_arrival`) AND `i_rm_id`=$room_id AND `i_fr_status`=1";
				//$sql = "SELECT * FROM `function_reservation` WHERE ('$dt_start' < TIMESTAMP(`d_end`,`t_end`)) AND ('$dt_end' > TIMESTAMP(`d_start`,`t_start`)) AND `i_rm_id`=$room_id AND `i_fr_status`=1";
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					return true;
				}
				else{
					return false;
				}
				$this->conn->close();

			}catch(exception $e){
				return $e;
			}

		}

		public function checkReviewSched_update($i_rid,$room,$date_start,$date_end){
			try{	
				
				$sql = "SELECT * FROM review_schedule WHERE ('$date_start' < dt_end) AND ('$date_end' > dt_start) AND `i_rid`<> $i_rid AND `i_rm_id`=$room AND `i_status`=1";
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					return true;
				}
				else{
					return false;
				}
			}catch(exception $e){
				return $e;
			}
		}

		public function checkFunctionSched_update($room,$date_start,$date_end){

			try{

				$sql = "SELECT * FROM `function_reservation` WHERE ('$date_start' < `dt_departure`) AND ('$date_end' > `dt_arrival`) AND `i_rm_id`=$room AND `i_fr_status`=1";
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					return true;
				}
				else{
					return false;
				}
				$this->conn->close();

			}catch(exception $e){
				return $e;
			}

		}

		public function checkReviewerSlot($review_id){
			/*$sql = "SELECT `rs`.`i_rid`,`rs`.`str_description`,`rs`.`i_reviewers` - COUNT(`res`.`i_rev_id`) AS `num_stud`
					FROM `review_schedule` `rs`
					INNER JOIN `reservation` `res`
					ON `rs`.`i_rid`=`res`.`i_rid`
					WHERE `rs`.`i_rid`=$rid
					GROUP BY `rs`.`str_description`";*/
			$sql = "SELECT `rs`.`i_rid`,`rs`.`str_description`,`rs`.`i_reviewers`,`rs`.`i_reviewers` - (SELECT COUNT(*) FROM `reservation` WHERE  `reservation`.`i_rid`=$review_id AND (`reservation`.`status`=1 OR `reservation`.`status`=2)) AS `num_stud`
					FROM `review_schedule` `rs`
					WHERE `rs`.`i_rid`=$review_id
					GROUP BY `rs`.`str_description`";
			$title = "";
			$num_stud = 0;
			$result = $this->conn->query($sql);
			if($result->num_rows > 0){
				while ($row = $result->fetch_assoc()) {
					//$title = $row["str_description"];
					//$num_stud = $row["num_stud"];
					if($row["num_stud"]==0){
						return 1;
					}
					else{
						return 0;
					}
				}
			}
		}

		public function checkBill($i_rid,$i_rev_id,$amount_paid){

			try{
				$sql = "SELECT `rs`.`str_description`,`rs`.`f_reviewfee_vsu`,`rs`.`f_reviewfee_non_vsu`,`rev`.`ch_sname`,`rev`.`ch_fname`,`rev`.`ch_mi`,`sch`.`i_school_type`
						FROM reservation res 
						INNER JOIN reviewer rev 
						ON `res`.`i_rev_id`=`rev`.`i_rev_id`
						INNER JOIN `review_schedule` `rs`
						ON `rs`.`i_rid`=`res`.`i_rid`
						INNER JOIN `school` `sch`
						ON `rev`.`i_sid`=`sch`.`i_sid`
						WHERE `res`.`i_rev_id`=$i_rev_id";
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					$review_fee = 0;
					while ($row = $result->fetch_assoc()) {
						if($row["i_school_type"]!=0){
							$review_fee = $row["f_reviewfee_vsu"];
						}
						else{
							$review_fee = $row["f_reviewfee_non_vsu"];
						}
					}
					$sql = "SELECT SUM(`f_amount_paid`) AS total
							FROM payment 
							WHERE i_rev_id=$i_rev_id AND i_rid=$i_rid";
					$total = 0;
					$result = $this->conn->query($sql);
					if($result->num_rows > 0){
						while ($row = $result->fetch_assoc()) {
							$total = $row["total"];
						}
						//return $total;
					}
					$balance = $review_fee-$total;
					if($balance==0){
						return 1;
					}
					else if($review_fee < $total+$amount_paid){
						return 2;
					}
					else{
						return 0;
					}
				}
			}catch(exception $e){
				return $e;
			}
		}

		public function checkBill_update($i_rid,$i_rev_id,$bill_id,$amount_paid){

			try{
				$sql = "SELECT `rs`.`str_description`,`rs`.`f_reviewfee_vsu`,`rs`.`f_reviewfee_non_vsu`,`rev`.`ch_sname`,`rev`.`ch_fname`,`rev`.`ch_mi`,`sch`.`i_school_type`
						FROM reservation res 
						INNER JOIN reviewer rev 
						ON `res`.`i_rev_id`=`rev`.`i_rev_id`
						INNER JOIN `review_schedule` `rs`
						ON `rs`.`i_rid`=`res`.`i_rid`
						INNER JOIN `school` `sch`
						ON `rev`.`i_sid`=`sch`.`i_sid`
						WHERE `res`.`i_rev_id`=$i_rev_id";
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					$review_fee = 0;
					while ($row = $result->fetch_assoc()) {
						if($row["i_school_type"]!=0){
							$review_fee = $row["f_reviewfee_vsu"];
						}
						else{
							$review_fee = $row["f_reviewfee_non_vsu"];
						}
					}
					$sql = "SELECT SUM(`f_amount_paid`) AS total
							FROM payment 
							WHERE i_rev_id=$i_rev_id AND i_rid=$i_rid AND `i_pay_id`<>$bill_id";
					$total = 0;
					$result = $this->conn->query($sql);
					if($result->num_rows > 0){
						while ($row = $result->fetch_assoc()) {
							if($row["total"]==NULL){
								$total = 0;
							}
							else{
								$total = $row["total"];
							}
							
						}
						//return $total;
					}
					$balance = $review_fee-$total;
					if($balance==0){
						return 1;
					}
					else if($review_fee < $total+$amount_paid){
						return 2;
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
/*echo "SELECT * from review_schedule WHERE ('2016-06-11 00:00:00' >= dt_start   
AND '2016-07-21 00:00:00' <= dt_end) OR ('2016-06-11 00:00:00' <= dt_start AND '2016-07-21 00:00:00' <= dt_end) AND i_rm_id=1"
*/
?>