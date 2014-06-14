<?php
    /**
     * EventEntry
     * 
     * represents a event entry which is linked to an event.
     * 
     * @package api
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
        public $totalQuantity;
        public $contributions;      //Array of EventContribution
        public $stamp;              //ETAG
        
        public function parsePOST($post)  {
            
        }
        public function parseJSON($json)  {
            
        }
        public function parseXML($xml)  {
            
        }
    }
?>