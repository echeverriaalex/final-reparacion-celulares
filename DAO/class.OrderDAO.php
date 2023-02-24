<?php
    namespace DAO;

    use Models\Order;
use Models\OrderStatus;
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
                    $order->setTechnicalId($row['technicalId']);
                    $order->setClientId($row['clientId']);
                    
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

        public function GetAllWithStatusClientTechnical(){
            try{
                $ordersList = array();
                //$query = "select * from $this->tableName o inner join orderstatus os where o.orderStatusId = os.orderStatusId and o.orderId = 3;";
                $query = 'select 
                            o.orderId as "order id", 
                            o.orderStatusId as "status order id", 
                            o.description as "description order",
                            
                            o.technicalId as "technical id",
                            t.userName as "technical name",
                            
                            o.clientId as "client id",
                            c.nombre as "nombre cliente",
                            c.telefono,
                            
                            os.orderStatusId as "status id", 
                            os.description as "description order status" 
                            from orders o inner join orderstatus os on o.orderStatusId = os.orderStatusId
                            inner join technicals t on o.technicalId = t.id_technical
                            inner join clients c on c.id_client = o.clientId ';
                $this->connection = Connection::GetInstance();
                $ordersResults = $this->connection->Execute($query);
                
                foreach($ordersResults as $row){
                    $order = new Order();
                    $order->setOrderId($row['order id']);
                    $order->setOrderStatusId($row['description order status']);
                    $order->setDescription($row['description order']);
                    $order->setTechnicalId($row['technical name']);
                    $order->setClientId($row['nombre cliente']."/". $row['telefono']);
                    array_push($ordersList, $order);
                }
                return $ordersList;
                
            }
            catch(PDOException $ex){
                throw $ex;
            }
        }

        public function GetAllWithStatusClientTechnicalLogged(){
            try{
                $ordersList = array();
                //$query = "select * from $this->tableName o inner join orderstatus os where o.orderStatusId = os.orderStatusId and o.orderId = 3;";
                $query = 'select 
                            o.orderId as "order id", 
                            o.orderStatusId as "status order id", 
                            o.description as "description order",
                            
                            o.technicalId as "technical id",
                            t.userName as "technical name",
                            
                            o.clientId as "client id",
                            c.nombre as "nombre cliente",
                            c.telefono,

                            os.orderStatusId as "status id", 
                            os.description as "description order status" 
                            from orders o inner join orderstatus os on o.orderStatusId = os.orderStatusId
                            inner join technicals t on o.technicalId = t.id_technical
                            inner join clients c on c.id_client = o.clientId 
                            where (o.technicalId = ' . $_SESSION['technical']->getIdTechnical() . ');';
                $this->connection = Connection::GetInstance();
                $ordersResults = $this->connection->Execute($query);
                
                foreach($ordersResults as $row){
                    $order = new Order();
                    $order->setOrderId($row['order id']);
                    $order->setOrderStatusId($row['description order status']);
                    $order->setDescription($row['description order']);
                    $order->setTechnicalId($row['technical name']);
                    $order->setClientId($row['nombre cliente']."/". $row['telefono']);
                    array_push($ordersList, $order);
                }
                return $ordersList;
                
            }
            catch(PDOException $ex){
                throw $ex;
            }
        }

        public function Add($orderStatusId,$description, $technicalId, $clientId ){    
            try{
                $query = "insert into $this->tableName (orderStatusId,description, technicalId, clientId) 
                                values (:orderStatusId, :description, :technicalId, :clientId);";
                $this->connection = Connection::GetInstance();

                $parameters['orderStatusId'] = $orderStatusId;
                $parameters['description'] = $description;
                $parameters['technicalId'] = $technicalId;
                $parameters['clientId'] = $clientId;

                $this->connection->ExecuteNonQuery($query, $parameters);
                $ok = true;
                
            }catch(PDOException $ex){
                throw $ex;
            }
        }

        public function Edit($orderId, $orderStatusId){
            try{
                $query = "update $this->tableName set orderId = :orderId, orderStatusId = :orderStatusId where(orderId = :orderId);";

                $parameters['orderId'] = $orderId;
                $parameters['orderStatusId'] = $orderStatusId;

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(PDOException $ex){
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