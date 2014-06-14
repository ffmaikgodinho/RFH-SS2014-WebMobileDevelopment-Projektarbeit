<?php
    /**
     * EventContribution
     * 
     * Contribution to an eventEntry
     * 
     * @package api
     * @author Maik Godinho
     * @copyright 2014
     * @access public
     */
    class EventContribution implements IBaseModel {
        
        public $id;
        public $eventEntryID;
        public $userid;
        public $name;
        public $quantity;
        public $url;
        public $stamp;      //ETAG
        
        public function parsePOST($post)  {
            
        }
        public function parseJSON($json)  {
            
        }
        public function parseXML($xml)  {
            
        }
    }
?>