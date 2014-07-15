<?php
    /**
     * IBaseRequest
     * 
     * @package api   
     * @author Maik Godinho
     * @copyright 
     * @version 1.0.0
     * @access public
     */
    interface IBaseRequest  {
       
        public function __construct($requestHandler);
        public function getAll($searchString);
        public function getSingle($id);
        public function create($inputData);
        public function update($inputData);
        public function delete($id);
       
    }
?>