<?php
    namespace Controllers;

    use DAO\OrderDAO;
    use DAO\OrderStatusDAO;
    use Controllers\ClientController;
    use DAO\ClientDAO;

    class OrderController{

        private $orderDAO;
        private $orderStatusDAO;
        private $clientDAO;

        public function __construct(){
            $this->orderDAO = new OrderDAO();
            $this->clientDAO = new ClientDAO();
            $this->orderStatusDAO = new OrderStatusDAO();
        }

        public function ShowListAllOrderView($message = null){

            if($_SESSION['technical']) {
                //$ordersList = $this->orderDAO->GetAll();
                //require_once(VIEWS_PATH."order-list.php");

                //$ordersList = $this->orderDAO->GetAllWithStatus();
                //require_once(VIEWS_PATH."order-list.php");

                $ordersList = $this->orderDAO->GetAllWithStatusClientTechnical();
                require_once(VIEWS_PATH."order-list.php");
            }
            else{
                header('location: '.FRONT_ROOT. '/Home/Index');
            }  
        }

        public function ShowAddView(){
            if($_SESSION['technical'] != null){
                $clientList = $this->clientDAO->GetAll();
                $orderStatusList = $this->orderStatusDAO->GetAll();       
                //var_dump($orderStatusList);     
                require_once(VIEWS_PATH."order-add.php");
            }
            else{
                header('location: '.FRONT_ROOT. '/Home/Index');
            }            
        }

        public function Add($orderStatusId, $id_client, $description, $id_technical){
            $this->orderDAO->Add($orderStatusId,$description, $id_technical, $id_client);
            $message = "Orden registrada con exito.";
            //require_once(VIEWS_PATH."order-list.php");
            $this->ShowListAllOrderView($message);            
        }

        public function Delete($orderId){
            $this->orderDAO->Delete($orderId);
            $this->ShowListAllOrderView();
        }
    }
?>