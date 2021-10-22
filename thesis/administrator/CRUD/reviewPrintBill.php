<?php
	
	class PrintBill{

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

		public function getBill($i_rid,$i_rev_id){

			try{

				$sname = NULL;
				$fname = NULL;
				$mi = NULL;
				$school = NULL;
				$school_type = 0;
				$sql = "SELECT `rev`.`ch_sname`,`rev`.`ch_fname`,`rev`.`ch_mi`,`sch`.`str_school_name`,`sch`.`i_school_type`
					FROM `reviewer` `rev` 
					LEFT JOIN `school` `sch` 
					ON `rev`.`i_sid`=`sch`.`i_sid`
					WHERE `rev`.`i_rev_id`=$i_rev_id";
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						$sname = utf8_encode($row["ch_sname"]);
						$fname = utf8_encode($row["ch_fname"]);
						$mi = utf8_encode($row["ch_mi"]);
						$school = utf8_encode($row["str_school_name"]);
						$school_type = $row["i_school_type"];
					}
				}

				$reviewTitle = NULL;
				$reviewFee_vsu = 0;
				$reviewFee_non_vsu = 0;
				$reviewFee = 0;
				$sql = "SELECT `rs`.`str_description`,`rs`.`f_reviewfee_vsu`,`rs`.`f_reviewfee_non_vsu` FROM `review_schedule` `rs` WHERE `i_rid`=$i_rid";
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						$reviewTitle = utf8_encode($row["str_description"]);
						$reviewFee_vsu = $row["f_reviewfee_vsu"];
						$reviewFee_non_vsu = $row["f_reviewfee_non_vsu"];
					}
				}

				$name = $sname . ", " . $fname . " " . $mi;
				$data = "<tr>";
				$data .= "<td>Review fee</td>";
				if($school_type == 0){
					$data .= "<td>" . number_format($reviewFee_non_vsu,2) . "</td>";
					$reviewFee = sprintf("%.2f",$reviewFee_non_vsu);
				}
				else{
					$data .= "<td>" . number_format($reviewFee_vsu,2) . "</td>";
					$reviewFee = sprintf("%.2f",$reviewFee_vsu);
				}
				$data .="</tr>";

				$amount_paid = 0;
				$sql = "SELECT SUM(`f_amount_paid`) AS `amount_paid`
					FROM `payment` WHERE `i_rid`=$i_rid AND `i_rev_id`=$i_rev_id";
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						$amount_paid = sprintf("%.2f",$row["amount_paid"]);
					}
				}

				$balance = $reviewFee - $amount_paid;

				$str_amount_paid = number_format($amount_paid,2);
				$str_reviewFee = number_format($reviewFee,2);
				$str_balance = number_format($balance,2);
				return array("name"=>$name,"school"=>$school,"reviewTitle"=>$reviewTitle,"data"=>$data,"amount_paid"=>$str_amount_paid,"reviewFee"=>$str_reviewFee,"balance"=>$str_balance);

			}catch(exception $e){
				return $e;
			}

		}
	}

?>