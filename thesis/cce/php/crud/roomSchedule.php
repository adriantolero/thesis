<?php
	
	class CRUD
	{
		
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


		public function getVaccant($array){

		}

		public function getSchedule($room,$search){

			try{

				$sql = "SELECT `d_start`,`t_start`,`d_end`,`t_end` FROM `function_reservation` WHERE `i_rm_id`=$room AND `d_start`='$search'";
				$data = NULL;
				$array = NULL;
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						$data .= "<tr><td><center>" . $row["t_start"] . "</center></td><td><center>" . $row["t_end"] . "</center></td></tr>";
						//$array = array("start"=>$row["t_start"],"end"=>$row["t_end"]);
					}
				}

				//$available = $this->getVaccant($array);

				return $data;
				//return $data;
				
			}catch(exception $e){
				return $e;
			}

		}


	}
?>