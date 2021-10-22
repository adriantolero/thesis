<?php
	//header("Content-type: text/html; charset=iso-8859-1");

	class Reports{

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

		public function logout(){
			session_destroy();
			$message = "User Logout";
			return $message;

			$this->conn->close();
		}

		public function getReview($search){

			try{

				$search = mysqli_real_escape_string($this->conn,utf8_decode($search));

				$sql = "SELECT `i_rid`,`str_description`,`dt_start` FROM `review_schedule` WHERE `str_description` LIKE '$search%' ORDER BY `dt_start` DESC";
				$data = "";
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						$data .= "<option value='" . $row["i_rid"] . "'>" . utf8_encode($row["str_description"]) . " (" . date("Y",strtotime($row["dt_start"])) . ")" . "</option>";
					}
				}
				else{
					$data = "<option value=''>Empty result</option>";
				}
				return $data;
				$this->conn->close();
			}catch(exception $e){
				return $e;
			}

		}

		/*
		public function getReview($search){

			try{

				$search = mysqli_real_escape_string($this->conn,utf8_decode($search));

				$sql = "SELECT `i_rid`,`str_description`,`dt_start` FROM `review_schedule` WHERE `str_description` LIKE '$search%'";
				$data = "";
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						$data .= "<tr><td>" . utf8_encode($row["str_description"]) . "</td><td>" . date("Y",strtotime($row["dt_start"])) . "</td><td><button class='btn btn-primary' id='review-btn' data-id='" . $row["i_rid"] . "''>Open</button></td></tr>";
					}
				}
				else{
					$data = "<option value=''>Empty result</option>";
				}
				return $data;
				$this->conn->close();
			}catch(exception $e){
				return $e;
			}

		}

		public function getReviewInfo($i_rid){

			try{

				

			}catch(exception $e){
				return $e;
			}

		}
		*/
		public function getReports($i_rid/*,$displayBy,$displayMonth*/){
			try{

				$review_desc = "";
				$review_fee_vsu = NULL;
				$review_fee_non_vsu = NULL;
				$review_year = NULL;

				$sql = "SELECT `str_description`,`dt_start`,`dt_end`,`f_reviewfee_vsu`,`f_reviewfee_non_vsu`  FROM `review_schedule` WHERE `i_rid`=$i_rid";

				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						$review_desc = utf8_encode($row["str_description"]);
						$review_fee_vsu = $row["f_reviewfee_vsu"];
						$review_fee_non_vsu = $row["f_reviewfee_non_vsu"];
						//$review_year = date("Y",strtotime($row["dt_start"]));
						$review_year = "(" . date("F d, Y",strtotime($row["dt_start"])) . " - " . date("F d, Y",strtotime($row["dt_end"])) . ")";
					}
				}

				//ORIGINAL
				/*$sql = "SELECT `rev`.`ch_sname`,`rev`.`ch_fname`,`rev`.`ch_mi`,`sch`.`str_school_name`,`crs`.`course`,`mj`.`str_major`,`rs`.`str_description`,IF(`sch`.`i_school_type`=1,`rs`.`f_reviewfee_vsu`,`rs`.`f_reviewfee_non_vsu`) AS `review_fee`,`pay`.`i_pay_id`,`pay`.`i_or_num`,MONTHNAME(`pay`.`d_datepaid`),`pay`.`d_datepaid`,`pay`.`f_amount_paid`,IF(`sch`.`i_school_type`=1,`rs`.`f_reviewfee_vsu` - (SELECT SUM(`f_amount_paid`) AS `sum_payment`  FROM `payment` WHERE `i_pay_id`<=`pay`.`i_pay_id` AND `i_rev_id`=`pay`.`i_rev_id`),`rs`.`f_reviewfee_non_vsu` - (SELECT SUM(`f_amount_paid`) AS `sum_payment`  FROM `payment` WHERE `i_pay_id`<=`pay`.`i_pay_id` AND `i_rev_id`=`pay`.`i_rev_id`)) AS `balance`

					FROM `payment` `pay`
					LEFT JOIN `reservation` `res`
					ON `pay`.`i_rev_id`=`res`.`i_rev_id`

					LEFT JOIN `review_schedule` `rs`
					ON `rs`.`i_rid`=`res`.`i_rid`

					LEFT JOIN `reviewer` `rev` 
					ON `res`.`i_rev_id`=`rev`.`i_rev_id`

					LEFT JOIN `school` `sch` 
					ON `rev`.`i_sid`=`sch`.`i_sid`

					LEFT JOIN `major` `mj`
					ON `rev`.`i_mid`=`mj`.`i_mid`

					LEFT JOIN `course` `crs`
					ON `mj`.`i_course_id`=`crs`.`i_course_id`

					WHERE `res`.`i_rid`=$i_rid
					ORDER BY `pay`.`d_datepaid` DESC";
				*/
				/*
				if($displayBy == 1){
					$sql = "SELECT `rev`.`ch_sname`,`rev`.`ch_fname`,`rev`.`ch_mi`,`sch`.`str_school_name`,`crs`.`course`,`mj`.`str_major`,`rs`.`str_description`,IF(`sch`.`i_school_type`=1,`rs`.`f_reviewfee_vsu`,`rs`.`f_reviewfee_non_vsu`) AS `review_fee`,`pay`.`i_pay_id`,`pay`.`i_or_num`,MONTHNAME(`pay`.`d_datepaid`),`pay`.`d_datepaid`,`pay`.`f_amount_paid`,IF(`sch`.`i_school_type`=1,`rs`.`f_reviewfee_vsu` - (SELECT SUM(`f_amount_paid`) AS `sum_payment`  FROM `payment` WHERE `i_pay_id`<=`pay`.`i_pay_id` AND `i_rev_id`=`pay`.`i_rev_id`),`rs`.`f_reviewfee_non_vsu` - (SELECT SUM(`f_amount_paid`) AS `sum_payment`  FROM `payment` WHERE `i_pay_id`<=`pay`.`i_pay_id` AND `i_rev_id`=`pay`.`i_rev_id`)) AS `balance`

					FROM `payment` `pay`
					LEFT JOIN `reservation` `res`
					ON `pay`.`i_rev_id`=`res`.`i_rev_id`

					LEFT JOIN `review_schedule` `rs`
					ON `rs`.`i_rid`=`res`.`i_rid`

					LEFT JOIN `reviewer` `rev` 
					ON `res`.`i_rev_id`=`rev`.`i_rev_id`

					LEFT JOIN `school` `sch` 
					ON `rev`.`i_sid`=`sch`.`i_sid`

					LEFT JOIN `major` `mj`
					ON `rev`.`i_mid`=`mj`.`i_mid`

					LEFT JOIN `course` `crs`
					ON `mj`.`i_course_id`=`crs`.`i_course_id`

					WHERE `res`.`i_rid`=$i_rid
					ORDER BY `pay`.`d_datepaid` DESC";
				}*/
				/*else{
					$sql = "SELECT `rev`.`ch_sname`,`rev`.`ch_fname`,`rev`.`ch_mi`,`sch`.`str_school_name`,`crs`.`course`,`mj`.`str_major`,`rs`.`str_description`,IF(`sch`.`i_school_type`=1,`rs`.`f_reviewfee_vsu`,`rs`.`f_reviewfee_non_vsu`) AS `review_fee`,`pay`.`i_pay_id`,`pay`.`i_or_num`,MONTHNAME(`pay`.`d_datepaid`),`pay`.`d_datepaid`,`pay`.`f_amount_paid`,IF(`sch`.`i_school_type`=1,`rs`.`f_reviewfee_vsu` - (SELECT SUM(`f_amount_paid`) AS `sum_payment`  FROM `payment` WHERE `i_pay_id`<=`pay`.`i_pay_id` AND `i_rev_id`=`pay`.`i_rev_id`),`rs`.`f_reviewfee_non_vsu` - (SELECT SUM(`f_amount_paid`) AS `sum_payment`  FROM `payment` WHERE `i_pay_id`<=`pay`.`i_pay_id` AND `i_rev_id`=`pay`.`i_rev_id`)) AS `balance`

					FROM `payment` `pay`
					LEFT JOIN `reservation` `res`
					ON `pay`.`i_rev_id`=`res`.`i_rev_id`

					LEFT JOIN `review_schedule` `rs`
					ON `rs`.`i_rid`=`res`.`i_rid`

					LEFT JOIN `reviewer` `rev` 
					ON `res`.`i_rev_id`=`rev`.`i_rev_id`

					LEFT JOIN `school` `sch` 
					ON `rev`.`i_sid`=`sch`.`i_sid`

					LEFT JOIN `major` `mj`
					ON `rev`.`i_mid`=`mj`.`i_mid`

					LEFT JOIN `course` `crs`
					ON `mj`.`i_course_id`=`crs`.`i_course_id`

					WHERE `res`.`i_rid`=4 AND MONTH(`pay`.`d_datepaid`)=$displayMonth
					ORDER BY `pay`.`d_datepaid` DESC";
					
				}*/
				$sql = "SELECT `rev`.`ch_sname`,`rev`.`ch_fname`,`rev`.`ch_mi`,`mjr`.`str_major`,`crs`.`course`
				,`sch`.`str_school_name`,`sch`.`i_school_type`,

				`rs`.`f_reviewfee_vsu`,`rs`.`f_reviewfee_non_vsu`,
				`pay`.`i_pay_id`,`pay`.`i_rid`,`pay`.`i_or_num`,`pay`.`f_amount_paid`,`pay`.`d_datepaid`,
				IF(`sch`.`i_school_type`=1,`rs`.`f_reviewfee_vsu`,`f_reviewfee_non_vsu`) AS `review_fee`,
				IF(`sch`.`i_school_type`=1,`rs`.`f_reviewfee_vsu`-(SELECT SUM(`f_amount_paid`) FROM `payment` WHERE `d_datepaid`<=`pay`.`d_datepaid` AND `i_rev_id`=`pay`.`i_rev_id`),`f_reviewfee_non_vsu`-(SELECT SUM(`f_amount_paid`) FROM `payment` WHERE `d_datepaid`<=`pay`.`d_datepaid` AND `i_rev_id`=`pay`.`i_rev_id`)) AS `balance`

				FROM `payment` `pay`

				LEFT JOIN `reservation` `res`
				ON `pay`.`i_rev_id`=`res`.`i_rev_id`

				LEFT JOIN `review_schedule` `rs`
				ON `res`.`i_rid`=`rs`.`i_rid`

				LEFT JOIN `reviewer` `rev`
				ON `res`.`i_rev_id`=`rev`.`i_rev_id`

				LEFT JOIN `major` `mjr`
				ON `mjr`.`i_mid`=`rev`.`i_mid`

				LEFT JOIN `course` `crs`
				ON `mjr`.`i_course_id`=`crs`.`i_course_id`

				LEFT join `school` `sch`
				ON `rev`.`i_sid`=`sch`.`i_sid`
				WHERE `rs`.`i_rid`=$i_rid ORDER BY `pay`.`d_datepaid` DESC";
				$data = "";
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					$balance = NULL;
					while ($row = $result->fetch_assoc()) {
						if($row["balance"]==0){
							$balance = "Fully paid";
						}
						else{
							$balance = $row["balance"];
						}
						$data .= "<tr><td>" . utf8_encode($row["ch_sname"]) . ", " . utf8_encode($row["ch_fname"]) . " " . utf8_encode($row["ch_mi"]) . "</td><td>". utf8_encode($row["str_school_name"]) . "</td><td>" . utf8_encode($row["course"]) . "</td><td>" . utf8_encode($row["str_major"]) . "</td><td>" . $row["review_fee"] .  "</td><td>" . $row["f_amount_paid"] . "</td><td>" . $row["i_or_num"] . "</td><td>" . $row["d_datepaid"] . "</td><td>" . $balance . "</td></tr>";
					}
				}
				else{
					$data = "<tr class='bg-danger text-white'><td colspan='9'><center><h3>Empty Record</h3></center></td></tr>";
				}

				
				return array("data"=>$data,"review_title"=>$review_desc,"year"=>$review_year);
				
				/*return array("review_desc"=>$review_desc,"review_fee_vsu"=>$review_fee_vsu,"review_fee_non_vsu"=>$review_fee_non_vsu,"data"=>$data);
				$this->conn->close();*/

			}catch(exception $e){
				return $e;
			}
			
		}
	}

?>