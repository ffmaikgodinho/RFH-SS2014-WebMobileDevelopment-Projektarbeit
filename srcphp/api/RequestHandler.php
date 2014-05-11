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
        
        /**
         * RequestHandler::__construct()
         */
        public function __construct()  {
            $this->m_Entity = $this->getURLParam("entity");
            $this->m_Command = $this->getURLParam("command");
            $this->m_ID = $this->getURLParam("id");
            $this->requireUtils(); 
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
            switch (strtolower($this->m_Entity))  {
                
                Case "lists":
                    $this->handleRequestMappingEntity("Lists");
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
        
        private function requireUtils()  {
            $this->requireFile("util","IOUtil.inc.php");
        }
        
        private function handleRequestMappingEntity($strClassName)  {
            $path = "requestMapping";
            $this->requireFile($path,$strClassName . ".inc.php");
            $object = new $strClassName;
            $object->init($this);    
        }
        
        private function requireFile($strPath,$strFile)   {
            $strNewPath = $strPath . DIRECTORY_SEPARATOR . $strFile;
            require_once($strNewPath);
        }
    }
    
    $requestHandler = new RequestHandler();
    $requestHandler->handleRequest();
?>