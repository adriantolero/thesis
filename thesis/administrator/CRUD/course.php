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

		public function getCourse($search){

			try{

				$search = mysqli_real_escape_string($this->conn,utf8_decode($search));

				$sql = "SELECT * FROM `course` WHERE `course` LIKE '%$search%' ORDER BY `course` ASC";
				$result = $this->conn->query($sql);
				$data = NULL;
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						$data .="<tr>";
						$data .="<td><center>" . utf8_encode($row["course"]) . "</center></td>";
						$data .="<td><center><button class='btn btn-primary' id='viewCourseInfo-toggle' data-id='" . $row["i_course_id"] . "'><i class='fa fa-search'></i> View Info</button></center></td>";
						$data .="<td><center><button class='btn btn-primary' id='viewMajorList-toggle' data-id='" . $row["i_course_id"] . "'><i class='fa fa-search'></i> View Major</button></center></td>";
						$data .="<td><center><button class='btn btn-danger' id='deleteCourse' data-id='" . $row["i_course_id"] . "'><i class='fa fa-times'></i> Delete</button></center></td>";
						$data .="</tr>";
					}
				}
				return $data;

			}catch(exception $e){
				return $e;
			}

		}

		public function createCourse($course){

			try{

				$course = mysqli_real_escape_string($this->conn,utf8_decode($course));
				$sql = "INSERT INTO `course`(`course`) VALUES('$course')";
				if($this->conn->query($sql)){
					return "Successfully created";
				}
				else{
					return "Error: " . $sql . "<br>" . $this->conn->error;
				}

			}catch(exception $e){
				return $e;
			}

		}

		public function getCourseInfo($i_course_id){

			try{

				$sql = "SELECT * FROM `course` WHERE `i_course_id`=$i_course_id";
				$result = $this->conn->query($sql);
				$data = NULL;
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						return array("course"=>utf8_encode($row["course"]));
					}
				}

			}catch(exception $e){
				return $e;
			}

		}

		public function updateCourse($i_course_id,$course){

			try{

				$course = mysqli_real_escape_string($this->conn,utf8_decode($course));

				$sql = "UPDATE `course` SET `course`='$course' WHERE `i_course_id`=$i_course_id";
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

		public function deleteCourse($i_course_id){

			try{

				$sql = "DELETE FROM `course` WHERE `i_course_id`=$i_course_id";
				if($this->conn->query($sql)){
					return "Successfully deleted";
				}
				else{
					return "Error: " . $sql . "<br>" . $this->conn->error;
				}

			}catch(exception $e){
				return $e;
			}

		}

		public function getMajor($i_course_id,$search){

			try{

				$search = mysqli_real_escape_string($this->conn,utf8_decode($search));

				$sql = "SELECT * FROM `major` WHERE `i_course_id`=$i_course_id AND `str_major` LIKE '%$search%' ORDER BY `str_major` ASC";
				$result = $this->conn->query($sql);
				$data = NULL;
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						$data .= "<tr>";
						$data .= "<td><center>" . utf8_encode($row["str_major"]) . "</center></td>";
						$data .= "<td><center><button class='btn btn-primary' id='viewMajor-toggle' data-id='" . $row["i_mid"] . "'><i class='fa fa-search'></i> View Info</button></center></td>";
						$data .= "<td><center><button class='btn btn-danger' id='deleteMajor' data-id='" . $row["i_mid"] . "'><i class='fa fa-times'></i> Delete</button></center></td>";
						$data .= "</tr>";
					}
				}
				else{
					$data = "<tr class='bg-danger text-white'><td colspan='3'><center><h3>Empty Record</h3></center></td></tr>";
				}
				return $data;

			}catch(exception $e){
				return $e;
			}

		}

		public function createMajor($i_course_id,$major){

			try{
				$major = mysqli_real_escape_string($this->conn,utf8_decode($major));
				$sql = "INSERT INTO `major`(`str_major`,`i_course_id`) VALUES('$major',$i_course_id)";
				if($this->conn->query($sql)){
					return "Successfully created";
				}
				else{
					return "Error: " . $sql . "<br>" . $this->conn->error;
				}

			}catch(exception $e){
				return $e;
			}

		}

		public function getMajorInfo($i_mid){

			try{

				$sql = "SELECT * FROM `major` WHERE `i_mid`=$i_mid";
				$result = $this->conn->query($sql);
				//$data = NULL;
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						return array("major"=>utf8_encode($row["str_major"]));
					}
				}

			}catch(exception $e){
				return $e;
			}

		}

		public function updateMajor($i_mid,$major){

			try{

				$major = mysqli_real_escape_string($this->conn,utf8_decode($major));
				$sql = "UPDATE `major` SET `str_major`='$major' WHERE `i_mid`=$i_mid";
				if($this->conn->query($sql)){
					return "Successfully updated.";
				}
				else{
					return "Error: " . $sql . "<br>" . $this->conn->error;
				}

			}catch(exception $e){
				return $e;
			}

		}

		public function deleteMajor($i_mid){

			try{

				$sql = "DELETE FROM `major` WHERE `i_mid`=$i_mid";
				if($this->conn->query($sql)){
					return "Successfully deleted";
				}
				else{
					return "Error: " . $sql . "<br>" . $this->conn->error;
				}

			}catch(exception $e){
				return $e;
			}

		}

	}

?>