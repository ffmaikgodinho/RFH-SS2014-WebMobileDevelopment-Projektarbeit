<?php
    interface IBaseRequest  {
       
        public function getAll();
        public function getSingle($id);
        public function create();
        public function update($id);
        public function delete($id);
       
    }
?>