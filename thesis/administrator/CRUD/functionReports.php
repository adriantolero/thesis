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

		public function getReports(){

			try{

				$sql = "SELECT `fr`.`i_fr_id`,`fr`.`dt_checkin`,`fr`.`dt_checkout`,`fr`.`str_title`,`fr`.`str_nature`,`rm`.`str_rmName`,`fr`.`i_no_participants`,`fr`.`str_requisitioner`,`bill`.`i_b_ORnum`,`bill`.`f_amount`,`part`.`enum_aircon`,`part`.`f_first_hour`,`part`.`f_succeeding_hour`,`bill`.`i_bill_status`, (SELECT SUM(`f_amount`) FROM `bill_ameneties` WHERE `i_fr_id`=`fr`.`i_fr_id`) AS `amount`
					FROM `function_reservation` `fr` 
					INNER JOIN `room` `rm`
					ON `fr`.`i_rm_id`=`rm`.`i_rm_id`
					LEFT JOIN `billing` `bill`
					ON `fr`.`i_fr_id`=`bill`.`i_fr_id`
					LEFT JOIN `particulars` `part`
					ON `bill`.`i_pid`=`part`.`i_pid`
					WHERE `fr`.`i_fr_status`=5 ORDER BY `fr`.`dt_checkin` DESC";

				$array = [];
				$data = NULL;
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					$i = 0;
					while($row = $result->fetch_assoc()){
						$array[$i]["i_fr_id"] = $row["i_fr_id"];
						$array[$i]["checkin"] = date("F d, Y",strtotime($row["dt_checkin"]));
						$array[$i]["checkout"] = date("F d, Y",strtotime($row["dt_checkout"]));
						$array[$i]["hours"] = $this->getTotalHours($row["dt_checkin"],$row["dt_checkout"]);
						$array[$i]["title"] = $row["str_title"];
						$array[$i]["nature"] = $row["str_nature"];
						$array[$i]["room"] = $row["str_rmName"];
						$array[$i]["participants"] = $row["i_no_participants"];
						$array[$i]["requisitioner"] = $row["str_requisitioner"];
						$array[$i]["ORNum"] = $row["i_b_ORnum"];
						$array[$i]["pAmount"] = $row["f_amount"];
						$array[$i]["aircon"] = $row["enum_aircon"];
						$array[$i]["firstHour"] = $row["f_first_hour"];
						$array[$i]["succeedingHour"] = $row["f_succeeding_hour"];
						$array[$i]["billStatus"] = $row["i_bill_status"];
						$array[$i]["aAmount"] = $row["amount"];
						$i++;
					}

					for($i=0;$i<count($array);$i++){
						$data .= "<tr>";
						if(strtotime($array[$i]["checkin"]) == strtotime($array[$i]["checkout"])){
							$data .= "<td>" . $array[$i]["checkin"] . "</td>";
						}
						else{
							$data .= "<td>" . $array[$i]["checkin"] . " - " . $array[$i]["checkout"] . "</td>";
						}
						$data .= "<td>" . utf8_encode($array[$i]["title"]) . "</td>";
						$data .= "<td>" . utf8_encode($array[$i]["nature"]) . "</td>";
						$data .= "<td>" . utf8_encode($array[$i]["checkout"]) . "</td>";
						$data .= "<td>" . utf8_encode($array[$i]["room"]) . "</td>";
						/*$data .= "<td>" . $array[$i]["firstHour"] . " 1st hr.; " . $array[$i]["succeedingHour"] . "/hr succeeding hrs." . "</td>";*/
						if($array[$i]["aircon"] == "With Aircon"){
							$data .= "<td>" . "w/ AC" . "</td>";
						}
						else{
							$data .= "<td>" . "w/o AC" . "</td>";
						}
						
						$data .= "<td align='center'>" . $array[$i]["hours"] . "</td>";
						if($array[$i]["aAmount"] == NULL){
							$data .= "<td align='center'>" . "0" . "</td>";
						}
						else{
							$data .= "<td align='center'>" . number_format($array[$i]["aAmount"],2) . "</td>";
						}
						$total = $array[$i]["aAmount"] + $array[$i]["pAmount"];
						$data .= "<td align='center'>" . number_format($total,2) . "</td>";
						$data .= "<td align='center'>" . $array[$i]["participants"] . "</td>";
						$data .= "<td>" . utf8_encode($array[$i]["requisitioner"]) . "</td>";

						$data .= "</tr>";
					}
				}
				else{
					$data .= "<tr><td colspan='12'><center><h3 style='dispay:inline;'>No record</center></h3></td></tr>";
				}			

				return $data;
				
			}catch(exception $e){
				return $e;
			}

		}

		public function getTotalHours($checkin,$checkout){
			
			$d_start = date("Y-m-d",strtotime($checkin));
			$t_start = date("H:i:s",strtotime($checkin));
			
			$d_end = date("Y-m-d",strtotime($checkout));
			$t_end = date("H:i:s",strtotime($checkout));

			$open_time = "08:00:00";
			$close_time = "17:00:00";

			$hours = 0;
			$total_hours = 0;

			
			if($d_start == $d_end){


				if($t_start <= $close_time && $t_end >= $close_time){
					$total_hours = round(abs(strtotime($close_time) - strtotime($t_start))/3600);
					//$total_hours = 1;
				}

				else if($t_start <= $close_time && $t_end < $close_time){
					$total_hours = round(abs(strtotime($t_end) - strtotime($t_start))/3600);
					//$total_hours = 2;
				}
				
				//else if($)

				//ORIGINAL
				/*if($t_end >= $close_time){
					$total_hours = round(abs(strtotime($close_time) - strtotime($t_start))/3600);
				}
				else if($t_start > $close_time){
					$total_hours = 0;
				}
				//else if($)
				else{
					$total_hours = round(abs(strtotime($t_end) - strtotime($t_start))/3600);
				}*/
				//echo "<br>Date: " . $array["d_start"] . "&nbsp&nbsp&nbspFrom: " . $array["t_start"] . "&nbsp&nbsp&nbspTo: " . $array["t_end"];
				//echo "&nbsp&nbsp&nbsp Total Hours: " . $total_hours;
			}

			else{
				
				
				$temp_start = NULL;
				$temp_end = NULL;
				
				for($temp_date = $d_start; $temp_date <= $d_end;){
					if($temp_date == $d_start){

						//ORIGINAL
						if($t_start < $close_time){ //16:30 < 17:00:00
							$temp_start = $t_start;//8:03
							$temp_end = $close_time;//17:00
							$hours = round(abs(strtotime($temp_end) - strtotime($temp_start))/3600);
							//$hours = round(abs(strtotime($temp_end) - strtotime($temp_start))/3600,2);
							$total_hours+=$hours;
						}
						
					}
					
					else if($temp_date > $d_start && $temp_date < $d_end){
						$temp_start = $open_time;
						$temp_end = $close_time;
						$hours = round(abs(strtotime($temp_end) - strtotime($temp_start))/3600);
						//$hours = round(abs(strtotime($temp_end) - strtotime($temp_start))/3600,2);
						$total_hours+=$hours;
					}

					else if($temp_date == $d_end){

						if($t_end < $open_time){ //02:30 < 8:00:00

						}

						else if($t_end >= $open_time && $t_end <= $close_time){ // 02:00
							$temp_start = $open_time;
							$temp_end = $t_end;
							$hours = round(abs(strtotime($temp_end) - strtotime($temp_start))/3600);
							//$hours = round(abs(strtotime($temp_end) - strtotime($temp_start))/3600,2);
							$total_hours+=$hours;
						}

						else{
							$temp_start = $open_time;
							$temp_end = $close_time;
							$hours = round(abs(strtotime($temp_end) - strtotime($temp_start))/3600);
							//$hours = round(abs(strtotime($temp_end) - strtotime($temp_start))/3600,2);
							$total_hours+=$hours;
						}
						
						/*if($t_end >= $close_time){ //if 02:05am >= 17:00:00
							$temp_start = $open_time;
							$temp_end = $close_time;
						}
						
						else{
							if($t_end < $open_time){ //

							}
							else{
								$temp_start = $open_time;
								$temp_end = $t_end;
							}
						}*/
						
					}

					$temp_date = date("Y-m-d",strtotime("+1 day", strtotime($temp_date)));
	
					//return $total_hours;
				}
			
			}
			return $total_hours;

		}

		/*
		public function getTotalHours($checkin,$checkout){

			$d_start = date("Y-m-d",strtotime($checkin));
			$t_start = date("H:i:s",strtotime($checkin));
			
			$d_end = date("Y-m-d",strtotime($checkout));
			$t_end = date("H:i:s",strtotime($checkout));

			$open_time = "08:00:00";
			$close_time = "17:00:00";

			$hours = 0;
			$total_hours = 0;

			
			if($d_start == $d_end){
				if($t_end >= $close_time){
					$total_hours = round(abs(strtotime($close_time) - strtotime($t_start))/3600);
				}
				else{
					$total_hours = round(abs(strtotime($t_end) - strtotime($t_start))/3600);
				}
				
			}

			else{
				
				
				$temp_start = NULL;
				$temp_end = NULL;
				
				for($temp_date = $d_start; $temp_date <= $d_end;){
					if($temp_date == $d_start){

						//ORIGINAL
						if($t_start < $close_time){ //16:30 < 17:00:00
							$temp_start = $t_start;//8:03
							$temp_end = $close_time;//17:00
							$hours = round(abs(strtotime($temp_end) - strtotime($temp_start))/3600);
							//$hours = round(abs(strtotime($temp_end) - strtotime($temp_start))/3600,2);
							$total_hours+=$hours;
						}
						
					}
					
					else if($temp_date > $d_start && $temp_date < $d_end){
						$temp_start = $open_time;
						$temp_end = $close_time;
						$hours = round(abs(strtotime($temp_end) - strtotime($temp_start))/3600);
						//$hours = round(abs(strtotime($temp_end) - strtotime($temp_start))/3600,2);
						$total_hours+=$hours;
					}

					else if($temp_date == $d_end){

						if($t_end < $open_time){ //02:30 < 8:00:00

						}

						else if($t_end >= $open_time && $t_end <= $close_time){ // 02:00
							$temp_start = $open_time;
							$temp_end = $t_end;
							$hours = round(abs(strtotime($temp_end) - strtotime($temp_start))/3600);
							//$hours = round(abs(strtotime($temp_end) - strtotime($temp_start))/3600,2);
							$total_hours+=$hours;
						}

						else{
							$temp_start = $open_time;
							$temp_end = $close_time;
							$hours = round(abs(strtotime($temp_end) - strtotime($temp_start))/3600);
							//$hours = round(abs(strtotime($temp_end) - strtotime($temp_start))/3600,2);
							$total_hours+=$hours;
						}
						
						
						
					}

					$temp_date = date("Y-m-d",strtotime("+1 day", strtotime($temp_date)));
	
					//return $total_hours;
				}
			
			}
			return $total_hours;

		}*/
	}
?>