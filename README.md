# apiRestSqlServer

NOTA : Ha sido testeado con XAMPP 7.0.13 32Bits y SQL SERVER 2014 en un sistema operativo de 64Bits.

1.- Instalar msodbcsql13.msi que se encuentra en la carpeta Drivers SQL y PHP.

2.- Configurando PHP.INI
Agregar las líneas en el archivo "PHP.INI".

32 bits
extension=php_sqlsrv_7_nts_x86.dll
extension=php_sqlsrv_7_ts_x86.dll

64 bits
extension=php_sqlsrv_7_nts_x64.dll
extension=php_sqlsrv_7_ts_x64.dll

3.- Configurar el archivo CONFIG.PHP

define("servername", ""); //NOMBRE DEL SERVIDOR
define("database", "prueba"); //NOMBRE DE LA BASE DE DATOS
define("uid", ""); //INICIO DE SESIÓN
define("pwd", ""); //CONTRASEÑA
define("characterset", "UTF-8");

4.- Ejecutar en SQL SERVER (20xx) el archivo query.sql

create database prueba
go

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

5.- Abrir los archivos spConParametros.php o spSinParametros.php desde el navegador WEB.

CRÉDITOS BY CARLO
CONTACTO
GMAIL
carlo368723@gmail.com
HOTMAIL
carlo368723@hotmail.com
TELEF
01-2562208
CEL
01-976424679