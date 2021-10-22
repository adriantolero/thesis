<?php

	//session_start();
	//include_once '../config/dbConfig.php';

	//class CRUD extends DbConfig
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

		/*
		public function getschedToday(){

			$date_today = date("Y-m-d");
			$sql="SELECT `rm`.`i_rm_id`, `rm`.`str_rmName`, `rs`.`i_rid`, `rs`.`str_description`, `rs`.`dt_start`,`rs`.`dt_end`
			FROM `review_schedule` `rs`
			INNER JOIN `room` `rm`
			ON `rs`.`i_rm_id`=`rm`.`i_rm_id` WHERE `rs`.`dt_start` LIKE '%$date_today%'";

			$result = $this->conn->query($sql);
			if($result->num_rows > 0){
				while ($row = $result->fetch_assoc()) {
					echo "<tr><td>" . $row["str_rmName"] . "</td><td>" . $row["str_description"] . "</td><td>" . date("F d, Y",strtotime($row["dt_start"])) . "</td><td>" . date("g:ia",strtotime($row["dt_start"])) . "</td><td>" . date("F d, Y",strtotime($row["dt_end"])) . "</td><td>" . date("g:ia",strtotime($row["dt_end"])) . "</td></tr>";
				}
			}

		}*/

		public function getRoom(){

			$sql = "SELECT * FROM `room`";
			$result = $this->conn->query($sql);

			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()) {
					echo "<option value='" . $row["i_rm_id"] . "'>" . $row["str_rmName"] . "</option>";
				}
			}

		}

		public function getReviewSched(){
			$sql= "SELECT `rm`.`str_rmName`,`rs`.`i_rid`,`rs`.`str_description`,`rs`.`dt_start`,`rs`.`dt_end` FROM `room` `rm`
				INNER JOIN `review_schedule` `rs` 
				ON `rm`.`i_rm_id`=`rs`.`i_rm_id` ORDER BY `rs`.`dt_start` DESC";
			$output = "";

			$result = $this->conn->query($sql);
			if($result->num_rows > 0){
				while ($row= $result->fetch_assoc()) {
					
					$output .= "<tr><td><center>" . $row["str_rmName"] . "</center></td><td>" . utf8_encode($row["str_description"]) . "</td><td><center>" . date("F d, Y g:ia",strtotime($row["dt_start"])) . "</center></td><td><center>" . date("F d, Y g:ia",strtotime($row["dt_end"])) . "</center></td><td><center>" . "<button class='btn btn-primary' id='viewSched-btn' data-id='" . $row["i_rid"] . "'  data-toggle='modal' data-target='#viewReview-modal'><i class='fas fa-search'></i> View</button></center></td><td><center>" . "<button class='btn btn-danger' id='deleteSched-btn' data-id='" . $row["i_rid"] . "'><i class='fa fa-times'></i> Delete</button></center></td></tr>";
					/*
					$output .= "<tr><td><center>" . $row["str_rmName"] . "</center></td><td><center>" . $row["str_description"] . "</center></td><td><center>" . date("F d, Y",strtotime($row["dt_start"])) . "</center></td><td><center>" . date("g:ia",strtotime($row["dt_start"])) . "</center></td><td><center>" . date("F d, Y",strtotime($row["dt_end"])) . "</center></td><td><center>" . date("g:ia",strtotime($row["dt_end"])) . "</center></td><td><center>" . "<a href='#' class='btn btn-primary' id='viewSched-btn' data-id='" . $row["i_rid"] . "'  data-toggle='modal' data-target='#viewReview-modal'><i class='fas fa-cogs'></i> Manage</a></center></td><td><center>" . "<a href='#' class='btn btn-primary' id='deleteSched-btn' data-id='" . $row["i_rid"] . "'><i class='fa fa-times'></i> Delete</a></center></td></tr>";
					*/
				}
				return $output;
			}
		}

		public function searchReviewSched($search,$category){
			try{

				$search = mysqli_real_escape_string($this->conn,utf8_decode($search));
				if($category == 1){
					$sql = "SELECT `rm`.`i_rm_id`, `rm`.`str_rmName`,`rs`.`i_rid`,`rs`.`str_description`,`rs`.`dt_start`,`rs`.`dt_end` FROM `room` `rm`
					 INNER JOIN `review_schedule` `rs`
					 ON `rm`.`i_rm_id`=`rs`.`i_rm_id` WHERE `rs`.`str_description` LIKE '$search%' ORDER BY `rs`.`dt_start` DESC";
				}

				else if($category == 2){
					$sql = "SELECT `rm`.`i_rm_id`, `rm`.`str_rmName`,`rs`.`i_rid`,`rs`.`str_description`,`rs`.`dt_start`,`rs`.`dt_end` FROM `room` `rm`
					 INNER JOIN `review_schedule` `rs`
					 ON `rm`.`i_rm_id`=`rs`.`i_rm_id` WHERE `rm`.`str_rmName` LIKE '$search%' ORDER BY `rs`.`dt_start` DESC";
				}

				else{
					$sql = "SELECT `rm`.`i_rm_id`, `rm`.`str_rmName`,`rs`.`i_rid`,`rs`.`str_description`,`rs`.`dt_start`,`rs`.`dt_end` FROM `room` `rm`
					 INNER JOIN `review_schedule` `rs`
					 ON `rm`.`i_rm_id`=`rs`.`i_rm_id` WHERE `rs`.`dt_start` LIKE '%$search%' ORDER BY `rs`.`dt_start` DESC";
				}
				
				$output ="";

				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					
					while($row = $result->fetch_assoc()){
						$output .= "<tr><td><center>" . utf8_encode($row["str_rmName"]) . "</center></td><td>" . utf8_encode($row["str_description"]) . "</td><td><center>" . date("F d, Y g:ia",strtotime($row["dt_start"])) . "</center></td><td><center>" . date("F d, Y g:ia",strtotime($row["dt_end"])) . "</center></td><td><center>" . "<button class='btn btn-primary' id='viewSched-btn' data-id='" . $row["i_rid"] . "'  data-toggle='modal' data-target='#viewReview-modal'><i class='fas fa-search'></i> View</button></center></td><td><center>" . "<button class='btn btn-danger' id='deleteSched-btn' data-id='" . $row["i_rid"] . "'><i class='fa fa-times'></i> Delete</button></center></td></tr>";
					}
				}
				else{
					$output = "<tr class='bg-danger text-white'><td colspan='7'><center><h3>No review found</h3></center></td></tr>";
				}
				return $output;
			}catch(exception $e){
				return $e;
			}
		}

		public function createReview($room_id,$description,$reviewee,$date_start,$date_end,$review_fee_vsu,$review_fee_non_vsu,$reviewers/*,$status*/){

			try{

				$description = mysqli_real_escape_string($this->conn,utf8_decode($description));
				$reviewee = mysqli_real_escape_string($this->conn,utf8_decode($reviewee));
				$review_fee_vsu = sprintf("%.2f",$review_fee_vsu);
				$review_fee_non_vsu = sprintf("%.2f",$review_fee_non_vsu);

				$sql = "INSERT INTO `review_schedule` (`i_rm_id`, `str_description`, `str_reviewee`, `dt_start`, `dt_end`, `f_reviewfee_vsu`, `f_reviewfee_non_vsu`, `i_reviewers`, `i_status`) VALUES ($room_id, '$description', '$reviewee', '$date_start', '$date_end', $review_fee_vsu, $review_fee_non_vsu, $reviewers, 1)";

				if($this->conn->query($sql)){
					//return true;
				}
				else{
					"Error: " . $sql . "<br>" . $this->conn->error;
				}

				$this->conn->close();
			}catch(exception $e){
				echo $e;
			}
		}

		public function modal_getReview($rev_id){

			try{

				$sql = "SELECT * FROM `review_schedule` WHERE `i_rid`=$rev_id";
				$result = $this->conn->query($sql);

				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						$data = array("id"=>$row["i_rid"],"room_id"=>$row["i_rm_id"],"description"=>utf8_encode($row["str_description"]),"reviewee"=>utf8_encode($row["str_reviewee"]),"date_start"=>date("Y-m-d",strtotime($row["dt_start"])),"time_start"=>date("H:i",strtotime($row["dt_start"])),"date_end"=>date("Y-m-d",strtotime($row["dt_end"])),"time_end"=>date("H:i",strtotime($row["dt_end"])),"reviewFee_vsu"=>$row["f_reviewfee_vsu"],"reviewFee_non_vsu"=>$row["f_reviewfee_non_vsu"],"reviewers"=>$row["i_reviewers"],"status"=>$row["i_status"]);
						return $data;
					}
				}

			}catch(exception $e){

			}

		}

		public function deleteReview($review_id){
			try{

				$data = NULL;
				$sql =  "SELECT * FROM `reservation` WHERE `i_rid`=$review_id";
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					$i_rev_id = [];
					$i = 0;
					
					while ($row = $result->fetch_assoc()) {
						$i_rev_id[$i++] = $row["i_rev_id"];
						//$i++;
					}

					//delete all data where registered on reservation
					for ($j=0; $j < count($i_rev_id) ; $j++) { 	
						$sql = "DELETE FROM `reviewer` WHERE `i_rev_id`=" . $i_rev_id[$j] . "";
						if($this->conn->query($sql)){

						}
						else{
							return "Error: " . $sql . "<br>" . $this->conn->error;
						}
					}
					$sql = "DELETE FROM `review_schedule` WHERE `i_rid`=$review_id";
					if($this->conn->query($sql)){
						return "Successfully deleted";
					}
					else{
						return "Error: " . $sql . "<br>" . $this->conn->error;
					}
				}
				else{
					$sql = "DELETE FROM `review_schedule` WHERE `i_rid`=$review_id";
					if($this->conn->query($sql)){
						return "Successfully deleted";
					}
					else{
						return "Error: " . $sql . "<br>" . $this->conn->error;
					}
				}
				
				//return $data;
				//return count($i_rev_id);

				/*$sql = "DELETE FROM `review_schedule` WHERE `i_rid`=$review_id";
				if($this->conn->query($sql)){
					return "Review schedule deleted";
				}
				else{
					echo "Error deleting record: " . $this->conn->error;
				}*/
			}catch(exception $e){
				return $e;
			}
		}

		public function getReviewSched_info(){
			
		}

		public function updateReview($review_id,$room_id,$description,$reviewee,$date_start,$date_end,$review_fee_vsu,$review_fee_non_vsu,$reviewers/*,$status*/){
			try{

				$description = mysqli_real_escape_string($this->conn,utf8_decode($description));
				$reviewee = mysqli_real_escape_string($this->conn,utf8_decode($reviewee));
				$review_fee_vsu = sprintf("%.2f",$review_fee_vsu);
				$review_fee_non_vsu = sprintf("%.2f",$review_fee_non_vsu);

				$sql = "UPDATE `review_schedule` SET `i_rm_id` = '$room_id', `str_description` = '$description', `str_reviewee` = '$reviewee', `dt_start` = '$date_start', `dt_end`='$date_end', `f_reviewfee_vsu` = '$review_fee_vsu', `f_reviewfee_non_vsu` = '$review_fee_non_vsu', `i_reviewers` = '$reviewers', `i_status` = 1 WHERE `i_rid` = $review_id";

				if($this->conn->query($sql)){
					//return "Successfully updated...";
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