<?php
    interface IBaseRequest  {
       
        public function __construct($requestHandler);
        public function getAll();
        public function getSingle($id);
        public function create();
        public function update($id);
        public function delete($id);
       
    }
?>