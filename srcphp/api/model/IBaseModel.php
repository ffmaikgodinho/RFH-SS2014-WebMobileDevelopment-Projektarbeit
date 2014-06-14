<?php
    /**
     * IBaseModel
     * 
     * @package api
     * @author Maik Godinho
     * @copyright 2014
     * @access public
     */
    interface IBaseModel  {
        /**
         * parsePOST()
         * 
         * creates a entity past on POST Data
         * 
         * @param Array of $_POST
         * @return Object whoose class implements IBase
         */
        public function parsePOST($post);
        /**
         * parseJSON()
         * 
         * creates a entity based on a json based string
         * 
         * @param string $json
         * @return Object whoose class implements IBase
         */
        public function parseJSON($json);
        /**
         * parseXML()
         * 
         * creates an entity based on an xml structure
         * 
         * @param string $xml
         * @return Object whoose class implements IBase
         */
        public function parseXML($xml);
    }
?>