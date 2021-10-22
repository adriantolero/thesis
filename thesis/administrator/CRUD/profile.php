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

		public function getProfile($i_emp_id){

			try{

				$sql = "SELECT * FROM `employee` WHERE `i_emp_id`=$i_emp_id";
				$result = $this->conn->query($sql);
				if($result->num_rows > 0 ){
					while ($row = $result->fetch_assoc()) {
						return array("emp_id"=>$row["i_emp_id"],"fname"=>utf8_encode($row["str_e_fname"]),"mi"=>utf8_encode($row["str_e_MI"]),"lname"=>utf8_encode($row["str_e_lname"])/*,"username"=>$row["str_username"]*/,"password"=>utf8_encode($row["str_pass"]));
					}
				}

			}catch(exception $e){
				return $e;
			}

		}

		public function updateProfile($i_emp_id,$fname,$mi,$lname,$password){

			try{
				
				$fname = mysqli_real_escape_string($this->conn,utf8_decode($fname));
				$mi = mysqli_real_escape_string($this->conn,utf8_decode($mi));
				$lname = mysqli_real_escape_string($this->conn,utf8_decode($lname));
				$password = mysqli_real_escape_string($this->conn,utf8_decode($password));

				$sql = "UPDATE `employee` SET `str_e_fname`='$fname', `str_e_MI`='$mi', `str_e_lname`='$lname', `str_pass`='$password' WHERE `i_emp_id`=$i_emp_id";	
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

	}

?>