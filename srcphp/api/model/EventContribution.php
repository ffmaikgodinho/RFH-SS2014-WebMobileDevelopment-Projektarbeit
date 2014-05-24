<?php
    namespace API\model;
    
    /**
     * EventContribution
     * 
     * Contribution to an eventEntry
     * 
     * @author Maik Godinho
     * @copyright 2014
     * @access public
     */
    class EventContribution implements IBase {
        
        public $id;
        public $eventEntryID;
        public $userid;
        public $name;
        public $quantity;
        public $url;
        
        public function parsePOST($post)  {
            
        }
        public function parseJSON($json)  {
            
        }
        public function parseXML($xml)  {
            
        }
    }
?>