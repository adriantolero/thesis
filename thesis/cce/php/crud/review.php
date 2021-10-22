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

		public function getReview(){

			try{

				$sql = "SELECT `rs`.`i_rid`,`rm`.`str_rmName`,`rs`.`str_description`,`rs`.`dt_start`,
				`rs`.`dt_end`,`rs`.`i_reviewers` - (SELECT COUNT(*) FROM `reservation` WHERE  `reservation`.`i_rid`=`rs`.`i_rid` AND (`reservation`.`status`=1 OR `reservation`.`status`=2)) AS `num_stud`
				FROM `review_schedule` `rs`
				INNER JOIN `room` `rm`
				ON `rs`.`i_rm_id`=`rm`.`i_rm_id` WHERE `rs`.`i_status`=1 ORDER BY `dt_start` ASC";
				$data = NULL;
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						if($row["num_stud"]!=0){
							$data .= "<tr><td><center>" . utf8_encode($row["str_rmName"]) . "</center></td><td><center>" . utf8_encode($row["str_description"]) . "</center></td><td><center>" . date("F d, Y",strtotime($row["dt_start"])) . "</center></td><td><center>" . date("F d, Y",strtotime($row["dt_end"])) . "</center></td><td><center>" . $row["num_stud"] . "</center></td><td><center><button class='btn btn-primary' id='joinReview' data-id='" . $row["i_rid"] . "' data-toggle='modal' data-target='#joinReview-modal'>" . "Join" . "</button></center></td></tr>";
						}
						else{
							$data .= "<tr><td><center>" . utf8_encode($row["str_rmName"]) . "</center></td><td><center>" . utf8_encode($row["str_description"]) . "</center></td><td><center>" . date("F d, Y",strtotime($row["dt_start"])) . "</center></td><td><center>" . date("F d, Y",strtotime($row["dt_end"])) . "</center></td><td><center>" . $row["num_stud"] . "</center></td><td><center><button class='btn btn-danger' id='joinReview' data-id='" . $row["i_rid"] . "' disabled>" . "Full" . "</button></center></td></tr>";
						}	
					}// end of while loop
				}
				return $data;

			}catch(exception $e){
				return $e;
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
				/*
				$sql = "SELECT `i_sid`,`str_school_name`,`str_school_address` FROM `school` ORDER BY `str_school_name` ASC";
				$result = $this->conn->query($sql);
				$data = "<option value=''></option>";
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						$data.="<option value='" . $row["i_sid"] . "'>" . utf8_encode($row["str_school_name"]) . "</option>";
					}
				}*/
				

			}catch(exception $e){
				return $e;
			}

		}

		public function getCourse(){

			try{

				$sql = "SELECT * FROM `course` ORDER BY `course` ASC";
				$result = $this->conn->query($sql);
				$data = "<option value=''></option>";
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						$data.="<option value='" . $row["i_course_id"] . "'>" . utf8_encode($row["course"]) . "</option>";
					}
				}
				return $data;

			}catch(exception $e){
				return $e;
			}

		}

		public function getMajor($course_id){

			try{

				$sql = "SELECT * FROM `major` WHERE `i_course_id`=$course_id ORDER BY `str_major` ASC";
				$result = $this->conn->query($sql);
				$data = "<option value=''></option>";
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						$data.="<option value='" . $row["i_mid"] . "'>" . utf8_encode($row["str_major"]) . "</option>";
					}
				}
				return $data;

			}catch(exception $e){
				return $e;
			}

		}

		public function createSchool($school_name,$school_address){

			try{
				$school_name = mysqli_real_escape_string($this->conn,utf8_decode($school_name));
				$school_address = mysqli_real_escape_string($this->conn,utf8_decode($school_address));
				$sql = "INSERT INTO `school`(`str_school_name`,`str_school_address`,`i_school_type`) VALUES('$school_name','$school_address',0)";
				if($this->conn->query($sql)){
					return "New school created";
				}
				else{
					return "Error: " . $sql . "<br>" . $this->conn->error;
				}

			}catch(exception $e){
				return $e;
			}

		}

		public function createCourse($course){

			try{

				$course = mysqli_real_escape_string($this->conn,utf8_decode($course));

				$sql = "INSERT INTO `course`(`course`) VALUES('$course')";
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

		public function createReservation($i_rid,$fname,$mi,$lname,$bdate,$address,$contact,$email,$school,$course,$major,$yrGrad,$lodge){

			$fname = mysqli_real_escape_string($this->conn,utf8_decode($fname));
			$mi = mysqli_real_escape_string($this->conn,utf8_decode($mi));
			$lname = mysqli_real_escape_string($this->conn,utf8_decode($lname));
			$bdate = mysqli_real_escape_string($this->conn,utf8_decode($bdate));
			$address = mysqli_real_escape_string($this->conn,utf8_decode($address));
			$email = mysqli_real_escape_string($this->conn,utf8_decode($email));

			$sql = "INSERT INTO `reviewer`(`ch_sname`,`ch_fname`,`ch_mi`,`d_birthdate`,`str_address`,`str_contact_no`,`str_email_add`,`i_sid`,`i_mid`,`i_year_grad`,`i_lodging`) VALUES('$lname','$fname','$mi','$bdate','$address','$contact','$email',$school,$major,$yrGrad,$lodge)";

			if($this->conn->query($sql)){
				date_default_timezone_set('Asia/Manila');
				$today = date('Y-m-d H:i:s',strtotime("now"));

				$sql = "INSERT INTO `reservation`(`i_rid`,`i_rev_id`,`d_date_requested`,`status`) VALUES('$i_rid','" . $this->conn->insert_id . "','$today','0');";
				if($this->conn->query($sql)){
					return "Your request has been submitted.";
				}
				else{
					return "Error: " . $sql . "<br>" . $this->conn->error();
				}
			}
			else{
				return "Error: " . $this->conn->error();
			}
			/*date_default_timezone_set('Asia/Manila');
			$today = date('Y-m-d H:i:s',strtotime("now"));
			
			$sql = "INSERT INTO `reservation`(`i_rid`,`d_date_requested`,`status`) VALUES('$i_rid','$today','0');";
				if($this->conn->query($sql)){
					//return "New record added";
					$sql = "INSERT INTO `reviewer`(`i_rev_id`,`ch_sname`,`ch_fname`,`ch_mi`,`d_birthdate`,`str_address`,`str_contact_no`,`str_email_add`,`i_sid`,`i_mid`,`i_year_grad`,`i_lodging`) VALUES(" . $this->conn->insert_id . ",'$lname','$fname','$mi','$bdate','$address','$contact','$email',$school,$major,$yrGrad,$lodge)";

					if($this->conn->query($sql)){
						return "New record added";
					}
					else{
						return "Error: " . $sql . "<br>" . $this->conn->error();
					}
				}
				else{
					return "Error: " . $sql . "<br>" . $this->conn->error();
				}
				*/
		}

		public function viewSubmittedForm($i_rid,$fname,$mi,$lname,$bdate,$address,$contact,$email,$school_id,$major_id,$yrGrad,$lodge){

			try{

				$review_title = NULL;
				$school_name = NULL;
				$course = NULL;
				$major = NULL;
				$lodging = NULL;

				$sql = "SELECT `str_description` FROM `review_schedule` WHERE `i_rid`=$i_rid";
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						$review_title = utf8_encode($row["str_description"]);
					}
				}

				$sql = "SELECT * FROM `school` WHERE `i_sid`=$school_id";
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						$school_name = utf8_encode($row["str_school_name"]);
					}
				}

				$sql = "SELECT  `crs`.`course`,`mjr`.`str_major`
					FROM `course` `crs`
					INNER JOIN `major` `mjr`
					ON `crs`.`i_course_id`=`mjr`.`i_course_id` WHERE `i_mid`=$major_id";

				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						$course = utf8_encode($row["course"]);
						$major = utf8_encode($row["str_major"]);
					}
				}

				$full_name = $fname . " " . $mi . " " . $lname;
				if($lodge == 0){
					$lodging = "No";
				}
				else{
					$lodging = "Yes";
				}
				$data = "<tr><td align='right'><b>Review title</b></td><td>$review_title</td></tr>";
				$data .= "<tr><td align='right'><b>Name</b></td><td>$full_name</td></tr>";
				$data .="<tr><td align='right'><b>Birth date</b></td><td align='left'>$bdate</td></tr>";
				$data .="<tr><td align='right'><b>Address</b></td><td align='left'>$address</td></tr>";
				$data .="<tr><td align='right'><b>Contact No.</b></td><td align='left'>$contact</td></tr>";
				$data .="<tr><td align='right'><b>Email Address</b></td><td align='left'>$email</td></tr>";
				$data .="<tr><td align='right'><b>School</b></td><td align='left'>$school_name</td></tr>";
				$data .="<tr><td align='right'><b>Course</b></td><td align='left'>$course</td></tr>";
				$data .="<tr><td align='right'><b>Major</b></td><td align='left'>$major</td></tr>";
				$data .="<tr><td align='right'><b>Year Grad.</b></td><td align='left'>$yrGrad</td></tr>";
				$data .="<tr><td align='right'><b>Lodge</b></td><td align='left'>$lodging</td></tr>";

				return $data;
	
			}catch(exception $e){
				return $e;
			}

		}

	}

?>