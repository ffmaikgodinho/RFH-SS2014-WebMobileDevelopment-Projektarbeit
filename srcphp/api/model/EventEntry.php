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
            if (isset($json["title"]))
                $this->title = $json["title"];
            if (isset($json["eventid"]))
                $this->eventid = $json["eventid"];
            if (isset($json["note"]))
                $this->note = $json["note"];
            if (isset($json["totalQuantity"]))
                $this->totalQuantity = $json["totalQuantity"];
            if (isset($json["stamp"]))
                $this->stamp = $json["stamp"];
        }
        public function parseXML($xml)  {
            
        }
    }
?>