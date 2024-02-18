<?php
/*

Rafael Caballero 
8-1041-773
estudiante de ing. en sistemas informaticos

PHP: REST API 
version 1.0 

Este archivo es la base para los 
otros controladores. Posee la 
funcionalidad basica que necesitariamos
independientemente del tipo de 
controlador por lo que servira
como padre de las clases subsecuentes

*/
class BaseController
{
    /** 
* metodo magico __call.
* 
* es la respuesta por defecto cuando 
* el metodo llamado no existe
* 
* Utiliza la respuesta 404 del
* protocolo HTTP 
*/
    public function __call($name, $arguments)
    {
        $this->sendOutput('', array('HTTP/1.1 404 Not Found'));
    }
    /** 
* Obtiene los elementos de la URI 
* 
* @return array 
*/
    protected function getUriSegments()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = explode( '/', $uri );
        return $uri;
    }
    /** 
* Obtiene los parametros del query 
* 
* @return array 
*/
    protected function getQueryStringParams()
    {
        return parse_str($_SERVER['QUERY_STRING'], $query);
    }
    /** 
* Envia el output del API 
* 
* @param mixed $data 
* @param string $httpHeader 
*/
    protected function sendOutput($data, $httpHeaders=array())
    {
        header_remove('Set-Cookie');
        if (is_array($httpHeaders) && count($httpHeaders)) {
            foreach ($httpHeaders as $httpHeader) {
                header($httpHeader);
            }
        }
        echo $data;
        exit;
    }
}