create database prueba
gogoogogo

use prueba
go

create table persona(
id int not null identity(1,1) primary key,
nombre varchar(100),
apellido varchar(100),
edad int
)
go

insert into persona (nombre, apellido, edad) values ('nombre1', 'apellido1', 11),('nombre2', 'apellido2', 12),('nombre3', 'apellido3', 13)
go

/* Sin parámetros */
create procedure sp_persona_sin_parametros
as
begin
	select avg(edad) Promedio from persona
	select count(id) Cantidad from persona
	select id as codigo, nombre, apellido, edad from persona
end
go

/* Con parámetros */
create procedure sp_persona_con_parametros
@id int
as
begin
	select avg(edad) Promedio from persona
	select count(id) Cantidad from persona
	select id as codigo, nombre, apellido, edad from persona where id=@id
end
go
