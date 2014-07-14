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
            if (isset($json["eventEntryID"]))
                $this->eventEntryID = $json["eventEntryID"];
            if (isset($json["userid"]))
                $this->userid = $json["userid"];
            if (isset($json["name"]))
                $this->name = $json["name"];
            if (isset($json["quantity"]))
                $this->quantity = $json["quantity"];
            if (isset($json["stamp"]))
                $this->stamp = $json["stamp"];
        }
        public function parseXML($xml)  {
            
        }
    }
?>