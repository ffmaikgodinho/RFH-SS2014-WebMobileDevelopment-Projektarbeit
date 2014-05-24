<?php
    /**
     * EventEntry
     * 
     * represents a event entry which is linked to an event.
     * 
     * @package 
     * @author Maik Godinho
     * @copyright 2014
     * @access public
     */
    class EventEntry implements IBaseModel {
        
        public $id;
        public $url;
        public $eventid;
        public $title;
        public $note;
        public $linkWeb;
        public $totalQuantity;
        
        public function parsePOST($post)  {
            
        }
        public function parseJSON($json)  {
            
        }
        public function parseXML($xml)  {
            
        }
    }
?>