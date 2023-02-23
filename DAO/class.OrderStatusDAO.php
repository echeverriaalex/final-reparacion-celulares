<?php
    namespace DAO;

    use PDOException;
    use Models\OrderStatus;

    class OrderStatusDAO{

        private $tableName = "orderstatus";
        private $connection;

        public function GetAll(){

            try{
                $orderStatusList = array();
                $query = "select * from $this->tableName;";
                $this->connection = Connection::GetInstance();
                $orderStatusResult = $this->connection->Execute($query);

                //echo "<br><br> ACA EN EL DAO STATUS";
                //var_dump($orderStatusResult);

                //echo "<br><br>"; 

                foreach($orderStatusResult as $row){

                    $orderStatus = new OrderStatus($row['orderStatusId'], $row['description']);
                    array_push($orderStatusList, $orderStatus);
                }
                return $orderStatusList;
            }
            catch(PDOException $ex){
                throw $ex;
            }

        }

        public function GetOrderStatusById(){
            
        }
    }
?>