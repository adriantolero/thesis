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

		public function getRates(){

			try{

				$sql = "SELECT * FROM particulars";
				$result = $this->conn->query($sql);
				$data = NULL;
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						$data .= "<tr>";
						$data .= "<td><center>" . utf8_encode($row["enum_category"]) . "</center></td>";
						$data .= "<td><center>" . utf8_encode($row["str_description"]) . "</center></td>";
						$data .= "<td><center>" . utf8_encode($row["enum_aircon"]) . "</center></td>";
						$data .= "<td><center>" . number_format($row["f_first_hour"],2) . "</center></td>";
						$data .= "<td><center>" . number_format($row["f_succeeding_hour"],2) . "</center></td>";
						$data .= "<tr>";
					}
				}
				return $data;

			}catch(exception $e){
				return $e;
			}

		}

		public function getRateInfo($i_pid){

			try{

				$sql = "SELECT * FROM `particulars` WHERE `i_pid`=$i_pid";
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						return array("firstHour"=>$row["f_first_hour"],"succeedingHour"=>$row["f_succeeding_hour"]);
					}
				}

				$this->conn->close();

			}catch(exception $e){
				return $e;
			}	

		}

		public function updateRate($i_pid,$firstHour,$succeedingHour){

			try{

				$firstHour = sprintf("%.2f",$firstHour);
				$succeedingHour = sprintf("%.2f",$succeedingHour);

				$sql = "UPDATE `particulars` SET `f_first_hour`=$firstHour, `f_succeeding_hour`=$succeedingHour WHERE `i_pid`=$i_pid";
				if($this->conn->query($sql)){
					return "Successfully updated.";
				}
				else{
					return "Error: " . $sql . "<br>" . $this->conn->error;
				}
				//return $firstHour . $succeedingHour;

			}catch(exception $e){
				return $e;
			}

		}

	}

?>