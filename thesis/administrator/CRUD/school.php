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

		public function getSchool($schoolName){

			try{
				$schoolName = mysqli_real_escape_string($this->conn,utf8_decode($schoolName));
				$sql = "SELECT * FROM `school` WHERE `str_school_name` LIKE '%$schoolName%' ORDER BY `str_school_name` ASC";
				$result = $this->conn->query($sql);
				$data = NULL;
				$school_type = NULL;
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						$data .="<tr>";
						$data .="<td><center>" . utf8_encode($row["str_school_name"]) . "</center></td>";
						$data .="<td><center>" . utf8_encode($row["str_school_address"]) . "</center></td>";
						if($row["i_school_type"]==1){
							$school_type = "VSU";
						}
						else{
							$school_type = "Non-VSU";
						}

						$data .="<td><center>" . $school_type . "</center></td>";
						$data .="<td><center><button class='btn btn-primary' id='editSchool' data-id='" . $row["i_sid"] . "'><i class='fa fa-edit'></i> Edit</button></center></td>";
						$data .="<td><center><button class='btn btn-danger' id='deleteSchool' data-id='" . $row["i_sid"] . "'><i class='fa fa-times'></i> Delete</button></center></td>";
						
						$data .="</tr>";
					}
				}
				else{
					$data = "<tr class='bg-danger text-white'><td colspan='5'><center><h3>Empty Result</h3></center></td></tr>";
				}
				$this->conn->close();	
				return $data;

			}catch(exception $e){
				return $e;
			}

		}

		public function addSchool($schoolName,$schoolAddress,$schoolType){

			try{
				$schoolName = mysqli_real_escape_string($this->conn,utf8_decode($schoolName));
				$schoolAddress = mysqli_real_escape_string($this->conn,utf8_decode($schoolAddress));
				$sql = "INSERT INTO `school`(`str_school_name`,`str_school_address`,`i_school_type`) VALUES('$schoolName','$schoolAddress',$schoolType)";
				if($this->conn->query($sql)){
					return "Successfully created.";
				}
				else{
					return "Error: " . $sql . "<br>" . $this->conn->error;
				}
				$this->conn->close();	

			}catch(exception $e){
				return $e;
			}

		}

		public function getSchoolInfo($i_sid){
			
			try{

				$sql = "SELECT * FROM `school` WHERE `i_sid`=$i_sid";
				$result = $this->conn->query($sql);
				$data = NULL;
				$school_type = NULL;
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						return array("schoolName"=>utf8_encode($row["str_school_name"]),"schoolAddress"=>utf8_encode($row["str_school_address"]),"schoolType"=>$row["i_school_type"]);
					}
				}

			}catch(exception $e){
				return $e;
			}

		}

		public function updateSchool($i_sid,$schoolName,$schoolAddress,$schoolType){

			try{
				$schoolName = mysqli_real_escape_string($this->conn,utf8_decode($schoolName));
				$schoolAddress = mysqli_real_escape_string($this->conn,utf8_decode($schoolAddress));
				//return $schoolName;
				//return "$i_sid $schoolName $schoolAddress $schoolType";
				$sql = "UPDATE `school` SET `str_school_name`='$schoolName', `str_school_address`='$schoolAddress', `i_school_type`=$schoolType WHERE `i_sid`=$i_sid";
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

		public function deleteSchool($i_sid){

			try{

				$sql = "DELETE FROM `SCHOOL` WHERE `i_sid`=$i_sid";

				if($this->conn->query($sql)){
					return "Successfully deleted.";
				}
				else{
					return "Error: " . $sql . "<br>" . $this->conn->error;
				}
				$this->conn->close();	

			}catch(exception $e){
				return $e;
			}

		}

	}

?>