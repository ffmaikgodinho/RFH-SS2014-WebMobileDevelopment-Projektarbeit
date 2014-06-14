<?php
    /**
     * User
     * 
     * usual User model ;)
     * 
     * @package api
     * @author Maik Godinho
     * @copyright 2014
     * @access public
     */
    class User implements IBaseModel {
        
        public $id;
        public $name;
        public $email;
        public $passwort;
        public $isSuperAdmin;
        public $url;
        public $stamp;                      //ETAG
        
        public function parsePOST($post)  {
            
        }
        public function parseJSON($json)  {
            
        }
        public function parseXML($xml)  {
            
        }
    }
?>