<?php
namespace api;
class MySQL {
	var $hostname;          // MySQL Hostname
	var $username;          // MySQL Username
	var $password;          // MySQL Password
	var $database;          // MySQL Database
	
	var $databaseLink;      // Database Connection Link
    
    var $lastError;          // Last MySql Error
	
	function __construct($database, $username, $password, $hostname='localhost', $port=3306){
		$this->database = $database;
		$this->username = $username;
		$this->password = $password;
		$this->hostname = $hostname.':'.$port;
		
		$this->Connect();
	}

	private function Connect(){
		$this->CloseConnection();
		
        $this->databaseLink = mysqli_connect($this->hostname, $this->username, $this->password);
	
		if(!$this->databaseLink){
            $this->lastError = 'Could not connect to server: ' . mysqli_error($this->databaseLink);
            return false;
		}
		
		if(!$this->UseDB()){
			$this->lastError = 'Could not connect to database: ' . mysqli_error($this->databaseLink);
			return false;
		}
        $this->databaseLink->set_charset("utf8");
		return true;
	}
	
	
	// Select database to use
	private function UseDB(){
		if(!mysqli_select_db($this->databaseLink,$this->database)){
			$this->lastError = 'Cannot select database: ' . mysql_error($this->databaseLink);
			return false;
		}else{
			return true;
		}
	}
	
    // Closes the connections
    public function closeConnection(){
        if($this->databaseLink){
            mysqli_close($this->databaseLink);
        }
    }
    public function query($strSQLQuery)  {
        return mysqli_query($this->databaseLink,$strSQLQuery);
    }
    
    public function fetch_object($result)  {
        return mysqli_fetch_object($result);
    }
    
    public function getNumRows($result)  {
        return mysqli_num_rows($result);
    }
}
?>