<?php
	//header("Content-type: text/html; charset=iso-8859-1");

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

		public function getReviewSchedule($search){

			try{

				$search = mysqli_real_escape_string($this->conn,utf8_decode($search));

				$sql = "SELECT `i_rid`,`str_description`,`dt_start` FROM `review_schedule` WHERE `str_description` LIKE '$search%' ORDER BY `dt_start` DESC";
				$data = "";
				$result = $this->conn->query($sql);

				if($result->num_rows > 0){
					while($row = $result->fetch_assoc()){
						$data .= "<tr><td>" . utf8_encode($row["str_description"]) . "</td><td>" . date("Y",strtotime($row["dt_start"])) . "</td><td>" . "<button class='btn btn-primary' type='button' id='selectReview-btn' data-id=" . "'" . $row["i_rid"] . "'" .  ">Select</button></td></tr>";
					}
				}
				else{
					$data = "<tr class='bg-danger text-white'><td colspan='3'>Empty Result</td></tr>";
				}

				return $data;

			}catch(exception $e){
				return $e;
			}
		}

		public function getReviewer($i_rid,$search){

			try{

				$search = mysqli_real_escape_string($this->conn,utf8_decode($search));

				$sql = "SELECT `reviewer`.`i_rev_id`,`reviewer`.`ch_sname`,`reviewer`.`ch_fname`,`reviewer`.`ch_mi` FROM `reviewer` INNER JOIN `reservation` ON `reviewer`.`i_rev_id`=`reservation`.`i_rev_id` WHERE `ch_sname` LIKE '$search%' AND `reservation`.`i_rid`= $i_rid AND (`reservation`.`status`=1 OR `reservation`.`status`=2) ORDER BY `ch_sname` ASC";
				$data = "";
				$result = $this->conn->query($sql);

				if($result->num_rows > 0){
					while($row = $result->fetch_assoc()){
						$data .= "<option value=" . "'" . $row["i_rev_id"] . "'>". utf8_encode($row["ch_sname"]) . ", " . utf8_encode($row["ch_fname"]) . " " . utf8_encode($row["ch_mi"]) . "</option>";
					}
				}

				else{
					$data ="<option value=''>Empty Result</option>";
				}

				return $data;

			}catch(exception $e){
				return $e;
			}

		}

		public function getInfo($i_rev_id){
			try{

				$sql = "SELECT `rs`.`str_description`,`rs`.`f_reviewfee_vsu`,`rs`.`f_reviewfee_non_vsu`,`rev`.`ch_sname`,`rev`.`ch_fname`,`rev`.`ch_mi`,`rev`.`i_sid`,`sch`.`str_school_name`,`sch`.`i_school_type`
					FROM reservation res 
					INNER JOIN reviewer rev 
					ON `res`.`i_rev_id`=`rev`.`i_rev_id`
					INNER JOIN `review_schedule` `rs`
					ON `rs`.`i_rid`=`res`.`i_rid`
					LEFT JOIN `school` `sch`
					ON `rev`.`i_sid`=`sch`.`i_sid`
					WHERE `res`.`i_rev_id`=$i_rev_id";
				$data = NULL;

				$result = $this->conn->query($sql);
				if($result->num_rows > 0 ){
					$fname = "";
					$sname = "";
					$mi = "";
					$review_title = "";
					$review_fee = 0;
					/*$total = 0;
					$balance = 0;*/
					//$school_type = 1;
					while($row = $result->fetch_assoc()){
						$fname = utf8_encode($row["ch_fname"]);
						$sname =  utf8_encode($row["ch_sname"]);
						$mi = utf8_encode($row["ch_mi"]);
						$review_title = utf8_encode($row["str_description"]);
						$school_name = utf8_encode($row["str_school_name"]);

						if($row["i_sid"]==NULL){
							$review_fee = NULL;
						}

						else{
							if($row["i_school_type"]==1){
								$review_fee = $row["f_reviewfee_vsu"];
							}
							else if($row["i_school_type"]==NULL){
								$review_fee = "";
							}
							else{
								$review_fee = $row["f_reviewfee_non_vsu"];
							}
						}
						
						
						
					}

					$name = $fname . " " . $sname;

					$str_review_fee = NULL;

					if($review_fee != NULL){
						$str_review_fee = number_format($review_fee,2);
					}
					
					return $array = array("name"=>$name,"school_name"=>$school_name,"review_title"=>$review_title,"review_fee"=>$str_review_fee,"review_fee_hidden"=>$review_fee/*,"data"=>$data,"total"=>$total,"balance"=>$balance*/);
				}

			}catch(exception $e){
				return $e;
			}
		}

		public function getBills($i_rev_id,$fee){
			try{

				if($fee==NULL || $fee ==0){
					$fee = 0;
				}

				$sql = "SELECT * FROM `payment` WHERE `i_rev_id`=$i_rev_id ORDER BY `d_datepaid` DESC";
				$result = $this->conn->query($sql);
				$data = NULL;
				$total = 0;
				$balance = 0;
				if($result->num_rows > 0){
					while($row = $result->fetch_assoc()){
						$data .= "<tr><td>" . utf8_encode($row["str_payment_description"]) .  "</td><td>" . $row["i_or_num"] .  "</td><td>" . date("F d, Y",strtotime($row["d_datepaid"])) . "</td><td>" . number_format($row["f_amount_paid"],2) . "</td><td><button type='button' id='editBill-btn' class='btn btn-primary' data-toggle='modal' data-target='#edit-bill-modal' data-id='" . $row['i_pay_id'] . "'><i class='fa fa-edit'></i> Edit</button></td><td><button type='button' id='deleteBill-btn' class='btn btn-primary' data-id='" . $row['i_pay_id'] . "' ><i class='fa fa-times'></i> Delete</button></td></tr>";
						//$total+=$row["f_amount_paid"];
						$total+=$row["f_amount_paid"];
					}
					$balance = $fee - $total;
				}
				else{
					$balance = $fee;
					$data = "<tr class='bg-danger text-white'><td colspan='6'><h3>NO RECORD</h3></td></tr>";
				}
				return array("data"=>$data,"total"=>number_format($total,2),"balance"=>number_format($balance,2));
			}catch(exception $e){
				return $e;
			}
		}

		public function getSchoolFee($i_rev_id,$school_id){

			try{

				$sql = "UPDATE `reviewer` SET `i_sid`=$school_id WHERE `i_rev_id`=$i_rev_id";
				//$sql = "SELECT FROM `review_schedule`";
				if($this->conn->query($sql)){
					//return "School has been updated";
					$sql = "SELECT `rs`.`f_reviewfee_vsu`,`rs`.`f_reviewfee_non_vsu`,`sch`.`i_school_type`
					FROM reservation res 
					INNER JOIN reviewer rev 
					ON `res`.`i_rev_id`=`rev`.`i_rev_id`
					INNER JOIN `review_schedule` `rs`
					ON `rs`.`i_rid`=`res`.`i_rid`
					LEFT JOIN `school` `sch`
					ON `rev`.`i_sid`=`sch`.`i_sid`
					WHERE `res`.`i_rev_id`=$i_rev_id";	
					$result = $this->conn->query($sql);
					$fee = NULL;
					if($result->num_rows > 0){
						while ($row = $result->fetch_assoc()) {
							if($row["i_school_type"]==1){
								$fee = $row["f_reviewfee_vsu"];
							}
							else{
								$fee = $row["f_reviewfee_non_vsu"];
							}
						}
						return $fee;
					}
				}

				else{
				    return "Error updating school: " . $this->conn->error;
				}

			}catch(exception $e){
				return $e;
			}

		}

		/*
		public function createSchool($school,$address,$school_type){

			try{

				$sql = "INSERT INTO `school`(`str_school_name`,`str_school_address`,`i_school_type`) VALUES('$school','$address',$school_type)";
				if($this->conn->query($sql)){
					return "New school created";
				}
				else{
					return "Error inserting school: " . $this->conn->error() ;
				}

			}catch(exception $e){
				return $e;
			}

		}*/

		public function createBill($i_rid,$i_rev_id,$description,$or_num,$amount_paid,$date_paid){

			//return $i_rid . $i_rev_id . $or_num . $amount_paid . $date_paid;
			try{

				$description = mysqli_real_escape_string($this->conn,utf8_decode($description));
				$amount_paid = sprintf("%.2f",$amount_paid);

				$sql = "INSERT INTO `payment`(`i_rid`,`i_rev_id`,`str_payment_description`,`i_or_num`,`f_amount_paid`,`d_datepaid`) VALUES($i_rid,$i_rev_id,'$description',$or_num,$amount_paid,'$date_paid')";

				if($this->conn->query($sql)){
					return "Successfully created.";
				}
				else{
					return "Error: " . $sql . "<br>" . $this->conn->error;
				}

			}catch(exception $e){
				return $e;
			}

		}

		public function deleteBill($bill_id){

			try{

				$sql = "DELETE FROM `payment` WHERE `i_pay_id`=$bill_id";

				if($this->conn->query($sql) === TRUE){
				    return "Record deleted successfully.";
				} 
				else{
				    return "Error deleting record: " . $this->conn->error;
				}
				//return $bill_id;

			}catch(exception $e){
				return $e;
			}

		}

		public function getBill($bill_id){

			try{

				$sql = "SELECT * FROM `payment` WHERE `i_pay_id`=$bill_id";
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						return array("description"=>utf8_encode($row["str_payment_description"]),"or_num"=>$row["i_or_num"],"amount_paid"=>$row["f_amount_paid"],"date_paid"=>$row["d_datepaid"],"pay_id"=>$row["i_pay_id"]);
					}
				}

			}catch(exception $e){
				return $e;
			}

		}

		public function updateBill($bill_id,$description,$or_num,$amount_paid,$date_paid){

			try{

				$description = mysqli_real_escape_string($this->conn,utf8_decode($description));
				$amount_paid = sprintf("%.2f",$amount_paid);
				$sql = "UPDATE `payment` SET `str_payment_description`='$description',`i_or_num`=$or_num,`f_amount_paid`=$amount_paid,`d_datepaid`='$date_paid' WHERE `i_pay_id`=$bill_id";

				if($this->conn->query($sql)){
					 return "Successfully updated.";
				} 
				else{
				    return "Error updating record: " . $this->conn->error;
				}
			}catch(exception $e){
				return $e;
			}

		}
	}
?>