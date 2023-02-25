<?php
    namespace Controllers;

    use DAO\RepairDAO;
    use DAO\RepairStatusDAO;
    use Controllers\ClientController;
    use DAO\ClientDAO;

    class RepairController{

        private $RepairDAO;
        private $RepairStatusDAO;
        private $clientDAO;

        public function __construct(){
            $this->RepairDAO = new RepairDAO();
            $this->clientDAO = new ClientDAO();
            $this->RepairStatusDAO = new RepairStatusDAO();
        }

        public function ShowListAllOrderView($message = null){

            if($_SESSION['technical']) {
                
                $repairStatusList = $this->RepairStatusDAO->GetAll(); 
                
                //$repairsList = $this->RepairDAO->GetAll();
                //require_once(VIEWS_PATH."repair-list.php");

                $repairsList = $this->RepairDAO->GetAllWithStatusClientTechnical();
                require_once(VIEWS_PATH."repair-list.php");
            }
            else{
                header('location: '.FRONT_ROOT. '/Home/Index');
            }  
        }

        public function ShowListOrderView($message = null){

            if($_SESSION['technical']) {
                //$repairsList = $this->RepairDAO->GetAll();
                //require_once(VIEWS_PATH."repair-list.php");

                //$repairsList = $this->RepairDAO->GetAllWithStatus();
                //require_once(VIEWS_PATH."repair-list.php");

                $repairStatusList = $this->RepairStatusDAO->GetAll(); 
                $repairsList = $this->RepairDAO->GetAllWithStatusClientTechnicalLogged();
                require_once(VIEWS_PATH."repair-list.php");
            }
            else{
                header('location: '.FRONT_ROOT. '/Home/Index');
            }  
        }

        public function ShowAddView(){
            if($_SESSION['technical'] != null){
                $clientList = $this->clientDAO->GetAll();
                $repairsStatusList = $this->RepairStatusDAO->GetAll();       
                //var_dump($repairStatusList);     
                require_once(VIEWS_PATH."repair-add.php");
            }
            else{
                header('location: '.FRONT_ROOT. '/Home/Index');
            }            
        }

        public function Add($repairStatusId, $clientId, $description, $technicalId){
            $this->RepairDAO->Add($repairStatusId,$description, $technicalId, $clientId);
            $message = "Orden registrada con exito.";
            //require_once(VIEWS_PATH."repair-list.php");
            $this->ShowListAllOrderView($message);            
        }

        public function EditStatus($repairId, $repairStatusId){
            $this->RepairDAO->Edit($repairId, $repairStatusId);
            $this->ShowListAllOrderView();
        }

        public function Delete($repairId){
            $this->RepairDAO->Delete($repairId);
            $this->ShowListAllOrderView();
        }
    }
?>