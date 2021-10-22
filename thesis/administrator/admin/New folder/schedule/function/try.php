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

		/*
		function get_holidays() 
		{
		    // arrays
		    $days_array = array();

		    // You have to put there your source of holidays and make them as array...
		    // For example, database in Codeigniter:
		    // $days_array = $this->my_model->get_holidays_array();

		    return $days_array;
		}

		function get_workdays($from,$to) 
		{
		    // arrays
		    $days_array = array();
		    $skipdays = array("");
		    $skipdates = $this->get_holidays();

		    // other variables
		    $i = 0;
		    $current = $from;

		    if($current == $to) // same dates
		    {
		        $timestamp = strtotime($from);
		        if (!in_array(date("l", $timestamp), $skipdays)&&!in_array(date("Y-m-d", $timestamp), $skipdates)) {
		            $days_array[] = date("Y-m-d",$timestamp);
		        }
		    }
		    elseif($current < $to) // different dates
		    {
		        while ($current < $to) {
		            $timestamp = strtotime($from." +".$i." day");
		            if (!in_array(date("l", $timestamp), $skipdays)&&!in_array(date("Y-m-d", $timestamp), $skipdates)) {
		                $days_array[] = date("Y-m-d",$timestamp);
		            }
		            $current = date("Y-m-d",$timestamp);
		            $i++;
		        }
		    }

		    return $days_array;
		}

		public function get_working_hours($array)
		{		
			//return $array["Title"];
			
		    // timestamps
		    $from_timestamp = strtotime($array["start"]);
		    $to_timestamp = strtotime($array["end"]);

		    // work day seconds
		    $workday_start_hour = 8;
		    $workday_end_hour = 17;
		    $workday_seconds = ($workday_end_hour - $workday_start_hour)*3600;

		    // work days beetwen dates, minus 1 day
		    $from_date = date('Y-m-d',$from_timestamp);
		    $to_date = date('Y-m-d',$to_timestamp);
		    $workdays_number = count($this->get_workdays($from_date,$to_date))-1;
		    $workdays_number = $workdays_number<0 ? 0 : $workdays_number;

		    // start and end time
		    $start_time_in_seconds = date("H",$from_timestamp)*3600+date("i",$from_timestamp)*60;
		    $end_time_in_seconds = date("H",$to_timestamp)*3600+date("i",$to_timestamp)*60;

		    // final calculations
		    $working_hours = ($workdays_number * $workday_seconds + $end_time_in_seconds - $start_time_in_seconds) / 86400 * 24;

		    return $working_hours;
		    
		}
		*/
		public function getHours($array){

			//$date_start = date("Y-m-d",strtotime($array["start"]));
			//$time_start = date("H:i:s",strtotime($array["start"]));
	
			//$date_end = date("Y-m-d",strtotime($array["end"]));
			//$time_end = date("H:i:s",strtotime($array["end"]));

			$hours = 0;
			$total_hours = 0;
			if($array["d_start"] == $array["d_end"]){
				$total_hours = round(abs(strtotime($array["t_end"]) - strtotime($array["t_start"]))/3600);
				echo "<br>Date: " . $array["d_start"] . "&nbsp&nbsp&nbspFrom: " . $array["t_start"] . "&nbsp&nbsp&nbspTo: " . $array["t_end"];
				echo "&nbsp&nbsp&nbsp Total Hours: " . $total_hours;
			}

			else{
				$open_time = "08:00:00";
				$close_time = "17:00:00";
				
				$temp_start = NULL;
				$temp_end = NULL;
				
				for($temp_date = $array["d_start"]; $temp_date <= $array["d_end"];){
					if($temp_date == $array["d_start"]){
						$temp_start = $array["t_start"];
						$temp_end = $close_time;
					}
					else if($temp_date > $array["d_start"] && $temp_date < $array["d_end"]){
						$temp_start = $open_time;
						$temp_end = $close_time;
					}
					else if($temp_date == $array["d_end"]){
						$temp_start = $open_time;
						$temp_end = $array["t_end"];
					}

					echo "<br>Date: " . $temp_date . " From: " . $temp_start . " To: " . $temp_end;
					$hours = round(abs(strtotime($temp_end) - strtotime($temp_start))/3600,2);
					$total_hours+=$hours;
					$temp_date = date("Y-m-d",strtotime("+1 day", strtotime($temp_date)));
					echo "&nbsp&nbsp&nbsp Number of hours: " . $hours . "&nbsp&nbsp&nbsp Total hours: " . $total_hours;
				}
			
			}
			return $total_hours;
			
		}

		public function getBill($total_hours){
			try{

			$sql = "";
			$result = $this->conn->query($sql);
			if($result->num_rows > 0){
				while ($row = $result->fetch_assoc()) {
					
				}
			}	

			}catch(exception $e){
				echo $e;
			}
		}

		public function getTime(){
			try{	

				$sql = "SELECT `str_title`,`str_requisitioner`, `d_start`,`t_start`,`d_end`,`t_end` FROM `function_reservation` WHERE `i_fr_id`=2";
				$array = NULL;
				$result = $this->conn->query($sql);
				if($result->num_rows > 0){
					while ($row = $result->fetch_assoc()) {
						
						$array= array("Title"=>$row["str_title"],"d_start"=>$row["d_start"],"t_start"=>$row["t_start"],"d_end"=>$row["d_end"],"t_end"=>$row["t_end"],"request"=>$row["str_requisitioner"]);
					}
				}
				echo "Description: " . $array["Title"] . "&nbsp&nbsp&nbsp Date start: " . $array["d_start"] . "&nbsp&nbsp&nbsp Date end: " . $array["d_end"];
				echo "<br>";
				$total_hours = $this->getHours($array);
				//echo "<br>" . $total_hours;

			}catch(exception $e){
				echo $e;
			}
		}

		
	}

	$crud = new CRUD();



	$crud->getTime();
	//$crud->get_working_hours();
?>