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

		public function getAccounts($search,$category){

			try{

				$search = mysqli_real_escape_string($this->conn,utf8_decode($search));

				if($category == 1){
					$sql = "SELECT * FROM `employee` WHERE `str_username` LIKE '$search%' AND `str_username`<>'admin'";
				}

				else if($category == 2){
					$sql = "SELECT * FROM `employee` WHERE `str_e_fname` LIKE '$search%' AND `str_username`<>'admin'";
				}
				else{
					$sql = "SELECT * FROM `employee` WHERE `str_e_lname` LIKE '$search%' AND `str_username`<>'admin'";
				}
				
				$data = NULL;
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						if($row["str_username"]=="admin"){
							
						}
						else{
							$data .= "<tr><td><center>" . utf8_encode($row["str_e_lname"]) . ", " . utf8_encode($row["str_e_fname"]) . " " . utf8_encode($row["str_e_MI"]) . "</center></td><td><center>" . utf8_encode($row["str_username"]) . "</center></td><td><center><button class='btn btn-primary' id='editUser' data-id='" . $row["i_emp_id"] . "'><i class='fa fa-edit'></i> Edit</center></td><td><center><button class='btn btn-danger' id='deleteUser' data-id='" . $row["i_emp_id"] . "'><i class='fa fa-times'></i> Delete</center></td></tr></tr>";
						}
						
					}
				}

				else{
					$data = "<tr class='bg-danger text-white'><td colspan='4'><center><h3>No record</h3></center></td></tr>";
				}

				return $data;

			}catch(exception $e){
				return $e;
			}

		}

		public function createAccount($username,$password,$fname,$mi,$lname){
			try{

				$username = mysqli_real_escape_string($this->conn,utf8_decode($username));
				$password = mysqli_real_escape_string($this->conn,utf8_decode($password));
				$fname = mysqli_real_escape_string($this->conn,utf8_decode($fname));
				$mi = mysqli_real_escape_string($this->conn,utf8_decode($mi));
				$lname = mysqli_real_escape_string($this->conn,utf8_decode($lname));

				$sql = "INSERT INTO `employee`(`str_username`,`str_pass`,`str_e_lname`,`str_e_fname`,`str_e_MI`) VALUES('$username','$password','$lname','$fname','$mi')";
				if($this->conn->query($sql)){
					return "Successfully created new account.";
				}
				else{
					return "Error: " . $sql . "<br>" . $this->conn->error;
				}

			}catch(exception $e){
				return $e;
			}
		}

		public function checkUsername($username){

			try{

				$username = mysqli_real_escape_string($this->conn,utf8_decode($username));

				$sql = "SELECT * FROM `employee` WHERE `str_username`='$username'";
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					return 1;
				}
				else{
					return 0;
				}

			}catch(exception $e){
				return $e;
			}

		}

		public function getUserInfo($i_emp_id){

			try{

				$sql = "SELECT * FROM `employee` WHERE `i_emp_id`=$i_emp_id";
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						return array("i_emp_id"=>$row["i_emp_id"],"username"=>utf8_encode($row["str_username"]),"password"=>utf8_encode($row["str_pass"]),"lname"=>utf8_encode($row["str_e_lname"]),"fname"=>utf8_encode($row["str_e_fname"]),"mi"=>utf8_encode($row["str_e_MI"]));
					}
				}

			}catch(exception $e){
				return $e;
			}

		}

		public function updateUserInfo($i_emp_id,$username,$password,$fname,$mi,$lname){

			$username = mysqli_real_escape_string($this->conn,utf8_decode($username));
			$password = mysqli_real_escape_string($this->conn,utf8_decode($password));
			$fname = mysqli_real_escape_string($this->conn,utf8_decode($fname));
			$mi = mysqli_real_escape_string($this->conn,utf8_decode($mi));
			$lname = mysqli_real_escape_string($this->conn,utf8_decode($lname));

			try{

				$sql = "UPDATE `employee` SET `str_username`='$username', `str_pass`='$password', `str_e_fname`='$fname', `str_e_MI`='$mi', `str_e_lname`='$lname' WHERE `i_emp_id`=$i_emp_id";
				if($this->conn->query($sql)){
					return "Successfully updated the account.";
				}
				else{
					return "Error: " . $sql . "<br>" . $this->conn->error;
				}

			}catch(exception $e){
				return $e;
			}
			//return $i_emp_id . $username . $password . $fname . $mi . $lname;
		}

		public function updateUserInfo_checkUsername($i_emp_id,$username){
			try{

				$username = mysqli_real_escape_string($this->conn,utf8_decode($username));
			
				$sql = "SELECT * FROM `employee` WHERE `str_username`='$username' AND `i_emp_id`<>$i_emp_id";
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					return 1;
				}
				else{
					return 0;
				}

			}catch(exception $e){
				return $e;
			}
		}

		public function deleteUser($i_emp_id){

			try{

				$sql = "DELETE FROM `employee` WHERE `i_emp_id`=$i_emp_id";
				if($this->conn->query($sql)){
					return "Successfully deleted.";
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