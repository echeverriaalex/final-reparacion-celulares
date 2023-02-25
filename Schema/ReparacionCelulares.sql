drop database if exists reparacion_celulares;
CREATE DATABASE IF NOT EXISTS reparacion_celulares;
USE reparacion_celulares;

drop table if exists repairs;
CREATE TABLE IF NOT EXISTS repairs
(
    repairId INT NOT NULL auto_increment,
    repairStatusId INT NOT NULL,
    description NVARCHAR(200) NOT NULL,
    technicalId INT NOT NULL,
    clientId INT NOT NULL,
    CONSTRAINT PK_repair PRIMARY KEY (repairId)
)Engine=InnoDB;

select * from repairs;
update repairs set repairId = 9, repairStatusId =2  where(repairId = 9);
select * from repairs;

drop table if exists technicals;
CREATE TABLE IF NOT EXISTS technicals
(
	id_technical int  auto_increment,
	userName NVARCHAR(100) NOT NULL,
    email NVARCHAR(100) NOT NULL,
    password NVARCHAR(100) NOT NULL,
    CONSTRAINT PK_technicals primary key (id_technical)
)Engine=InnoDB;

insert into technicals (userName, email, password) 
	values 	("Alex Echeverria", "alex@alex.com", "123456"),
			("Pepe Fulano", "pepe@utn.com", "123456"),
            ("Fulano Mengano", "fula@no.com", "123456");

CREATE TABLE IF NOT EXISTS clients
(
	id_client INT NOT NULL auto_increment,
	nombre NVARCHAR(100) NOT NULL,
    telefono NVARCHAR(100) NOT NULL,
    CONSTRAINT PK_clients primary key (id_client)
)Engine=InnoDB;

insert into clients(nombre, telefono) 
	values 	("Pepe Argento", "22345342"),
			("Monica Rapidrs", "25654342"),
            ("Dominic Toretto", "67708865342");

CREATE TABLE IF NOT EXISTS repairstatus
(
    repairStatusId INT NOT NULL AUTO_INCREMENT,
    description NVARCHAR(100) NOT NULL,
    CONSTRAINT PK_repairStatus PRIMARY KEY (repairStatusId)
)Engine=InnoDB;

INSERT INTO repairstatus (description)
    VALUES ('Pendiente'),('En reparacion'),('Finalizado');

delete from repairs;
select  * from repairs;

select * from repairstatus;
    
select * from clients;

select * from technicals; 

select r.repairId, r.description, rs.description as "estado"
	from repairs r inner join repairstatus rs where r.repairStatusId = rs.repairStatusId and r.repairId = 3;

select r.repairId, r.description, rs.description as "estado"
	from repairs r inner join repairstatus rs where r.repairStatusId = rs.repairStatusId;
   

select 
	r.repairId as "repair", 
    r.repairStatusId as "status id repair", 
    r.description as "description repair", 
    rs.repairStatusId as "status id", 
    rs.description as "description repair status" 
    from repairs r inner join repairstatus rs 
	where r.repairStatusId = rs.repairStatusId and r.repairId = 3;
    
select 
	r.repairId as "repair id", 
    r.repairStatusId as "status repair id", 
    r.description as "description repair",
    
    r.technicalId as "technical id",
    t.userName as "technical name",
    
    r.clientId as "client id",
    c.nombre as "nombre cliente",
    rs.repairStatusId as "status id", 
    rs.description as "description repair status" 
    from repairs r inner join repairstatus rs on r.repairStatusId = rs.repairStatusId
    inner join technicals t on r.technicalId = t.id_technical
    inner join clients c on c.id_client = r.clientId
    where r.repairId = 3;
    
select 
	r.repairId as "repair", 
    r.repairStatusId as "status id repair", 
    r.description as "description repair", 
    rs.repairStatusId as "status id", 
    rs.description as "description repair status" 
    from repairs r inner join repairstatus rs 
	where r.repairStatusId = rs.repairStatusId and r.repairId = 3;
    
select 
	r.repairId as "repair id", 
    r.repairStatusId as "status repair id", 
    r.description as "description repair",
    
    r.technicalId as "technical id",
    t.userName as "technical name",
    
    r.clientId as "client id",
    c.nombre as "nombre cliente",
    c.telefono,
    rs.repairStatusId as "status id", 
    rs.description as "description repair status" 
    from repairs r inner join repairstatus rs on r.repairStatusId = rs.repairStatusId
    inner join technicals t on r.technicalId = t.id_technical
    inner join clients c on c.id_client = r.clientId;
    
    
    
    
    
    
    
    
    