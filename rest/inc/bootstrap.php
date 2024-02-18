<?php
/*

Rafael Caballero 
8-1041-773
estudiante de ing. en sistemas informaticos

PHP: REST API 
version 1.0 

Este archivo tiene como finalidad importar las
dependencias basicas, necesarias para el
funcionamiento de la API.

*/
/* 

Se define la constante para el directorio de
proyecto. Utilizamos la variable magica __DIR__
para indicar que la ruta del proyecto es un
directorio detras del actual

*/
define("PROJECT_ROOT_PATH", __DIR__ . "/../");
/* 
Se incluye el archivo de configuracion el cual a
su vez, posee las constantes para nombrar a los 
elementos de la base de datos 
*/ 
require_once PROJECT_ROOT_PATH . "/inc/config.php";
/*
Se incluye el Controlador base, el cual deberia proveer
la funcionalidad basica a los demas controladores que 
consiste escencialmente en procesar la informacion de la URI
*/
require_once PROJECT_ROOT_PATH . "/Controller/Api/BaseController.php";
/*
Se incluye el modelo de usuario, el cual hereda sus atributos 
de la clase modelo padre Database.php que a su vez posee la funcionalidad 
basica que necesitaremos en este ejemplo, que es la lectura de datos.
Por lo tanto, el modelo de usuario incluye unicamente un query que se 
encargara de solicitar "x" cantidad de usuarios a la base de datos.
*/
require_once PROJECT_ROOT_PATH . "/Model/UserModel.php";
?>
