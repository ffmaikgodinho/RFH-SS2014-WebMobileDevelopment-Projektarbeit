<?php
/**
 * MySQL
 * 
 * class representing the mysql database and provide basic methods to interact with it
 * like connect, disconnect, query e.g.
 * 
 * @package api   
 * @author Maik Godinho
 * @copyright 
 * @version 1.0.0
 * @access public
 */
class MySQL {
	var $hostname;          // MySQL Hostname
	var $username;          // MySQL Username
	var $password;          // MySQL Password
	var $database;          // MySQL Database
	
	var $databaseLink;      // Database Connection Link
    
    var $lastError;          // Last MySql Error
	
	/**
	 * MySQL::__construct()
	 * 
     * Constructor will automaticly establish a connection to the database 
     * 
	 * @param string $databasename
	 * @param string $username
	 * @param string $password
	 * @param string $hostname, default is localhos
	 * @param integer $port, default is 3306
	 * @return
	 */
	function __construct($database, $username, $password, $hostname='localhost', $port=3306){
		$this->database = $database;
		$this->username = $username;
		$this->password = $password;
		$this->hostname = $hostname.':'.$port;
		
		$this->Connect();
	}

	/**
	 * MySQL::Connect()
	 * 
     * Open a new connection to the databse
     * 
	 * @return
	 */
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
	/**
	 * MySQL::UseDB()
	 * 
	 * @return successState of databse changing
	 */
	private function UseDB(){
		if(!mysqli_select_db($this->databaseLink,$this->database)){
			$this->lastError = 'Cannot select database: ' . mysql_error($this->databaseLink);
			return false;
		}else{
			return true;
		}
	}
	
    // Closes the connections
    /**
     * MySQL::closeConnection()
     * 
     * @return
     */
    public function closeConnection(){
        if($this->databaseLink){
            mysqli_close($this->databaseLink);
        }
    }
    /**
     * MySQL::query()
     * 
     * @param string $strSQLQuery
     * @return MySqlI Query Resultset
     */
    public function query($strSQLQuery)  {
        return mysqli_query($this->databaseLink,$strSQLQuery);
    }
    
    /**
     * MySQL::fetch_object()
     * 
     * Just a Wrapper for mysqli_fetch_object
     * 
     * @param mixed $result
     * @return
     */
    public function fetch_object($result)  {
        return mysqli_fetch_object($result);
    }
    
    /**
     * MySQL::getNumRows()
     *
     * * Just a Wrapper for mysqli_num_rows
     *  
     * @param mixed $result
     * @return
     */
    public function getNumRows($result)  {
        return mysqli_num_rows($result);
    }
}
?>