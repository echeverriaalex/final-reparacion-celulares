<?php
    namespace Models;

    class OrderStatus{

        private $orderStatusId;
        private $description;

        public function __construct($orderStatusId = null, $description = null){

            $this->setOrderStatusId($orderStatusId);
            $this->setDescription($description);            
        }

        public function getOrderStatusId(){return $this->orderStatusId;}
        public function setOrderStatusId($orderStatusId){$this->orderStatusId = $orderStatusId;}

        public function getDescription(){return $this->description;}
        public function setDescription($description){$this->description = $description;}
    }
?>