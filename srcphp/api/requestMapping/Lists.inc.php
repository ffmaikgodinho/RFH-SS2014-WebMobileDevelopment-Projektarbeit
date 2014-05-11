<?php

    /**
     * Lists
     * 
     * @package api   
     * @author Maik Godinho
     * @copyright 
     * @version 1.0.0
     * @access public
     */
    class Lists {
        
        var $m_requestHandler;
        
        /**
         * Lists::handleRequest()
         * 
         * Handles the request for showing, updating and deleting List Entries.
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
                        $this->getLists();
                    } 
                    else {
                        $this->getList($strID);
                    }
                    break;
                default:
                    $requestHandler->responseNotFound();
            }
            $this->m_requestHandler->getDatabase()->closeConnection();
        }
        
        /**
         * Lists::getLists()
         * 
         * Shows all entries in a list and automatically echos them to the browser
         * 
         * @return void
         */
        public function getLists()  {
            $events = array();
            $strSql = "Select * FROM event";
            $result = $this->m_requestHandler->getDatabase()->query($strSql);
            if ($this->m_requestHandler->getDatabase()->getNumRows($result) > 0)  {
                while ($row = $this->m_requestHandler->getDatabase()->fetch_object($result))  {
                    $row->url ="/api/lists/".$row->id;
                    $events[] = $row;
                }
                echo json_encode($events);
            }
            else  {
                $this->m_requestHandler->responseNoContent();
            }
       }
        
        /**
         * Lists::getList()
         * 
         * showing the details of a single list entrie
         * 
         * @param string $strListID
         * @return void
         */
        public function getList($strListID)  {
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
        
    }

?>