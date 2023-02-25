<?php
    namespace DAO;

    use Models\Repair;
    use Models\RepairStatus;
    use PDOException;

    class RepairDAO{

        private $connection;
        private $tableName = "repairs";

        public function GetAll(){
            try{
                $repairsList = array();
                $query = "select * from $this->tableName;";
                $this->connection = Connection::GetInstance();
                $repairsResults = $this->connection->Execute($query);

                foreach($repairsResults as $row){

                    $repair = new Repair();
                    $repair->setRepairId($row['repairId']);
                    $repair->setRepairStatusId($row['repairStatusId']);
                    $repair->setDescription($row['description']);
                    $repair->setTechnicalId($row['technicalId']);
                    $repair->setClientId($row['clientId']);
                    
                    array_push($repairsList, $repair);
                }
                return $repairsList;
            }
            catch(PDOException $ex){
                throw $ex;
            }
        }

        public function GetAllWithStatus(){
            try{
                $repairsList = array();
                //$query = "select * from $this->tableName r inner join repairstatus rs where r.repairStatusId = rs.repairStatusId and r.repairId = 3;";
                $query = 'select r.repairId, r.description, rs.description as "estado"
                from repairs r inner join repairstatus rs where r.repairStatusId = rs.repairStatusId ;';
                $this->connection = Connection::GetInstance();
                $repairsResults = $this->connection->Execute($query);

                foreach($repairsResults as $row){
                    $repair = new Repair($row['repairId'], $row['description'], $row['estado']);
                    array_push($repairsList, $repair);
                }
                return $repairsList;
            }
            catch(PDOException $ex){
                throw $ex;
            }
        }

        public function GetAllWithStatusClientTechnical(){
            try{
                $repairsList = array();
                //$query = "select * from $this->tableName r inner join repairstatus rs where r.repairStatusId = rs.repairStatusId and r.repairId = 3;";
                $query = 'select 
                            r.repairId as "repair id", 
                            r.repairStatusId as "status repair id", 
                            r.description as "description order",
                            
                            r.technicalId as "technical id",
                            t.userName as "technical name",
                            
                            r.clientId as "client id",
                            c.nombre as "nombre cliente",
                            c.telefono,
                            
                            rs.repairStatusId as "status id", 
                            rs.description as "description order status" 
                            from repairs r inner join repairstatus rs on r.repairStatusId = rs.repairStatusId
                            inner join technicals t on r.technicalId = t.id_technical
                            inner join clients c on c.id_client = r.clientId ';
                $this->connection = Connection::GetInstance();
                $repairsResults = $this->connection->Execute($query);
                
                foreach($repairsResults as $row){
                    $repair = new Repair();
                    $repair->setRepairId($row['repair id']);
                    $repair->setRepairStatusId($row['description order status']);
                    $repair->setDescription($row['description order']);
                    $repair->setTechnicalId($row['technical name']);
                    $repair->setClientId($row['nombre cliente']."/". $row['telefono']);
                    array_push($repairsList, $repair);
                }
                return $repairsList;
                
            }
            catch(PDOException $ex){
                throw $ex;
            }
        }

        public function GetAllWithStatusClientTechnicalLogged(){
            try{
                $repairsList = array();
                //$query = "select * from $this->tableName r inner join repairstatus rs where r.repairStatusId = rs.repairStatusId and r.repairId = 3;";
                $query = 'select 
                            r.repairId as "repair id", 
                            r.repairStatusId as "status repair id", 
                            r.description as "description order",
                            
                            r.technicalId as "technical id",
                            t.userName as "technical name",
                            
                            r.clientId as "client id",
                            c.nombre as "nombre cliente",
                            c.telefono,

                            rs.repairStatusId as "status id", 
                            rs.description as "description order status" 
                            from repairs r inner join repairstatus rs on r.repairStatusId = rs.repairStatusId
                            inner join technicals t on r.technicalId = t.id_technical
                            inner join clients c on c.id_client = r.clientId 
                            where (r.technicalId = ' . $_SESSION['technical']->getIdTechnical() . ');';
                $this->connection = Connection::GetInstance();
                $repairsResults = $this->connection->Execute($query);
                
                foreach($repairsResults as $row){
                    $repair = new Repair();
                    $repair->setRepairId($row['repair id']);
                    $repair->setRepairStatusId($row['description order status']);
                    $repair->setDescription($row['description order']);
                    $repair->setTechnicalId($row['technical name']);
                    $repair->setClientId($row['nombre cliente']."/". $row['telefono']);
                    array_push($repairsList, $repair);
                }
                return $repairsList;
                
            }
            catch(PDOException $ex){
                throw $ex;
            }
        }

        public function Add($repairStatusId,$description, $technicalId, $clientId){    
            try{
                $query = "insert into $this->tableName (repairStatusId,description, technicalId, clientId) 
                                values (:repairStatusId, :description, :technicalId, :clientId);";
                $this->connection = Connection::GetInstance();

                $parameters['repairStatusId'] = $repairStatusId;
                $parameters['description'] = $description;
                $parameters['technicalId'] = $technicalId;
                $parameters['clientId'] = $clientId;

                $this->connection->ExecuteNonQuery($query, $parameters);
                $ok = true;
                
            }catch(PDOException $ex){
                throw $ex;
            }
        }

        public function Edit($repairId, $repairStatusId){
            try{
                $query = "update $this->tableName set repairId = :repairId, repairStatusId = :repairStatusId where(repairId = :repairId);";

                $parameters['repairId'] = $repairId;
                $parameters['repairStatusId'] = $repairStatusId;

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(PDOException $ex){
                throw $ex;
            }
        }

        public function Delete($repairId){
            try{
                $query = "delete from $this->tableName where (repairId = :repairId);";
                $parameters['repairId'] = $repairId;
                $this->connection = Connection::GetInstance();                
                $this->connection->ExecuteNonQuery($query, $parameters);
            }catch(PDOException $ex){
                throw $ex;
            }
        }
    }
?>