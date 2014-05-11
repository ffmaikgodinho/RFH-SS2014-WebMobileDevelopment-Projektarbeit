<?php

    class Lists {
        
        var $m_requestHandler;
        
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
        
        public function getLists()  {
            $events = array();
            $strSql = "Select * FROM event";
            $result = $this->m_requestHandler->getDatabase()->query($strSql);
            if ($this->m_requestHandler->getDatabase()->getNumRows($result) > 0)  {
                while ($row = $this->m_requestHandler->getDatabase()->fetch_object($result))  {
                    $events[] = $row;
                }
                echo json_encode($events);
            }
            else  {
                $this->m_requestHandler->responseNoContent();
            }
       }
        
        public function getList($strListID)  {
            
        }
        
    }

?>