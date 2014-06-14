<?php
    /**
     * RequestEventContribution
     * 
     * handling PUT, POSTS und DELETE Request of Contributions to an requestevententry.
     * GET is implemented in the RequestEventEntry Ressource.
     * 
     * @package api   
     * @author Maik Godinho
     * @copyright 
     * @version 1.0.0
     * @access public
     */
    class RequestEventContribution implements IBaseRequest {
        
        var $m_requestHandler;
        
        /**
         * RequestEventContribution::__construct()
         * 
         * @param basic requestHandler
         * @return void
         */
        public function __construct($requestHandler) {
            $this->m_requestHandler = $requestHandler;
        }
        
        /**
         * RequestEventContribution::getAll()
         * 
         * @return null
         * @deprecated DONT use this function, always returns a Exception, because it is not neccessary to get all Contributions
         */
        public function getAll()  {
            $this->m_requestHandler->responseNotImplemented("Please use the event ressource to find evententrys for a given event.");
        }
        
        /**
         * RequestEventContribution::getSingle()
         * 
         * showing the details of a single EventContribution
         * 
         * @param string $strContributionID
         * @return a instance of an single EventContribution, typeof model/EventContribution
         */
        public function getSingle($strContributionID)  {
            $strSql = "Select * FROM contribution where id = '" . $strContributionID . "'";
            $result = $this->m_requestHandler->getDatabase()->query($strSql);
            if ($this->m_requestHandler->getDatabase()->getNumRows($result) > 0)  {
                $row = $this->m_requestHandler->getDatabase()->fetch_object($result);
                return $row;
            }
            else  {
                $this->m_requestHandler->responseNoContent("There is no Contribution with such an id.");
            }
        }
        
        /**
         * RequestEventContribution::create()
         *
         * creates a new Contribution
         *  
         * @param mixed $inputData
         * @return if successfull returns the inserted id
         */
        public function create($inputData)  {
            $this->m_requestHandler->responseNotImplemented("Not Yet implemented");
        }
        
        /**
         * RequestEventContribution::update()
         * 
         * updates an Contribution.
         * 
         * @param mixed $inputData
         * @return void
         */
        public function update($inputData)  {
            $this->m_requestHandler->responseNotImplemented("Not Yet implemented");
        }
        
        /**
         * RequestEventContribution::delete()
         * 
         * removes an Contribution
         * 
         * @param mixed $id
         * @return void
         */
        public function delete($id)  {
            $strSql = "DELETE FROM contribution WHERE id = '" . $id . "'";
            $result = $this->m_requestHandler->getDatabase()->query($strSql);
            if ($this->m_requestHandler->getDatabase()->getAffectedRows() != 1)  {
                $this->m_requestHandler->responseNotFound("The given contribution was not found and therefore could not be deleted.");
            }
            else  {
                $this->m_requestHandler->responseOK("Contribution successfully deleted.");
            }
        }
    }

?>