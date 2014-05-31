<?php
    /**
     * RequestEvent
     * 
     * @package api   
     * @author Maik Godinho
     * @copyright 
     * @version 1.0.0
     * @access public
     */
    class RequestEvent implements IBaseRequest {
        
        var $m_requestHandler;
        
        /**
         * Events::__construct()
         * 
         * @param basic requestHandler
         * @return void
         */
        public function __construct($requestHandler) {
            $this->m_requestHandler = $requestHandler;
        }
        
        /**
         * Events::getAll()
         * 
         * Shows all Events in a list and automatically echos them to the browser
         * 
         * @return Array of events
         */
        public function getAll()  {
            $events = array();
            $strSql = "Select * FROM event";
            $result = $this->m_requestHandler->getDatabase()->query($strSql);
            if ($this->m_requestHandler->getDatabase()->getNumRows($result) > 0)  {
                while ($row = $this->m_requestHandler->getDatabase()->fetch_object($result))  {
                    $row->url ="/api/Events/".$row->id;
                    $events[] = $row;
                }
                return $events;
            }
            else  {
                $this->m_requestHandler->responseNoContent("There are currently no events.");
            }
       }
        
        /**
         * Events::getSingle()
         * 
         * showing the details of a single Event entrie
         * 
         * @param string $strListID
         * @return a instance of an single Event, typeof model/Event
         */
        public function getSingle($strListID)  {
            $strSql = "Select * FROM event where id = '" . $strListID . "'";
            $result = $this->m_requestHandler->getDatabase()->query($strSql);
            if ($this->m_requestHandler->getDatabase()->getNumRows($result) > 0)  {
                $row = $this->m_requestHandler->getDatabase()->fetch_object($result);
                return $row;
            }
            else  {
                $this->m_requestHandler->responseNoContent("There is no event with such an id.");
            }
        }
        
        /**
         * RequestEvents::create()
         *
         * creates a new Event
         *  
         * @param mixed $inputData
         * @return if successfull returns the inserted id
         */
        public function create($inputData)  {
            if ($this->checkData($inputData))  {
                $strSql =   "INSERT INTO `event` (`add_date`, `date`, `location`, `description`, `type`) ".
                        "VALUES (CURRENT_TIMESTAMP, '".$inputData->date."', '".$inputData->location."', '".$inputData->description."', '".$inputData->type."');";
                $result = $this->m_requestHandler->getDatabase()->query($strSql);
                $lastid = $this->m_requestHandler->getDatabase()->getLastInsertID();
                if (is_int($lastid) && $lastid > 0)  {
                    return $lastid;
                }
                else  {
                    $this->m_requestHandler->responseInternalServerError("Event could not be inserted.");
                }                
            }
            else {
                $this->m_requestHandler->responseBadRequest("Not all needed event information have been send.");
            }
        }
        
        public function update($inputData)  {
            
        }
        
        public function delete($id)  {
            $strSql = "DELETE FROM event WHERE id = '" . $id . "'";
            $result = $this->m_requestHandler->getDatabase()->query($strSql);
            if ($this->m_requestHandler->getDatabase()->getAffectedRows() != 1)  {
                $this->m_requestHandler->responseNotFound("The given id was not found and therefore could not be deleted.");
            }
            else  {
                $this->m_requestHandler->responseOK("ID successfully deleted");
            }
        }
        
        /**
         * RequestEvent::checkData()
         *
         * checks wethere the required fields are filled to insert data 
         *  
         * @param mixed $data
         * @return boolean | True if all nesseccessary data are filled
         */
        private function checkData($data)  {
            if (is_numeric($data->type) AND $data->type >= 0 AND $data->type <= 999)  {
                if (strlen($data->location) > 0)  {
                    if (strlen($data->description) > 0)  {
                        return true;   
                    }
                }
            }
            return false;
        }
        
    }

?>