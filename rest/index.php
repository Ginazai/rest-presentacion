<?php
/*

Rafael Caballero 
8-1041-773
estudiante de ing. en sistemas informaticos

PHP: REST API 
version 1.0 

En este archivo son llamados los
archivos necesarios para la ejecucion
de la API

*/
require __DIR__ . "/inc/bootstrap.php";
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

if ((isset($uri[3]) && $uri[4] != 'user') || !isset($uri[4])) {
    header("HTTP/1.1 404 Not Found");
    exit();
}
/**
 * La direccion de la solicitud debera tener el siguiente formato: 
 * https://localhost/rest-presentacion/rest/index.php/{MODULE_NAME}/{METHOD_NAME}?limit={LIMIT_VALUE}
 * 
 * nota: en mi caso, el API se encuentra en la carpeta "rest-presentacion" en el interior de htdocs de XAMPP
 * recuerde que la visualizacion deberia ser hecho mediante el index.php dentro de la carpeta "rest-impl"
 * 
 * para el ejemplo, usare la siguiente uri:
 * http://localhost/rest-presentacion/rest/index.php/user/list?limit=20
 * 
 * Como se puede ver, se nombra el modulo { user }, el metodo { list } y el limite { 20 }
 * */
require PROJECT_ROOT_PATH . "/Controller/Api/UserController.php";
$objFeedController = new UserController();
$strMethodName = $uri[5] . 'Action';
// ejecucion de la solicitud mediante la clase UserController
$objFeedController->{$strMethodName}();