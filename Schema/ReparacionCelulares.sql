drop database if exists reparacion_celulares;
CREATE DATABASE IF NOT EXISTS reparacion_celulares;
USE reparacion_celulares;

drop table orders;
CREATE TABLE IF NOT EXISTS orders
(
    orderId INT NOT NULL auto_increment,
    orderStatusId INT NOT NULL,
    description NVARCHAR(200) NOT NULL,
    technicalId INT NOT NULL,
    clientId INT NOT NULL,
    CONSTRAINT PK_Order PRIMARY KEY (orderId)
)Engine=InnoDB;

drop table technicals;
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
			("Monica Rapidos", "25654342"),
            ("Dominic Toretto", "67708865342");

CREATE TABLE IF NOT EXISTS orderstatus
(
    orderStatusId INT NOT NULL AUTO_INCREMENT,
    description NVARCHAR(100) NOT NULL,
    CONSTRAINT PK_OrderStatus PRIMARY KEY (orderStatusId)
)Engine=InnoDB;

INSERT INTO orderstatus (description)
    VALUES ('Pendiente'),('En reparacion'),('Finalizado');

delete from orders;
select  * from orders;

select * from orderstatus;
    
select * from clients;

select * from technicals; 

select o.orderId, o.description, os.description as "estado"
	from orders o inner join orderstatus os where o.orderStatusId = os.orderStatusId and o.orderId = 3;

select o.orderId, o.description, os.description as "estado"
	from orders o inner join orderstatus os where o.orderStatusId = os.orderStatusId;
   

select 
	o.orderId as "order", 
    o.orderStatusId as "status id order", 
    o.description as "description order", 
    os.orderStatusId as "status id", 
    os.description as "description order status" 
    from orders o inner join orderstatus os 
	where o.orderStatusId = os.orderStatusId and o.orderId = 3;
    
select 
	o.orderId as "order id", 
    o.orderStatusId as "status order id", 
    o.description as "description order",
    
    o.technicalId as "technical id",
    t.userName as "technical name",
    
    o.clientId as "client id",
    c.nombre as "nombre cliente",
    os.orderStatusId as "status id", 
    os.description as "description order status" 
    from orders o inner join orderstatus os on o.orderStatusId = os.orderStatusId
    inner join technicals t on o.technicalId = t.id_technical
    inner join clients c on c.id_client = o.clientId
    where o.orderId = 3;
    
    
    
    
    
    
    
    
    
    