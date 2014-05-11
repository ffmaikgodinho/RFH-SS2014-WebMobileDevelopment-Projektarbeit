<?php
namespace api;
    /**
     * RequestHandler
     *
     * This class is responsible to handle all request coming via http(s)
     * and forward it to the needed request handler defined in requestMapping/{EntityName}.
     * This has the advantage to seperate handling of entities. 
     * 
     * @package api
     * @author Maik Godinho
     * @version 1.0.0
     */
    class RequestHandler  {
        
        var $m_Entity;
        var $m_Command;
        var $m_ID;
        var $m_mysql;
        
        /**
         * RequestHandler::__construct()
         */
        public function __construct()  {
            $this->m_Entity = $this->getURLParam("entity");
            $this->m_Command = $this->getURLParam("command");
            $this->m_ID = $this->getURLParam("id");
            $this->requireSettings();
            $this->requireUtils();
            $this->initDatabase(); 
        }
        
        /**
         * RequestHandler::__destruct() 
         */
        public function __destruct()  {
            $this->m_Entity = null;
            $this->m_Command = null;
            $this->m_ID = null;
        }
        
        /**
         * RequestHandler::handleRequest()
         * 
         * handles all incoming request 
         */
        public function handleRequest()  {
            header("Content-type:application/json");
            switch (strtolower($this->m_Entity))  {
                
                Case "lists":
                    $this->handleRequestMappingEntity("Lists",$this->m_Command,$this->m_ID);
                    break;   
                default:
                    $this->responseNotFound();    
            }
        }
        
        /**
         * RequestHandler::responseNotFound()
         * 
         * Sends a 404 response to the requesting client
         */
        public function responseNotFound()  {
            header("HTTP/1.1 404");
        }
        
        public function responseNoContent()  {
            header("HTTP/1.1 204");
        }
        
        public function getDatabase()  {
            return $this->m_mysql;
        }
        
        public function initDatabase()  {
            $this->requireFile("","MySql.php");
            $this->m_mysql = new MySQL(Settings::DB_Name,Settings::DB_Username,Settings::DB_Password,Settings::DB_Server,Settings::DB_Port);
        }
        
        /**
         * RequestHandler::getURLParam()
         * 
         * @param string $strName
         * @return escaped GET parameter
         */
        private function getURLParam($strName)  {
            if (isset($_GET[$strName]))  {
                return mysql_real_escape_string(urlencode($_GET[$strName]));    
            }
        }
        
        private function requireSettings()  {
            $this->requireFile("","Settings.php");
        }
        
        private function requireUtils()  {
            $this->requireFile("util","IOUtil.inc.php");
        }
        
        private function handleRequestMappingEntity($strClassName,$strCommand, $strID)  {
            $path = "requestMapping";
            $this->requireFile($path,$strClassName . ".inc.php");
            $object = new $strClassName;
            $object->handleRequest($this,$strCommand,$strID);    
        }
        
        private function requireFile($strPath,$strFile)   {
            $strNewPath = $strPath . DIRECTORY_SEPARATOR . $strFile;
            require_once($strNewPath);
        }
    }
    
    $requestHandler = new RequestHandler();
    $requestHandler->handleRequest();
?>