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
         * @param string if existing a search string
         * @return array of all users
         */
        public function getAll($searchString)  {
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
         * @todo Insert md5 decryption of password and salting
         */
        public function create($inputData)  {
            if ($this->checkData($inputData))  {
                $strSql =   "INSERT INTO `user` (`name`, `email`, `passwort`, `sa`, `stamp`) ".
                        "VALUES ('".$inputData->name."', '".$inputData->email."', '".$inputData->passwort."', '0', '1');";
                $result = $this->m_requestHandler->getDatabase()->query($strSql);
                $lastid = $this->m_requestHandler->getDatabase()->getLastInsertID();
                if (is_int($lastid) && $lastid > 0)  {
                    return $lastid;
                }
                else  {
                    $this->m_requestHandler->responseInternalServerError("User could not be inserted.");
                }                
            }
            else {
                $this->m_requestHandler->responseBadRequest("Not all needed user information have been send.");
            }
        }
        
        /**
         * RequestUser::update()
         * 
         * updates an User.
         * 
         * @param mixed $inputData
         * @return void
         * @todo Think about wether to delete all event, contributions or entrys?
         * @todo add md5 decryption of password and add some salt
         */
        public function update($inputData)  {
            //check wethere the user gave us a correct version (the latest)
            $user = $this->getSingle(($inputData->id));
            if ($inputData->stamp == $user->stamp)  {
                $strSql = "UPDATE user SET name= '".$inputData->name."',email = '".$inputData->email."',passwort = '".$inputData->passwort."', stamp = stamp + 1 WHERE id = '" . $inputData->id . "'";
                $result = $this->m_requestHandler->getDatabase()->query($strSql);
                if ($this->m_requestHandler->getDatabase()->getAffectedRows() != 1)  {
                    $this->m_requestHandler->responseInternalServerError("The given id was not found and therefore could not be updated..");
                }
                else  {
                    $this->m_requestHandler->responseOK("User successfully updated.");
                }                
            }
            else  {
                $this->m_requestHandler->responsePreconditionFailes("Given version is outdated.");
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
            $strSql = "DELETE FROM user WHERE id = '" . $id . "'";
            $result = $this->m_requestHandler->getDatabase()->query($strSql);
            if ($this->m_requestHandler->getDatabase()->getAffectedRows() != 1)  {
                $this->m_requestHandler->responseNoContent("The given user was not found and therefore could not be deleted.");
            }
            else  {
                $this->m_requestHandler->responseOK("User successfully deleted.");
            }
        }
        
        
        /**
         * RequestUser::checkData()
         *
         * checks wethere the required fields are filled to insert data 
         *  
         * @param mixed $data
         * @return boolean | True if all nesseccessary data are filled
         */
        private function checkData($data)  {
            if (strlen($data->name) > 0)  {
                if (strlen($data->email) > 0)  {
                    if (strlen($data->passwort) > 0)  {
                        return true;   
                    }
                }
            }
            return false;
        }
    }

?>