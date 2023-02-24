<?php
    namespace Models;

    class Order{

        private $orderId;
        private $orderStatusId;
        private $description;
        private $technicalId;
        private $clientId;

        public function __construct($orderId = null, $orderStatusId = null, $description = null, $technicalId = null, $clientId = null){
            $this->setOrderId($orderId);
            $this->setOrderStatusId($orderStatusId);
            $this->setDescription($description);
            $this->setTechnicalId($technicalId);
            $this->setClientId($clientId);
        }

        public function getOrderId(){return $this->orderId;}
        public function setOrderId($orderId){$this->orderId = $orderId;}

        public function getOrderStatusId(){return $this->orderStatusId;}
        public function setOrderStatusId($orderStatusId){$this->orderStatusId = $orderStatusId;}

        public function getDescription(){return $this->description;}
        public function setDescription($description){$this->description = $description;}

        public function getTechnicalId(){return $this->technicalId;}
        public function setTechnicalId($technicalId){$this->technicalId = $technicalId;}

        public function getClientId(){return $this->clientId;}
        public function setClientId($clientId){$this->clientId = $clientId;}
    }
?>