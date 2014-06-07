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
         * @return Array of events
         * @deprecated DONT use this function, always returns a Exception, because it is not neccessary to get all EventEntrys
         */
        public function getAll()  {
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
            $this->m_requestHandler->responseNotImplemented("Not Yet implemented");
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
            $this->m_requestHandler->responseNotImplemented("Not Yet implemented");
        }
        
        /**
         * RequestEventEntry::delete()
         * 
         * removes an evententry
         * 
         * @param mixed $id
         * @return void
         * @todo make a transaction to remove all belonging data for sure.
         */
        public function delete($id)  {
            $this->m_requestHandler->responseNotImplemented("Not Yet implemented");
        }
    }

?>