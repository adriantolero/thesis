<?php

	class DbConfig{    
	    private $host = 'localhost';
	    private $username = 'root';
	    private $password = '';
	    private $database = 'thesis';
	    
	    protected $conn;
	    
	    public function __construct(){
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
	}
?>