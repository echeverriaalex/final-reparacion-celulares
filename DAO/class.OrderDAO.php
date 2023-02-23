<?php
    namespace DAO;

    use Models\Order;
    use PDOException;

    class OrderDAO{

        private $connection;
        private $tableName = "orders";
        private $orderStatusDAO;

        public function GetAll(){
            try{
                $ordersList = array();
                $query = "select * from $this->tableName;";
                $this->connection = Connection::GetInstance();
                $ordersResults = $this->connection->Execute($query);

                foreach($ordersResults as $row){

                    $order = new Order();
                    $order->setOrderId($row['orderId']);
                    $order->setOrderStatusId($row['orderStatusId']);
                    $order->setDescription($row['description']);
                    
                    array_push($ordersList, $order);
                }
                return $ordersList;
            }
            catch(PDOException $ex){
                throw $ex;
            }
        }

        public function GetAllWithStatus(){
            try{
                $ordersList = array();
                //$query = "select * from $this->tableName o inner join orderstatus os where o.orderStatusId = os.orderStatusId and o.orderId = 3;";
                $query = 'select o.orderId, o.description, os.description as "estado"
                from orders o inner join orderstatus os where o.orderStatusId = os.orderStatusId ;';
                $this->connection = Connection::GetInstance();
                $ordersResults = $this->connection->Execute($query);

                foreach($ordersResults as $row){
                    $order = new Order($row['orderId'], $row['description'], $row['estado']);
                    array_push($ordersList, $order);
                }
                return $ordersList;
            }
            catch(PDOException $ex){
                throw $ex;
            }
        }

        public function Add($orderStatusId,$description){    
            try{
                $query = "insert into $this->tableName (orderStatusId,description) values (:orderStatusId, :description);";
                $this->connection = Connection::GetInstance();

                $parameters['orderStatusId'] = $orderStatusId;
                $parameters['description'] = $description;

                $this->connection->ExecuteNonQuery($query, $parameters);
                $ok = true;
                
            }catch(PDOException $ex){
                throw $ex;
            }
        }

        public function Delete($orderId){
            try{
                $query = "delete from $this->tableName where (orderId = :orderId);";
                $parameters['orderId'] = $orderId;
                $this->connection = Connection::GetInstance();                
                $this->connection->ExecuteNonQuery($query, $parameters);
            }catch(PDOException $ex){
                throw $ex;
            }
        }
    }
?>