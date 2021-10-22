<?php
	/*header("Content-type: text/html; charset=iso-8859-1");*/
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
		
		public function fillReservedSched(){
			try{

				$sql = "SELECT `i_rid`,`str_description`,`dt_start`,`dt_end` FROM `review_schedule` WHERE `i_status`=1 ORDER BY `dt_start` DESC";
				$data = "";
				$result = $this->conn->query($sql);
				if($result->num_rows > 0 ){
					while ($row = $result->fetch_assoc()) {
						$data .= "<option value='" . $row["i_rid"] . "'>" . utf8_encode($row["str_description"]) . " (" . date("Y",strtotime($row["dt_start"])) . ")" . "</option>";
					}
					echo $data;
				}

			}catch(exception $e){
				echo $e;
			}
		}

		public function createRequest($i_rid,$lname,$fname,$mi,$bdate,$address,$contact,$email,$i_sid,$i_mid,$yrGrad,$lodge){

			try{
				$lname = mysqli_real_escape_string($this->conn,utf8_decode($lname));
				$fname = mysqli_real_escape_string($this->conn,utf8_decode($fname));
				$mi = mysqli_real_escape_string($this->conn,utf8_decode($mi));
				$bdate = mysqli_real_escape_string($this->conn,utf8_decode($bdate));
				$address = mysqli_real_escape_string($this->conn,utf8_decode($address));
				$contact = mysqli_real_escape_string($this->conn,utf8_decode($contact));
				$email = mysqli_real_escape_string($this->conn,utf8_decode($email));
				$yrGrad = mysqli_real_escape_string($this->conn,utf8_decode($yrGrad));

				$sql = "INSERT INTO `reviewer`(`ch_sname`,`ch_fname`,`ch_mi`,`d_birthdate`,`i_year_grad`,`i_sid`,`i_mid`,`str_address`,`str_contact_no`,`str_email_add`,`i_lodging`) VALUES('$lname','$fname','$mi','$bdate',$yrGrad,$i_sid,$i_mid,'$address','$contact','$email',$lodge);";
				//LAST_INSERT_ID() <- gets the last inserted id on reviewer table
				if($this->conn->query($sql)){
					date_default_timezone_set('Asia/Manila');
					$today = date('Y-m-d H:i:s',strtotime("now"));

					$sql = "INSERT INTO `reservation`(`i_rid`,`i_rev_id`,`d_date_requested`,`status`) VALUES('$i_rid','" . $this->conn->insert_id . "','$today','0');";
					if($this->conn->query($sql)){
						return "New record added";
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

		public function getRequests($review_id,$search,$searchBy){

			try{
				$search = mysqli_real_escape_string($this->conn,utf8_decode($search));
				if($searchBy==1){
					$sql="SELECT `reservation`.`i_rev_id`,`reviewer`.`ch_sname`,`reviewer`.`ch_fname`,`reviewer`.`ch_mi` ,`reservation`.`d_date_requested`,`reservation`.`status`
					FROM `reservation`
					INNER JOIN `reviewer`
					ON `reservation`.`i_rev_id`=`reviewer`.`i_rev_id`
					WHERE `reservation`.`status`=0 AND `reservation`.`i_rid`=$review_id AND `reviewer`.`ch_sname` LIKE '$search%' ORDER BY `d_date_requested` DESC";
				}
				else{
					$sql="SELECT `reservation`.`i_rev_id`,`reviewer`.`ch_sname`,`reviewer`.`ch_fname`,`reviewer`.`ch_mi` ,`reservation`.`d_date_requested`,`reservation`.`status`
					FROM `reservation`
					INNER JOIN `reviewer`
					ON `reservation`.`i_rev_id`=`reviewer`.`i_rev_id`
					WHERE `reservation`.`status`=0 AND `reservation`.`i_rid`=$review_id AND `reviewer`.`ch_fname` LIKE '$search%' ORDER BY `d_date_requested` DESC";
				}
				$data = "";
				$result = $this->conn->query($sql);
				if($result->num_rows > 0 ){
					date_default_timezone_set('Asia/Manila');

					while ($row = $result->fetch_assoc()) {
						$request_date = $row["d_date_requested"];
						//$request_date = "2018-05-09 22:31:00";
						$expire = strtotime($request_date. ' + 3 days');
						$today = strtotime("now");//gets the date & time(Asia/Manila GMT +8)

						//$seconds = $expire - $today;
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
						/*else if($days!=0 && $hours!=0 && $minutes==0){
							$strleft = $strdays . $strhours . $strminutes;
						}*/
						else if($days==0 && $hours!=0 && $minutes!=0){
							$strdays = "";
							$strleft = $strhours . $strminutes;
						}
						/*
						else if($days==0 && $hours!=0 && $minutes==0){
							$strdays = "";
							$strleft = $strhours . $strminutes;
						}*/
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

						//$strleft = $strdays . $strhours . $strminutes;

						//DISPLAYS REVIEWER BUT Cannot be accepted anymore
						if($today >= $expire){
							$data .= "<tr class='bg-danger text-white'><td><center><a href='#' id='info_appr_reviewer' data-toggle='modal' data-target='#viewRequestInfo-modal' data-id='" . $row["i_rev_id"] . "'" .  "><i class='fa fa-info-circle fa-2x'></i></a></center></td><td><center>" . utf8_encode($row["ch_sname"]) . ", " . utf8_encode($row["ch_fname"]) . " " . utf8_encode($row["ch_mi"])  . "</center></td><td><center>" . date("F d, Y h:i:s a",strtotime($row["d_date_requested"])) .  "</center></td><td><center>Expired</center></td><td colspan='2'><center><a href='#' id='del_appr_reviewer' data-id=" . "'" .  $row['i_rev_id'] . "'" .  "><i class='fa fa-trash fa-2x'></i></a></center></td>";
						}

						//DISPLAYS REVIEWER(Still accepted)
						else{
							$data .= "<tr><td><center><a href='#' id='info_appr_reviewer' data-toggle='modal' data-target='#viewRequestInfo-modal' data-id='" . $row["i_rev_id"] . "'" .  "><i class='fa fa-info-circle fa-2x'></i></a></center></td><td><center>" . utf8_encode($row["ch_sname"]) . ", " . utf8_encode($row["ch_fname"]) . " " . utf8_encode($row["ch_mi"])  . "</center></td><td><center>" . date("F d, Y h:i:s a",strtotime($row["d_date_requested"])) .  "</center></td><td><center>$strleft</center></td><td><center><button class='btn btn-primary' id='acc_appr_reviewer' data-id=" . "'" .  $row['i_rev_id'] . "'" .  "><i class='fa fa-check'></i> Accept</button></center>
							</td><td><center><button class='btn btn-danger' id='rej_appr_reviewer' data-id=" . "'" . $row['i_rev_id'] . "'" .  "><i class='fa fa-times'></i> Reject</button></center>
							</td></tr>";
						}
						
					}
				}
				else{
					$data = "<tr class='bg-danger text-white'><td colspan='5'><center><h3>List is empty</h3></center></td></tr>";
				}
				return $data;

			}catch(exception $e){
				return $e;
			}

		}

		public function getApproved($review_id){
			try{

				/*
				$sql = "SELECT `rs`.`i_rid`,`rs`.`str_description`,`rs`.`i_reviewers` - COUNT(`res`.`i_rev_id`) AS `num_stud`
					FROM `review_schedule` `rs`
					INNER JOIN `reservation` `res`
					ON `rs`.`i_rid`=`res`.`i_rid`
					WHERE `rs`.`i_rid`=$review_id AND (`res`.`status`=1 OR `res`.`status`=2)
					GROUP BY `rs`.`str_description`";
				$title = "";
				$num_stud = 0;
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						$title = $row["str_description"];
						$num_stud = $row["num_stud"];
					}
				}
				else{
					$sql = "SELECT `rs`.`i_rid`,`rs`.`str_description`,`rs`.`i_reviewers`
						FROM `review_schedule` `rs`
						WHERE `rs`.`i_rid`=$review_id";
					$title = "";
					$result = $this->conn->query($sql);
					if($result->num_rows > 0){
						while ($row = $result->fetch_assoc()) {
							$title = $row["str_description"];
							$num_stud = $row["i_reviewers"];
						}
					}
				}
				*/
				$sql = "SELECT `reservation`.`i_rev_id`,`reviewer`.`ch_sname`,`reviewer`.`ch_fname`,`reviewer`.`ch_mi` ,`reservation`.`status`
					FROM `reservation`
					INNER JOIN `reviewer`
					ON `reservation`.`i_rev_id`=`reviewer`.`i_rev_id`
					WHERE `reservation`.`status`=2 AND `reservation`.`i_rid`=$review_id ORDER BY `reviewer`.`ch_sname` ASC";
				$data = "";
				$result = $this->conn->query($sql);
				if($result->num_rows > 0 ){
					$status = "";
					while ($row = $result->fetch_assoc()) {
						$data .= "<tr><td>" . utf8_encode($row["ch_sname"]) . ", " . utf8_encode($row["ch_fname"]) . " " . utf8_encode($row["ch_mi"])  . " </td><td><center><button class='btn btn-primary' id='vw_appr_reviewer' data-toggle='modal' data-target='#viewReviewer-modal' data-id=" . "'" .  $row['i_rev_id'] . "'" .  "><i class='fa fa-search'></i> View</button></center></td><td><center><button class='btn btn-primary' id='rem_appr_reviewer' data-id=" . "'" . $row['i_rev_id'] . "'" .  "><i class='fa fa-user-times'></i> Remove</button></center></td></tr>";
						/*if($row["status"]==1){
							$status = "Cancelled";
							$data .= "<tr><td>" . utf8_encode($row["ch_sname"]) . ", " . utf8_encode($row["ch_fname"]) . " " . utf8_encode($row["ch_mi"])  . " </td><td><center>$status</center></td><td><center><button class='btn btn-primary' id='vw_appr_reviewer' data-toggle='modal' data-target='#viewReviewer-modal' data-id=" . "'" .  $row['i_rev_id'] . "'" .  "><i class='fa fa-cog'></i> Manage</button></center></td><td><center><button class='btn btn-primary' id='going_appr_reviewer' data-id=" . "'" . $row["i_rev_id"]  ."'" . "><i class='fa fa-check'></i> Going</button></center></td><td><center><button class='btn btn-primary' id='rem_appr_reviewer' data-id=" . "'" . $row['i_rev_id'] . "'" .  "><i class='fa fa-user-times'></i> Remove</button></center></td></tr>";
						}
						else if($row["status"]==2){
							$status = "Going";
							$data .= "<tr><td>" . utf8_encode($row["ch_sname"]) . ", " . utf8_encode($row["ch_fname"]) . " " . utf8_encode($row["ch_mi"])  . " </td><td><center>$status</center></td><td><center><button class='btn btn-primary' id='vw_appr_reviewer' data-toggle='modal' data-target='#viewReviewer-modal' data-id=" . "'" .  $row['i_rev_id'] . "'" .  "><i class='fa fa-cog'></i> Manage</button></center></td><td><center><button class='btn btn-primary' id='canc_appr_reviewer' data-id=" . "'" . $row["i_rev_id"]  ."'" . "><i class='fa fa-times'></i> Cancel</button></center></td><td><center><button class='btn btn-primary' id='rem_appr_reviewer' data-id=" . "'" . $row['i_rev_id'] . "'" .  "><i class='fa fa-user-times'></i> Remove</button></center></td></tr>";
						}*/
						
					}
				}
				else{
					$data = "<tr class='bg-danger text-white'><td colspan='3'><center><h3>List is empty</h3></center></td></tr>";
				}
				//$array = array("title"=>$title,"num_stud"=>$num_stud,"data"=>$data);
				return $data;
			}catch(exception $e){
				//$array = array("error"=>$e);
				return $e;
			}
		}

		public function searchApproved($review_id,$search,$searchBy){

			try{

				$search = mysqli_real_escape_string($this->conn,utf8_decode($search));

				$sql = "";
				if($searchBy==1){
					$sql = "SELECT `reservation`.`i_rev_id`,`reviewer`.`ch_sname`,`reviewer`.`ch_fname`,`reviewer`.`ch_mi` ,`reservation`.`status`
					FROM `reservation`
					INNER JOIN `reviewer`
					ON `reservation`.`i_rev_id`=`reviewer`.`i_rev_id`
					WHERE (`reservation`.`status`=1 OR `reservation`.`status`=2) AND `reservation`.`i_rid`=$review_id AND `reviewer`.`ch_sname` LIKE '$search%' ORDER BY `reviewer`.`ch_sname` ASC";
				}

				else{
					$sql = "SELECT `reservation`.`i_rev_id`,`reviewer`.`ch_sname`,`reviewer`.`ch_fname`,`reviewer`.`ch_mi` ,`reservation`.`status`
					FROM `reservation`
					INNER JOIN `reviewer`
					ON `reservation`.`i_rev_id`=`reviewer`.`i_rev_id`
					WHERE (`reservation`.`status`=1 OR `reservation`.`status`=2) AND `reservation`.`i_rid`=$review_id AND `reviewer`.`ch_fname` LIKE '$search%' ORDER BY `reviewer`.`ch_sname` ASC";
				}
				
				$data = "";
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					$status = "";
					while($row = $result->fetch_assoc()){
						$data .= "<tr><td>" . utf8_encode($row["ch_sname"]) . ", " . utf8_encode($row["ch_fname"]) . " " . utf8_encode($row["ch_mi"])  . " </td><td><center><button class='btn btn-primary' id='vw_appr_reviewer' data-toggle='modal' data-target='#viewReviewer-modal' data-id=" . "'" .  $row['i_rev_id'] . "'" .  "><i class='fa fa-search'></i> View</button></center></td><td><center><button class='btn btn-primary' id='rem_appr_reviewer' data-id=" . "'" . $row['i_rev_id'] . "'" .  "><i class='fa fa-user-times'></i> Remove</button></center></td></tr>";
						/*if($row["status"]==1){
							$status = "Cancelled";
							$data .= "<tr><td>" . utf8_encode($row["ch_sname"]) . ", " . utf8_encode($row["ch_fname"]) . " " . utf8_encode($row["ch_mi"])  . " </td><td><center>$status</center></td><td><center><button class='btn btn-primary' id='vw_appr_reviewer' data-toggle='modal' data-target='#viewReviewer-modal' data-id=" . "'" .  $row['i_rev_id'] . "'" .  "><i class='fa fa-cog'></i> Manage</button></center></td><td><center><button class='btn btn-primary' id='going_appr_reviewer' data-id=" . "'" . $row["i_rev_id"]  ."'" . "><i class='fa fa-check'></i> Going</button></center></td><td><center><button class='btn btn-primary' id='rem_appr_reviewer' data-id=" . "'" . $row['i_rev_id'] . "'" .  "><i class='fa fa-user-times'></i> Remove</button></center></td></tr>";
						}
						else if($row["status"]==2){
							$status = "Going";
							$data .= "<tr><td>" . utf8_encode($row["ch_sname"]) . ", " . utf8_encode($row["ch_fname"]) . " " . utf8_encode($row["ch_mi"])  . " </td><td><center>$status</center></td><td><center><button class='btn btn-primary' id='vw_appr_reviewer' data-toggle='modal' data-target='#viewReviewer-modal' data-id=" . "'" .  $row['i_rev_id'] . "'" .  "><i class='fa fa-cog'></i> Manage</button></center></td><td><center><button class='btn btn-primary' id='canc_appr_reviewer' data-id=" . "'" . $row["i_rev_id"]  ."'" . "><i class='fa fa-times'></i> Cancel</button></center></td><td><center><button class='btn btn-primary' id='rem_appr_reviewer' data-id=" . "'" . $row['i_rev_id'] . "'" .  "><i class='fa fa-user-times'></i> Remove</button></center></td></tr>";
						}*/

						
					}
				}
				else{
					$data = "<tr class='bg-danger text-white'><td colspan='3'><center><h3>List is empty</h3></center></td></tr>";
				}
				return $data;

			}catch(exception $e){
				return $e;
			}
		
		}

		public function searchReservedSched($search){

			try{

				$search = mysqli_real_escape_string($this->conn,utf8_decode($search));

				$sql = "SELECT `i_rid`,`str_description`,`dt_start`,`dt_end` FROM `review_schedule` WHERE `str_description` LIKE '$search%' ORDER BY `dt_start` DESC";
				$data = "";
				$result = $this->conn->query($sql);
				if($result->num_rows > 0 ){
					while ($row = $result->fetch_assoc()) {
						$data .= "<option value='" . $row["i_rid"] . "'>" . utf8_encode($row["str_description"]) . " (" . date("Y",strtotime($row["dt_start"])) . ")" . "</option>";
					}
					return $data;
				}
				else{
					$data = "<option value=''>Empty Result</option>";
					return $data;
				}

			}catch(exception $e){
				return $e;
			}
		}

		public function acceptRequest($review_id,$reviewer_id){

			try{

				$sql = "UPDATE `reservation` SET `status`=2, `i_emp_id`=" . $_SESSION['id'] . " WHERE `i_rid`=$review_id AND `i_rev_id`=$reviewer_id";
				//$data = "";
				$result = $this->conn->query($sql);
				if($this->conn->query($sql)){
					//return "Successfully updated...";
					return "Request accepted";

				}
				else{
					return "Error updating record: " . $this->conn->error;
				}

			}catch(exception $e){
				return $e;
			}
		}

		public function rejectReviewer($i_rid,$i_rev_id){

			try{	
				/*date_default_timezone_set('Asia/Manila');
				$today = date('Y-m-d H:i:s',strtotime("now"));*/

				$sql = "UPDATE `reservation` SET `status`=3 WHERE `i_rid`=$i_rid AND `i_rev_id`=$i_rev_id";

				if($this->conn->query($sql)){
					return "This request has been rejected.";
				}
				else{
					return "Error updating record: " . $this->conn->error;
				}

			}catch(exception $e){
				return $e;
			}

		}

		public function viewRejectRequest($i_rid,$search,$searchBy){

			try{
				$search = mysqli_real_escape_string($this->conn,utf8_decode($search));
				if($searchBy==1){
					$sql = "SELECT `res`.`i_rid`,`rev`.`i_rev_id`, `rev`.`ch_sname`,`rev`.`ch_fname`,`rev`.`ch_mi`,`res`.`d_date_requested`,`res`.`status`
					FROM `reservation` `res` 
					INNER JOIN `reviewer` `rev` 
					ON `res`.`i_rev_id`=`rev`.`i_rev_id`
					WHERE `res`.`i_rid`=$i_rid AND `rev`.`ch_sname` LIKE '$search%' AND `res`.`status`=3 ORDER BY `d_date_requested` ASC";
				}

				else{
					$sql = "SELECT `res`.`i_rid`,`rev`.`i_rev_id`, `rev`.`ch_sname`,`rev`.`ch_fname`,`rev`.`ch_mi`,`res`.`d_date_requested`,`res`.`status`
					FROM `reservation` `res` 
					INNER JOIN `reviewer` `rev` 
					ON `res`.`i_rev_id`=`rev`.`i_rev_id`
					WHERE `res`.`i_rid`=$i_rid AND `rev`.`ch_fname` LIKE '$search%' AND `res`.`status`=3 ORDER BY `d_date_requested` ASC";
				}
				
				$data = "";
				$result = $this->conn->query($sql);
				if($result->num_rows > 0 ){
					while ($row = $result->fetch_assoc()) {
						$data .= "<tr><td><center><a href='#' id='info_appr_reviewer' data-toggle='modal' data-target='#viewRequestInfo-modal' data-id='" . $row["i_rev_id"] . "'" .  "><i class='fa fa-info-circle fa-2x'></i></a></center></td><td><center>" . utf8_encode($row["ch_sname"]) . ", " . utf8_encode($row["ch_fname"]) . " " . utf8_encode($row["ch_mi"])  . "</center></td><td><center><button type='button' class='btn btn-primary' id='recover-reject-req' data-id='" . $row["i_rev_id"] . "'" . "><i class='fa fa-undo'></i> Recover</button></center></td><td><center><button type='button' class='btn btn-danger' id='delete-reject-req' data-id='" . $row["i_rev_id"] . "'" . "><i class='fa fa-trash'></i> Delete</button></center></td></tr>";
					}
				}
				else{
					$data = "<tr class='bg-danger text-white'><td colspan='4'><h3><center>List is empty</center></h3></td></tr>";
				}return $data;

			}catch(exception $e){
				return $e;
			}

		}

		public function recoverRejectReviewer($i_rid,$i_rev_id){
			
			try{

				//date_default_timezone_set('Asia/Manila');
				//$today = date('Y-m-d H:i:s',strtotime("now"));

				$sql = "UPDATE `reservation` SET `status`=0 WHERE `i_rid`=$i_rid AND `i_rev_id`=$i_rev_id";

				if($this->conn->query($sql)){
					return "This request has been recovered";
				}
				else{
					return "Error updating record: " . $this->conn->error;
				}

			}catch(exception $e){

			}

		}

		public function deleteRejectReviewer($i_rev_id){

			try{
				$sql = "DELETE FROM `reviewer` WHERE `i_rev_id`=$i_rev_id";

				if($this->conn->query($sql)){
					return "This rejected reservation has been deleted";
				}
				else{
					return "Error deleting record: " . $this->conn->error;
				}
			}catch(exception $e){
				return $e;
			}
			

		}

		public function deleteReviewer($i_rev_id){

			try{

				$sql = "DELETE FROM `reviewer` WHERE `i_rev_id`=$i_rev_id";

				if($this->conn->query($sql)){
					return "Successfully deleted.";
				}
				else{
					return "Error deleting record: " . $this->conn->error;
				}

			}catch(exception $e){
				return $e;
			}

		}

		public function removeApproved($review_id,$reviewer_id){

			try{
				/*date_default_timezone_set('Asia/Manila');
				$today = date('Y-m-d H:i:s',strtotime("now"));*/
				//return $today;
				$sql =  "UPDATE `reservation` SET `status` = 4 WHERE `i_rid`=$review_id AND `i_rev_id`=$reviewer_id";
				$data = "";
				if($this->conn->query($sql)){
					//return "Successfully updated...";
					return true;

				}
				else{
					return "Error updating record: " . $this->conn->error;
				}

			}catch(exception $e){
				return $e;
			}

		}

		public function updateSlotremaining($i_rid){

			try{

				$sql = "SELECT `rs`.`i_rid`,`rs`.`str_description`,`rs`.`i_reviewers`,`rs`.`i_reviewers` - (SELECT COUNT(*) FROM `reservation` WHERE  `reservation`.`i_rid`=$i_rid AND (`reservation`.`status`=1 OR `reservation`.`status`=2)) AS `num_stud`
					FROM `review_schedule` `rs`
					WHERE `rs`.`i_rid`=$i_rid
					GROUP BY `rs`.`str_description`";

				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					$title = "";
					$slot = 0;
					while ($row = $result->fetch_assoc()) {
						$title = utf8_encode($row["str_description"]);
						$slot = $row["num_stud"];
					}
					return array("title"=>$title,"slot"=>$slot);
				}

			}catch(exception $e){
				return array("error"=>$e);
			}

		}

		public function getSchool(){

			try{
				$sql = "SELECT * FROM `school` ORDER BY `str_school_name` ASC";
				$data = "<option value=''></option>";
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					while($row = $result->fetch_assoc()){
						if($row["str_school_address"]==null){
							$data .="<option value='" . $row["i_sid"] . "'>" . utf8_encode($row["str_school_name"]) . "</option>";
						}
						else{
							$data .="<option value='" . $row["i_sid"] . "'>" . utf8_encode($row["str_school_name"]) . ", " . utf8_encode($row["str_school_address"]) . "</option>";
						}
					}
				}
				return $data;
			}catch(exception $e){
				return $e;
			}	

		}

		public function getCourse(){

			try{

				$sql = "SELECT * FROM `course`";
				$data = "<option value=''></option>";
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					while($row = $result->fetch_assoc()){
						$data .="<option value='" . $row["i_course_id"] . "'>" . utf8_encode($row["course"]) . "</option>";
					}
				}

				return $data;

			}catch(exception $e){
				return $e;
			}	

		}

		public function getMajor($course_id){

			try{

				$sql = "SELECT `major`.`i_mid`, `major`.`str_major` FROM `major`
						INNER JOIN `course` ON `major`.`i_course_id` = `course`.`i_course_id` WHERE `major`.`i_course_id`=$course_id";
				$data = "<option value=''></option>";
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					while($row = $result->fetch_assoc()){
						$data .="<option value='" . $row["i_mid"] . "'>" . utf8_encode($row["str_major"]) . "</option>";
					}
				}

				return $data;

			}catch(exception $e){
				return $e;
			}

		}

		//unfinished
		public function createReviewer($i_rid,$lname,$fname,$mi,$bdate,$address,$contact,$email,$i_sid,$i_mid,$yrGrad,$lodge){
			
			try{

				$lname = mysqli_real_escape_string($this->conn,utf8_decode($lname));
				$fname = mysqli_real_escape_string($this->conn,utf8_decode($fname));
				$mi = mysqli_real_escape_string($this->conn,utf8_decode($mi));
				$bdate = mysqli_real_escape_string($this->conn,utf8_decode($bdate));
				$address = mysqli_real_escape_string($this->conn,utf8_decode($address));
				$contact = mysqli_real_escape_string($this->conn,utf8_decode($contact));
				$email = mysqli_real_escape_string($this->conn,utf8_decode($email));
				$yrGrad = mysqli_real_escape_string($this->conn,utf8_decode($yrGrad));
			
				$sql = "INSERT INTO `reviewer`(`ch_sname`,`ch_fname`,`ch_mi`,`d_birthdate`,`i_year_grad`,`i_sid`,`i_mid`,`str_address`,`str_contact_no`,`str_email_add`,`i_lodging`) VALUES('$lname','$fname','$mi','$bdate',$yrGrad,$i_sid,$i_mid,'$address','$contact','$email',$lodge);";
				//LAST_INSERT_ID() <- gets the last inserted id on reviewer table
				if($this->conn->query($sql)){
					
					$sql = "INSERT INTO `reservation`(`i_rid`,`i_rev_id`,`status`,`i_emp_id`) VALUES('$i_rid','" . $this->conn->insert_id . "','2'," . $_SESSION['id'] . ");";
					if($this->conn->query($sql)){
						return "New record added";
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

		public function createSchool($school,$address,$schoolType){

			try{

				$school = mysqli_real_escape_string($this->conn,utf8_decode($school));
				$address = mysqli_real_escape_string($this->conn,utf8_decode($address));

				$sql = "INSERT INTO `school`(`str_school_name`,`str_school_address`,`i_school_type`) VALUES('$school','$address',$schoolType);";
				if($this->conn->query($sql)){
					return $this->conn->insert_id;
				}
				else{
					return "Error: " . $sql . "<br>" . $this->conn->error;
				}
			}catch(exception $e){
				return $e;
			}

		}

		public function createCourse($course/*,$major*/){

			try{

				$course = mysqli_real_escape_string($this->conn,utf8_decode($course));

				$sql = "INSERT INTO `course`(`course`) VALUES('$course');";
				if($this->conn->query($sql)){
					return "New course created";
				}
				else{
					return "Error: " . $sql . "<br>" . $this->conn->error;
				}
			}catch(exception $e){
				return $e;
			}

		}

		public function createMajor($course_id,$major){

			try{

				$major = mysqli_real_escape_string($this->conn,utf8_decode($major));

				$sql = "INSERT INTO `major`(`str_major`,`i_course_id`) VALUES('$major',$course_id)";
				if($this->conn->query($sql)){
					return "New major created";
				}
				else{
					return "Error: " . $sql . "<br>" . $this->conn->error;
				}

			}catch(exception $e){
				return $e;
			}

		}

		public function viewReviewer($i_rev_id){

			try{

				$sql = "SELECT `rev`.`i_rev_id`,`rev`.`ch_sname`, `rev`.`ch_fname`,`rev`.`ch_mi`,`rev`.`d_birthdate`,`rev`.`i_year_grad`,`rev`.`i_sid`,`school`.`str_school_name`,`school`.`str_school_address`,`rev`.`i_mid`,`major`.`str_major`,`major`.`i_course_id`,`course`.`course`,`rev`.`str_address`,`rev`.`str_contact_no`,`rev`.`str_email_add`,`rev`.`i_lodging`
					FROM `reviewer` `rev` 
					LEFT JOIN `school`
					ON `rev`.`i_sid`=`school`.`i_sid`
					LEFT JOIN `major`
					ON `rev`.`i_mid`=`major`.`i_mid`
					LEFT JOIN `course`
					ON `major`.`i_course_id`=`course`.`i_course_id`
					WHERE `rev`.`i_rev_id`=$i_rev_id";
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						return array("i_rev_id"=>$row["i_rev_id"],"sname"=>utf8_encode($row["ch_sname"]),"fname"=>utf8_encode($row["ch_fname"]),"mi"=>utf8_encode($row["ch_mi"]),"bdate"=>utf8_encode($row["d_birthdate"]),"yrGrad"=>$row["i_year_grad"],"sid"=>$row["i_sid"],"course_id"=>$row["i_course_id"],"mid"=>$row["i_mid"],"address"=>utf8_encode($row["str_address"]),"contact"=>utf8_encode($row["str_contact_no"]),"email"=>utf8_encode($row["str_email_add"]),"lodging"=>$row["i_lodging"]);
					}
				}

			}catch(exception $e){
				return $e;
			}

		}

		public function updateReviewer($i_rev_id,$fname,$mi,$lname,$bdate,$address,$contact,$email,$sid,$mid,$yrGrad,$lodge){

			try{

				$lname = mysqli_real_escape_string($this->conn,utf8_decode($lname));
				$fname = mysqli_real_escape_string($this->conn,utf8_decode($fname));
				$mi = mysqli_real_escape_string($this->conn,utf8_decode($mi));
				$bdate = mysqli_real_escape_string($this->conn,utf8_decode($bdate));
				$address = mysqli_real_escape_string($this->conn,utf8_decode($address));
				$contact = mysqli_real_escape_string($this->conn,utf8_decode($contact));
				$email = mysqli_real_escape_string($this->conn,utf8_decode($email));
				$yrGrad = mysqli_real_escape_string($this->conn,utf8_decode($yrGrad));

				/*$fname = utf8_decode($fname);
				$mi = utf8_decode($mi);
				$lname = utf8_decode($lname);*/

				$sql = "UPDATE `reviewer` SET `ch_sname`='$lname', `ch_fname`='$fname',`ch_mi`='$mi',`d_birthdate`='$bdate',`i_year_grad`=$yrGrad,`i_sid`=$sid,`i_mid`=$mid,`str_address`='$address',`str_contact_no`='$contact',`str_email_add`='$email',`i_lodging`=$lodge WHERE `i_rev_id`=$i_rev_id";

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

		/*
		public function cancelReviewer($i_rev_id){


			try{

				$sql = "UPDATE `reservation` SET `status`=1 WHERE `i_rev_id`=$i_rev_id";

				if($this->conn->query($sql)){
					return "This reviewer's status has been change to 'cancelled'";
				}
				else{
					return "Error updating record: " . $this->conn->error;
				}

			}catch(exception $e){
				return $e;
			}

		}*/

		public function goingReviewer($i_rev_id){

			try{

				$sql = "UPDATE `reservation` SET `status`=2 WHERE `i_rev_id`=$i_rev_id";

				if($this->conn->query($sql)){
					return "This reviewer's status has been changed to 'going'";
				}
				else{
					return "Error updating record: " . $this->conn->error;
				}

			}catch(exception $e){
				return $e;
			}

		}

		public function getRemoved($i_rid,$search,$search_by){

			try{

				$search = mysqli_real_escape_string($this->conn,utf8_decode($search));
				$sql = "";

				if($search_by==1){
					$sql = "SELECT `res`.`i_rid`,`rev`.`i_rev_id`, `rev`.`ch_sname`,`rev`.`ch_fname`,`rev`.`ch_mi`,`res`.`d_date_requested`,`res`.`status`
					FROM `reservation` `res` 
					INNER JOIN `reviewer` `rev` 
					ON `res`.`i_rev_id`=`rev`.`i_rev_id`
					WHERE `res`.`i_rid`=$i_rid AND `res`.`status`=4 AND `rev`.`ch_sname` LIKE '$search%' ORDER BY `d_date_requested` DESC";
				}
				else{
					$sql = "SELECT `res`.`i_rid`,`rev`.`i_rev_id`, `rev`.`ch_sname`,`rev`.`ch_fname`,`rev`.`ch_mi`,`res`.`d_date_requested`,`res`.`status`
					FROM `reservation` `res` 
					INNER JOIN `reviewer` `rev` 
					ON `res`.`i_rev_id`=`rev`.`i_rev_id`
					WHERE `res`.`i_rid`=$i_rid AND `res`.`status`=4 AND `rev`.`ch_fname` LIKE '$search%' ORDER BY `d_date_requested` ASC";
				}
		
				$data = "";
				$result = $this->conn->query($sql);
				if($result->num_rows > 0 ){
					while ($row = $result->fetch_assoc()) {
						$data .= "<tr><td><center><a href='#' id='info_removed_reviewer' data-toggle='modal' data-target='#viewRemovedInfo-modal' data-id='" . $row["i_rev_id"] . "'" .  "><i class='fa fa-info-circle fa-2x'></i></a></center></td><td><center>" . utf8_encode($row["ch_sname"]) . ", " . utf8_encode($row["ch_fname"]) . " " . utf8_encode($row["ch_mi"])  . "</center></td><td><center><button type='button' class='btn btn-primary' id='recover-removed-reviewer' data-id='" . $row["i_rev_id"] . "'" . "><i class='fa fa-undo'></i> Recover</button></center></td><td><center><button type='button' class='btn btn-danger' id='delete-removed-reviewer' data-id='" . $row["i_rev_id"] . "'" . "><i class='fa fa-trash'></i> Delete</button></center></td></tr>";
					}
				}
				else{
					$data = "<tr class='bg-danger text-white'><td colspan='4'><h3><center>Removed reviewers list is empty</center></h3></td></tr>";
				}return $data;

			}catch(exception $e){
				return $e;
			}

		}

		public function recoverRemoved($i_rid,$i_rev_id){

			try{

				$sql = "UPDATE `reservation` SET `status`=2 WHERE `i_rid`=$i_rid AND `i_rev_id`=$i_rev_id";

				if($this->conn->query($sql)){
					return "Successfully recovered";
				}
				else{
					return "Error updating record: " . $this->conn->error;
				}

			}catch(exception $e){
				return $e;
			}

		}

		public function deleteRemoved($i_rev_id){

			try{

				$sql = "DELETE FROM `reviewer` WHERE `i_rev_id`=$i_rev_id";

				if($this->conn->query($sql)){
					return "Successfully deleted";
				}
				else{
					return "Error deleting record: " . $this->conn->error;
				}

			}catch(exception $e){
				return $e;
			}

		}

	}
?>