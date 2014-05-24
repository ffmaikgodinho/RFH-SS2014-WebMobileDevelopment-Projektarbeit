<?php
    /**
     * Event
     * 
     * represents a created event with linked EventEntrys
     * represents the sql table "event"
     * 
     * @package 
     * @author Maik Godinho
     * @copyright 2014
     * @access public
     */
    class Event implements IBaseModel {
        
        public $id;
        public $url;
        public $add_date;
        public $date;
        public $location;
        public $description;
        public $type;
        
        public function parsePOST($post)  {
            
        }
        public function parseJSON($json)  {
            
        }
        public function parseXML($xml)  {
            
        }
    }
?>