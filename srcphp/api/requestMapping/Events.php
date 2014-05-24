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
    class Events implements IBaseRequest {
        
        var $m_requestHandler;
        
        /**
         * Events::handleRequest()
         * 
         * Handles the request for showing, updating and deleting Event Entries.
         * 
         * @param RequestHandler $requestHandler
         * @param string $strCommand
         * @param string $strID
         * @return
         */
        public function handleRequest($requestHandler,$strCommand,$strID)  {
            $this->m_requestHandler = $requestHandler;
            switch (strtolower($strCommand))  {
                case "get":
                    if ($strID == 0)  {
                        $this->getAll();
                    } 
                    else {
                        $this->getSingle($strID);
                    }
                    break;
                case "put":
                    $this->createList();
                case "post":
                    if (is_numeric($strID) && $strID > 0)  {
                        $this->updateList($strID);
                    }
                default:
                    $requestHandler->responseNotFound();
            }
            $this->m_requestHandler->getDatabase()->closeConnection();
        }
        
        /**
         * Events::getAll()
         * 
         * Shows all Events in a list and automatically echos them to the browser
         * 
         * @return void
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
                echo json_encode($events);
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
         * @return void
         */
        public function getSingle($strListID)  {
            $strSql = "Select * FROM event where id = '" . $strListID . "'";
            $result = $this->m_requestHandler->getDatabase()->query($strSql);
            if ($this->m_requestHandler->getDatabase()->getNumRows($result) > 0)  {
                $row = $this->m_requestHandler->getDatabase()->fetch_object($result);
                echo json_encode($row);
            }
            else  {
                $this->m_requestHandler->responseNoContent();
            }
        }
        
        
        /**
         * Events::create()
         * 
         * create a Event Item 
         * 
         * @return void
         */
        public function create()  {
            
        }
        
        public function update($strListID)  {
            
        }
        
        public function delete($id)  {
            
        }
        
    }

?>