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
        var $m_SearchString;
        var $m_mysql;
        var $m_AcceptType;
        var $m_ContentType;
        var $m_RequestHeader;
        
        /**
         * RequestHandler::__construct()
         * Construct and Initializations
         */
        public function __construct()  {
            $request_parts = explode('/', $_GET['param']);
            $this->m_Entity = $request_parts[0];
            $this->m_Command = $_SERVER['REQUEST_METHOD'];
            // Accept header is case insensitive, and whitespace isn’t important
            $this->m_AcceptType = strtolower(str_replace(' ', '', $_SERVER['HTTP_ACCEPT']));
            $this->m_ContentType = strtolower($_SERVER['HTTP_CONTENT_TYPE']);
            if (strpos($this->m_ContentType,";"))  {    //Wenn ein charset dabei ist, dies weg schneiden.
                $temp = explode(";",$this->m_ContentType);
                $this->m_ContentType = $temp[0];
            }
            $this->m_RequestHeader = apache_request_headers();
            if (isset($request_parts[1]))  {
                if (is_numeric($request_parts[1]))  {
                    $this->m_ID = $request_parts[1];    
                }
                else  {
                    $this->m_SearchString = $request_parts[1];
                }
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
            $this->requireFile("requestMapping","IBaseRequest.php");
            switch (strtolower($this->m_Entity))  {
                
                Case "events":
                    $this->handleRequestMappingEntity("Event",$this->m_Command,$this->m_ID);
                    break;
                Case "evententries":
                    $this->handleRequestMappingEntity("EventEntry",$this->m_Command,$this->m_ID);
                    break;
                Case "eventcontributions":
                    $this->handleRequestMappingEntity("EventContribution",$this->m_Command,$this->m_ID);
                    break;
                Case "users":
                    $this->handleRequestMappingEntity("User",$this->m_Command,$this->m_ID);
                    break;
                default:
                    $this->responseNotFound("No such ressource.");    
            }
        }
        
        /**
         * RequestHandler::responseOK()
         * sends a 200 OK
         * @param mixed $strMessage
         * @return void
         */
        public function responseOK($strMessage)  {
            header("HTTP/1.1 200");
            echo $strMessage;
        }
        
        /**
         * RequestHandler::responseNoContent()
         * 
         * sends a 204 response to the requesting client
         * @param mixed $strErrorMessage
         * @return void
         */
        public function responseNoContent($strErrorMessage)  {
            header("HTTP/1.1 204");
            echo $strErrorMessage;
        }
        

        /**
         * RequestHandler::responseBadRequest()
         * 
         * sends a 400 response to the requesting client
         * @param mixed $strErrorMessage
         * @return void
         */
        public function responseBadRequest($strErrorMessage)  {
            header("HTTP/1.1 400");
            echo $strErrorMessage;
        }

        /**
         * RequestHandler::responseNotFound()
         * 
         * Sends a 404 response to the requesting client
         * @param mixed $strErrorMessage
         * @return void
         */
        public function responseNotFound($strErrorMessage)  {
            header("HTTP/1.1 404");
            echo $strErrorMessage;
        }
                
        /**
         * RequestHandler::responseNotAcceptable()
         * 
         * sending a 406 response to the requesting client.
         * @param mixed $strErrorMessage
         * @return void
         */
        public function responseNotAcceptable($strErrorMessage)  {
            header("HTTP/1.1 406");
            echo $strErrorMessage;
        }
        
        /**
         * RequestHandler::responsePreconditionFailes()
         *
         * sending 412
         *  
         * @param mixed $strErrorMessage
         * @return void
         */
        public function responsePreconditionFailes($strErrorMessage)  {
            header("HTTP/1.1 412");
            echo $strErrorMessage;
        }
        
        
        
        /**
         * RequestHandler::responseInternalServerError()
         * 
         * sending a 500 response to the requesting client.
         * @param mixed $strErrorMessage
         * @return void
         */
        public function responseInternalServerError($strErrorMessage)  {
            header("HTTP/1.1 500");
            echo $strErrorMessage;
        }
        
        /**
         * RequestHandler::responseNotImplemented()
         * 
         * sending 501
         * 
         * @param mixed $strErrorMessage
         * @return void
         */
        public function responseNotImplemented($strErrorMessage)  {
            header("HTTP/1.1 501");
            echo $strErrorMessage;
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
            $strPrefix = "Request";
            $strRequestMapper = $strPrefix.$strClassName;
            $this->requireFile($path,$strRequestMapper . ".php");
            $inputData = $this->handleInput($strClassName);
            $object = new $strRequestMapper($this);
            switch (strtolower($strCommand))  {
                case "get":
                    header("Content-type:application/json");    // Yes this ignores the Accept Header of the Request
                    if (strlen($strID) == 0)  {
                        $returnObject = $object->getAll($this->m_SearchString);
                    }
                    else  {
                        if ($strID == 0)  {
                            $returnObject = $object->getAll("");
                        } 
                        else {
                            $returnObject = $object->getSingle($strID);
                            if (isset($returnObject->stamp))  {                 //for collision detection
                                header("Etag: ".$returnObject->stamp);          //browser will send this as If-Match back
                            }
                        }    
                    }
                    break;
                case "put":
                    $returnObject = $object->create($inputData);
                    break;
                case "post":
                    if (is_numeric($strID) && $strID > 0)  {
                        $inputData->id = $strID;
                        $returnObject = $object->update($inputData);
                    }
                    else  {
                        $this->responseBadRequest("ID is invalid.");
                    }
                    break;
                case "delete":
                    if (is_numeric($strID) && $strID > 0)  {
                        $returnObject = $object->delete($strID);
                    }
                    else  {
                        $this->responseBadRequest("ID is invalid.");
                    }
                    break;
                default:
                    $this->responseNotFound();
                    break;
            }
            $this->getDatabase()->closeConnection();
            
            if (isset($returnObject))  {
                $this->handleOutput($returnObject);    
            }    
        }
        
        /**
         * RequestHandler::handleOutput()
         * 
         * @param mixed $returnObject
         * @return void
         */
        private function handleOutput($returnObject)  {
            switch ($this->m_AcceptType)  {
                case "application/json":
                    echo json_encode($returnObject);
                    break;
                case "application/xml":
                    ///TODO: implement XML serializer
                    break; 
                default:
                    echo json_encode($returnObject);
                    break;
            }
        }
        
        /**
         * RequestHandler::handleInput()
         * 
         * Converts the received data to a model filled via json, xml or POST
         * 
         * @param string modelname
         * @return filled model for the requested entity
         */
        private function handleInput($strClassName)  {
            $objReturn = new $strClassName;
            switch ($this->m_ContentType)  {
                case "application/json":
                    $requestBody = @file_get_contents('php://input');
                    $objReturn->parseJSON(json_decode($requestBody,true));      //not yet implemented
                    break;
                case "application/xml":
                    $objReturn->parseXML("");      //not yet implemented
                    break; 
                default:
                    $objReturn->parsePOST($_POST);
                    break;
            }
            //versioning
            if (isset($this->m_RequestHeader["If-Match"]))  {
                $objReturn->stamp = $this->m_RequestHeader["If-Match"];
            }
            return $objReturn;
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
    Error_Reporting(E_ALL);     //for developing purpose, remove when in production
    $requestHandler = new RequestHandler();
    $requestHandler->handleRequest();
?>