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
        public $entrys;     //array of EventEntry
        public $type;
        public $stamp;      //ETAG
        
        public function parsePOST($postData)  {
            if (isset($postData["Datum"]))
                $this->date = $postData["Datum"];
            if (isset($postData["Ort"]))
                $this->location = $postData["Ort"];
            if (isset($postData["Beschreibung"]))
                $this->description = $postData["Beschreibung"];
            if (isset($postData["Typ"]))
                $this->type = $postData["Typ"];
        }
        public function parseJSON($json)  {
            
        }
        public function parseXML($xml)  {
            
        }
    }
?>