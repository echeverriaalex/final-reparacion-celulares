<?php
    namespace Models;

    class Order{

        private $orderId;
        private $orderStatusId;
        private $description;

        public function __construct($orderId = null, $orderStatusId = null, $description = null){            
            $this->setOrderId($orderId);
            $this->setOrderStatusId($orderStatusId);
            $this->setDescription($description);
        }

        public function getOrderId(){return $this->orderId;}
        public function setOrderId($orderId){$this->orderId = $orderId;}

        public function getOrderStatusId(){return $this->orderStatusId;}
        public function setOrderStatusId($orderStatusId){$this->orderStatusId = $orderStatusId;}

        public function getDescription(){return $this->description;}
        public function setDescription($description){$this->description = $description;}
    }
?>