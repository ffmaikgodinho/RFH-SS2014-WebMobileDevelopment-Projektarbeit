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
         * RequestEvent::__construct()
         * 
         * @param basic requestHandler
         * @return void
         */
        public function __construct($requestHandler) {
            $this->m_requestHandler = $requestHandler;
        }
        
        /**
         * RequestEvent::getAll()
         * 
         * Shows all Events in a list and automatically echos them to the browser
         * 
         * @param string if existing a search string
         * @return Array of events
         */
        public function getAll($searchString)  {
            $events = array();
            
            //Search handling
            $searchQuery = "";
            if (strlen($searchString) > 0)  {
                $searchQuery = " WHERE event.title LIKE '%".$searchString."%' OR event.location LIKE '%".$searchString."%' OR event.description LIKE '%".$searchString."%'";   
            }
            
            $strSql = "Select SQL_CALC_FOUND_ROWS * FROM event".$searchQuery;
            $strSql .= $this->m_requestHandler->getDirtyPagingString();
            //echo $strSql;
            $result = $this->m_requestHandler->getDatabase()->query($strSql);
            
            if ($this->m_requestHandler->getDatabase()->getNumRows($result) > 0)  {
                while ($row = $this->m_requestHandler->getDatabase()->fetch_object($result))  {
                    $row->url ="/api/events/".$row->id;     
                    $events[] = $row;
                }
                return $events;
            }
            else  {
                $this->m_requestHandler->responseNoContent("There are currently no events.");
            }
       }
        
        /**
         * RequestEvent::getSingle()
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
                //handle eventEntries
                $row->entrys = array();
                $strSqlEntrys = "Select * FROM entry where eventid = '" . $strListID . "'";
                $resultEntrys = $this->m_requestHandler->getDatabase()->query($strSqlEntrys);
                while ($rowEntry = $this->m_requestHandler->getDatabase()->fetch_object($resultEntrys))  {
                    $rowEntry->url = "/api/eventEntries/".$rowEntry->id;
                    $row->entrys[] = $rowEntry;
                }
                return $row;
            }
            else  {
                $this->m_requestHandler->responseNoContent("There is no event with such an id.");
            }
        }
        
        /**
         * RequestEvent::create()
         *
         * creates a new Event
         *  
         * @param mixed $inputData
         * @return if successfull returns the inserted id
         */
        public function create($inputData)  {
            if ($this->checkData($inputData))  {
                $strSql =   "INSERT INTO `event` (`add_date`, `date`, `title`, `location`, `description`, `type`) ".
                        "VALUES (CURRENT_TIMESTAMP, '".date("Y-m-d H:i:s",$inputData->date->getTimestamp())."', '".$inputData->title."', '".$inputData->location."', '".$inputData->description."', '".$inputData->type."');";
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
        
        /**
         * RequestEvent::update()
         * 
         * updates an event.
         * 
         * @param mixed $inputData
         * @return void
         */
        public function update($inputData)  {
            //check wethere the user gave us a correct version (the latest)
            $event = $this->getSingle(($inputData->id));
            if (!is_null($event))  {
                if ($inputData->stamp == $event->stamp)  {
                    $strSql = "UPDATE event SET title = '".$inputData->title."',description = '".$inputData->description."',location = '".$inputData->location."',date = '".date("Y-m-d H:i:s",$inputData->date->getTimestamp())."',type = '".$inputData->type."', stamp = stamp + 1 WHERE id = '" . $inputData->id . "'";
                    $result = $this->m_requestHandler->getDatabase()->query($strSql);
                    if ($this->m_requestHandler->getDatabase()->getAffectedRows() != 1)  {
                        $this->m_requestHandler->responseNotFound("The given id was not found and therefore could not be updated..");
                    }
                    else  {
                        $this->m_requestHandler->responseOK("Event successfully updated.");
                    }                
                }
                else  {
                    $this->m_requestHandler->responsePreconditionFailes("Given version is outdated.");
                }
            }
            else  {
                $this->m_requestHandler->responseNotFound("");
            }
        }
        
        /**
         * RequestEvent::delete()
         * 
         * removes an event
         * 
         * @param mixed $id
         * @return void
         * @todo make a transaction to remove all belonging data for sure.
         */
        public function delete($id)  {
            $strSql = "DELETE FROM entry WHERE eventid = '" . $id . "'";
            $result = $this->m_requestHandler->getDatabase()->query($strSql);
            $strSql = "DELETE FROM event WHERE id = '" . $id . "'";
            $result = $this->m_requestHandler->getDatabase()->query($strSql);
            if ($this->m_requestHandler->getDatabase()->getAffectedRows() != 1)  {
                $this->m_requestHandler->responseNotFound("The given event was not found and therefore could not be deleted.");
            }
            else  {
                $this->m_requestHandler->responseOK("Event successfully deleted.");
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
                    if (isset($data->date))  {
                        return true;   
                    }
                }
            }
            return false;
        }
        
    }

?>