<?php
/*

Rafael Caballero 
8-1041-773
estudiante de ing. en sistemas informaticos

PHP: REST API 
version 1.0 

Este archivo tiene como finalidad 

*/
class UserController extends BaseController
{
    /** 
* "/user/list" Endpoint - Obtiene la lista de todos los usuarios
*/
    public function listAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        //se implementa la funcion heredada de la clase BaseController
        $arrQueryStringParams = $this->getQueryStringParams();
        //Se confirma el metodo de la solicitud HTTP
        if (strtoupper($requestMethod) == 'GET') {
            try {
                $userModel = new UserModel();
                $intLimit = 10;
                if (isset($arrQueryStringParams['limit']) && $arrQueryStringParams['limit']) {
                    $intLimit = $arrQueryStringParams['limit'];
                }
                $arrUsers = $userModel->getUsers($intLimit);
                $responseData = json_encode($arrUsers);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
        /**
        * se envia el output en formato JSON
        * (la funcion sendOutput es heredada del contralador Base)
        */
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }
}