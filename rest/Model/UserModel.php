<?php
/*

Rafael Caballero 
8-1041-773
estudiante de ing. en sistemas informaticos

PHP: REST API 
version 1.0 

Este archivo tiene como finalidad establecer 
la funcionalidad basica que estaremos utlizando 
en este ejemplo.

Para empezar, solicitamos la clase Database.php
debido a que esta clase heredara los metodos de 
dicha clase padre

*/
require_once PROJECT_ROOT_PATH . "/Model/Database.php";
class UserModel extends Database
{
    /**
     * La funcion getUsers() tiene como parametro el limite 
     * de usuarios a solicitar de la base de datos y
     * @return la respuesta del servidor
     * como podemos ver en Database.php, se toma como parametro
     * un limite para la funcion select() que fue heredada de 
     * la clase padre.
     * 
     * Notese que "i" indica que el parametro proporcionado es 
     * de tipo int / integer
     * 
     * i : integer
     * d: float
     * s: string 
     * b: blob
     * src: https://www.php.net/manual/en/mysqli-stmt.bind-param.php
    */
    public function getUsers($limit)
    {
        return $this->select("SELECT * FROM users ORDER BY user_id ASC LIMIT ?", ["i", $limit]);
    }
}
