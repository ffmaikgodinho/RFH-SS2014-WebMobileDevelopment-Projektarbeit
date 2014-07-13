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
                $this->date = new DateTime($postData["Datum"]);
            if (isset($postData["Ort"]))
                $this->location = $postData["Ort"];
            if (isset($postData["Titel"]))
                $this->title = $postData["Titel"];
            if (isset($postData["Beschreibung"]))
                $this->description = $postData["Beschreibung"];
            if (isset($postData["Typ"]))
                $this->type = $postData["Typ"];
            if (isset($postData["Stamp"]))
                $this->stamp = $postData["Stamp"];
        }
        public function parseJSON($json)  {
            if (isset($json["title"]))
                $this->title = $json["title"];
            if (isset($json["date"]))
                $this->date = new DateTime($json["date"]);
            if (isset($json["location"]))
                $this->location = $json["location"];
            if (isset($json["description"]))
                $this->description = $json["description"];
            if (isset($json["type"]))
                $this->type = $json["type"];
            if (isset($json["stamp"]))
                $this->stamp = $json["stamp"];
            
        }
        public function parseXML($xml)  {
            
        }
    }
?>