<?php
    /**
     * Events
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
                $this->m_requestHandler->responseNoContent();
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
                $this->m_requestHandler->responseNoContent();
            }
        }
        
        /**
         * RequestEvents::create()
         *
         * creates a new Event
         *  
         * @param mixed $inputData
         * @return void
         */
        public function create($inputData)  {
            $event = new Event();
            $event->parsePOST($_POST);
        }
        
        public function update($inputData)  {
            
        }
        
        public function delete($id)  {
            
        }
        
    }

?>