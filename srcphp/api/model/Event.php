<?php
    /**
     * Event
     * 
     * represents a created event with linked EventEntrys
     * represents the sql table "event"
     * 
     * @package api
     * @author Maik Godinho
     * @copyright 2014
     * @access public
     */
    class Event implements IBaseModel {
        
        public $id;
        public $url;
        public $add_date;
        public $date;
        public $title;
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
            if (isset($postData["Titel"]))
                $this->title = $postData["Titel"];
            if (isset($postData["Beschreibung"]))
                $this->description = $postData["Beschreibung"];
            if (isset($postData["Typ"]))
                $this->type = $postData["Typ"];
        }
        public function parseJSON($json)  {
            if (isset($json["title"]))
                $this->title = $json["title"];
            if (isset($json["date"]))
                $this->date = $json["date"];
            if (isset($json["location"]))
                $this->location = $json["location"];
            if (isset($json["description"]))
                $this->description = $json["description"];
            if (isset($json["type"]))
                $this->type = $json["type"];
            
        }
        public function parseXML($xml)  {
            
        }
    }
?>