<?php
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
         * Construct and Initializations
         */
        public function __construct()  {
            $request_parts = explode('/', $_GET['param']);
            $this->m_Entity = $request_parts[0];
            $this->m_Command = $_SERVER['REQUEST_METHOD'];
            if (isset($request_parts[1]))  {
                $this->m_ID = $request_parts[1];
            }
            $this->requireSettings();
            $this->requireUtils();
            $this->requireModels();
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
            header("Content-type:application/json");    // Yes this ignores the Accept Header of the Request
            
            $this->requireFile("requestMapping","IBaseRequest.php");
            switch (strtolower($this->m_Entity))  {
                
                Case "events":
                    $this->handleRequestMappingEntity("Events",$this->m_Command,$this->m_ID);
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
        
        /**
         * RequestHandler::responseNoContent()
         * 
         * sends a 204 response to the requesting client
         */
        public function responseNoContent()  {
            header("HTTP/1.1 204");
        }
        
        /**
         * RequestHandler::getDatabase()
         * 
         * returns the represantation of the databse 
         */
        public function getDatabase()  {
            return $this->m_mysql;
        }
        
        /**
         * RequestHandler::initDatabase()
         * 
         * initialize the Database
         * 
         * @return void
         */
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
                return @mysql_real_escape_string(urlencode($_GET[$strName]));    
            }
        }
        
        /**
         * RequestHandler::requireSettings()
         * 
         * Calls the needed methods to load all setting files 
         * 
         * @return void
         */
        private function requireSettings()  {
            $this->requireFile("","Settings.php");
        }
        
        /**
         * RequestHandler::requireUtils()
         * 
         * load all Utils
         * 
         * @return void
         * @see IOUtil
         */
        private function requireUtils()  {
            $this->requireFile("util","IOUtil.php");
        }
        
        /**
         * RequestHandler::requireModels()
         *
         * load all necessary Claesses
         *  
         * @return void
         */
        private function requireModels()  {
            $this->requireFile("model","IBaseModel.php");
            
            $this->requireFile("model","Event.php");
            $this->requireFile("model","EventEntry.php");
            $this->requireFile("model","EventContribution.php");
            $this->requireFile("model","User.php");
        }
        
        /**
         * RequestHandler::handleRequestMappingEntity()
         * 
         * basic method to load a request handler for a special entity.
         * All handler have to be in the "requestMapping" folder.
         * 
         * @param string $strClassName
         * @param string $strCommand
         * @param string $strID
         * @return void
         */
        private function handleRequestMappingEntity($strClassName,$strCommand, $strID)  {
            $path = "requestMapping";
            $this->requireFile($path,$strClassName . ".php");
            $object = new $strClassName;
            $object->handleRequest($this,$strCommand,$strID);    
        }
        
        /**
         * RequestHandler::requireFile()
         * 
         * Loads a php file using the require_once method
         * throws an exception if file do not exist.
         * 
         * @param string $strPath
         * @param string $strFile
         * @return void
         */
        private function requireFile($strPath,$strFile)   {
            $strNewPath = $strPath . DIRECTORY_SEPARATOR . $strFile;
            require_once($strNewPath);
        }
    }
    Error_Reporting(E_ALL);
    $requestHandler = new RequestHandler();
    $requestHandler->handleRequest();
?>