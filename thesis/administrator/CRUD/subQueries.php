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

		public function login($username,$password){

			try{

				$sql = "SELECT * FROM `employee` WHERE `str_username` = '$username'";
				$result = $this->conn->query($sql);
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						if($row['str_pass']==$password){
							$_SESSION['username'] = $row['str_username'];
							$_SESSION['id'] = $row['i_emp_id'];
							$_SESSION["name"] = $row["str_e_fname"];
							//echo "Success";
							/*$data = array("user_id"=>$row['i_emp_id'],"username"=>$row['str_username'],"message"=>"Login success!");*/

							return 1;
						}
						else{
							//$data = array("message"=>"Incorrect Password.");
							return 2;
							//echo json_encode($data);
						}
					
					}
							
				}
				else{
					return 0;
				}

			}catch(exception $e){
				return $e;
			}

		}

		public function logout(){
			session_destroy();
			return 1;
		}

	}

?>