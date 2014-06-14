<?php
    /**
     * RequestUser
     * 
     * Basic common user ressource. Currently only GET Methods are available
     * 
     * @package api   
     * @author Maik Godinho
     * @copyright 
     * @version 1.0.0
     * @access public
     * @todo Add POST, PUT and DELETE operations
     */
    class RequestUser implements IBaseRequest {
        
        var $m_requestHandler;
        
        /**
         * RequestUser::__construct()
         * 
         * @param basic requestHandler
         * @return void
         */
        public function __construct($requestHandler) {
            $this->m_requestHandler = $requestHandler;
        }
        
        /**
         * RequestUser::getAll()
         * 
         * returns every user 
         * 
         * @return array of all users
         */
        public function getAll()  {
            $this->m_requestHandler->responseNotImplemented("Please use the event ressource to find evententrys for a given event.");
        }
        
        /**
         * RequestUser::getSingle()
         * 
         * showing the details of a single User
         * 
         * @param string $strUserID
         * @return a instance of an single User, typeof model/User
         */
        public function getSingle($strUserID)  {
            $strSql = "Select * FROM user where id = '" . $strUserID . "'";
            $result = $this->m_requestHandler->getDatabase()->query($strSql);
            if ($this->m_requestHandler->getDatabase()->getNumRows($result) > 0)  {
                $row = $this->m_requestHandler->getDatabase()->fetch_object($result);
                return $row;
            }
            else  {
                $this->m_requestHandler->responseNoContent("There is no User with such an id.");
            }
        }
        
        /**
         * RequestUser::create()
         *
         * creates a new User
         *  
         * @param mixed $inputData
         * @return if successfull returns the inserted id
         */
        public function create($inputData)  {
            $this->m_requestHandler->responseNotImplemented("Not Yet implemented");
        }
        
        /**
         * RequestUser::update()
         * 
         * updates an User.
         * 
         * @param mixed $inputData
         * @return void
         * @todo Think about wether to delete all event, contributions or entrys?
         */
        public function update($inputData)  {
            $strSql = "DELETE FROM user WHERE id = '" . $id . "'";
            $result = $this->m_requestHandler->getDatabase()->query($strSql);
            if ($this->m_requestHandler->getDatabase()->getAffectedRows() != 1)  {
                $this->m_requestHandler->responseNotFound("The given user was not found and therefore could not be deleted.");
            }
            else  {
                $this->m_requestHandler->responseOK("User successfully deleted.");
            }
        }
        
        /**
         * RequestUser::delete()
         * 
         * removes a User
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