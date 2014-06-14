<?php
    /**
     * RequestEventEntry
     * 
     * handling PUT, POSTS und DELETE Request of EventEntrys.
     * GET is implemented in the RequestEvent Ressource.
     * 
     * @package api   
     * @author Maik Godinho
     * @copyright 
     * @version 1.0.0
     * @access public
     */
    class RequestEventEntry implements IBaseRequest {
        
        var $m_requestHandler;
        
        /**
         * RequestEventEntry::__construct()
         * 
         * @param basic requestHandler
         * @return void
         */
        public function __construct($requestHandler) {
            $this->m_requestHandler = $requestHandler;
        }
        
        /**
         * RequestEventEntry::getAll()
         *
         * @param string if existing a search string 
         * @return null
         * @deprecated DONT use this function, always returns a Exception, because it is not neccessary to get all EventEntrys
         */
        public function getAll($searchString)  {
            $this->m_requestHandler->responseNotImplemented("Please use the event ressource to find evententrys for a given event.");
        }
        
        /**
         * RequestEventEntry::getSingle()
         * 
         * showing the details of a single EventEntry with the according contributions
         * 
         * @param string $strEventEntryID
         * @return a instance of an single EventEntry, typeof model/EventEntry
         */
        public function getSingle($strEventEntryID)  {
            $strSql = "Select * FROM entry where id = '" . $strEventEntryID . "'";
            $result = $this->m_requestHandler->getDatabase()->query($strSql);
            if ($this->m_requestHandler->getDatabase()->getNumRows($result) > 0)  {
                $row = $this->m_requestHandler->getDatabase()->fetch_object($result);
                //handle Contribution
                $row->contributions = array();
                $strSqlContribution = "Select * FROM contribution where entryid = '" . $strEventEntryID . "'";
                $resultContribution = $this->m_requestHandler->getDatabase()->query($strSqlContribution);
                while ($rowContribution = $this->m_requestHandler->getDatabase()->fetch_object($resultContribution))  {
                    $rowContribution->url = "/api/eventContributions/".$rowContribution->id;
                    $row->contributions[] = $rowContribution;
                }
                return $row;
            }
            else  {
                $this->m_requestHandler->responseNoContent("There is no event with such an id.");
            }
        }
        
        /**
         * RequestEventEntry::create()
         *
         * creates a new EventEntry
         *  
         * @param mixed $inputData
         * @return if successfull returns the inserted id
         */
        public function create($inputData)  {
            if ($this->checkData($inputData))  {
                $strSql =   "INSERT INTO `entry` (`eventid`, `title`, `note`, `total_qty`, `stamp`) ".
                        "VALUES ('".$inputData->eventid."', '".$inputData->title."', '".$inputData->note."', '".$inputData->totalQuantity."', '1');";
                $result = $this->m_requestHandler->getDatabase()->query($strSql);
                $lastid = $this->m_requestHandler->getDatabase()->getLastInsertID();
                if (is_int($lastid) && $lastid > 0)  {
                    return $lastid;
                }
                else  {
                    $this->m_requestHandler->responseInternalServerError("EventEntry could not be inserted.");
                }                
            }
            else {
                $this->m_requestHandler->responseBadRequest("Not all needed EventEntry information have been send.");
            }
        }
        
        /**
         * RequestEventEntry::update()
         * 
         * updates an evententry.
         * 
         * @param mixed $inputData
         * @return void
         */
        public function update($inputData)  {
            //check wethere the user gave us a correct version (the latest)
            $eventEntry = $this->getSingle(($inputData->id));
            if ($inputData->stamp == $eventEntry->stamp)  {
                $strSql = "UPDATE entry SET title = '".$inputData->title."',note = '".$inputData->note."',total_qty = '".$inputData->totalQuantity."', stamp = stamp + 1 WHERE id = '" . $inputData->id . "'";
                $result = $this->m_requestHandler->getDatabase()->query($strSql);
                if ($this->m_requestHandler->getDatabase()->getAffectedRows() != 1)  {
                    $this->m_requestHandler->responseNotFound("The given id was not found and therefore could not be updated..");
                }
                else  {
                    $this->m_requestHandler->responseOK("EventEntry successfully updated.");
                }                
            }
            else  {
                $this->m_requestHandler->responsePreconditionFailes("Given version is outdated.");
            }
        }
        
        /**
         * RequestEventEntry::delete()
         * 
         * removes an evententry
         * 
         * @param mixed $id
         * @return void
         */
        public function delete($id)  {
            $strSql = "DELETE FROM entry WHERE id = '" . $id . "'";
            $result = $this->m_requestHandler->getDatabase()->query($strSql);
            if ($this->m_requestHandler->getDatabase()->getAffectedRows() != 1)  {
                $this->m_requestHandler->responseNotFound("The given entry was not found and therefore could not be deleted.");
            }
            else  {
                $this->m_requestHandler->responseOK("Entry successfully deleted.");
            }
        }
        
        
        /**
         * RequestEventEntry::checkData()
         *
         * checks wethere the required fields are filled to insert data 
         *  
         * @param mixed $data
         * @return boolean | True if all nesseccessary data are filled
         */
        private function checkData($data)  {
            if (is_numeric($data->eventid))  {
                if (is_numeric($data->totalQuantity))  {
                    if (strlen($data->title) > 0)  {
                        return true;   
                    }
                }
            }
            return false;
        }
        
    }

?>