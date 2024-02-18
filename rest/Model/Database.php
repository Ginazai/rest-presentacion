<?php
/*

Rafael Caballero 
8-1041-773
estudiante de ing. en sistemas informaticos

PHP: REST API 
version 1.0 

Este archivo tiene como finalidad proveer las
conecciones y la funcionalidad basica de un 
modelo de datos, tabmbien conocido como PDO 
(PHP Data Object)

*/
class Database
{
    /*
    Se inicializa la coneccion con la base de datos
    */
    protected $connection = null;
    /*
    Se establece el constructor de la clase el cual
    tiene como proposito establecer una coneccion
    */
    public function __construct()
    {
        /*
        Se define la coneccion utilizando las constantes 
        declaradas en el archivo cofig.php el cual posee
        el valor de dichas constantes
        */
        try {
            $this->connection = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE_NAME);
    	   /*
            Si la coneccion falla, se envia un error
           */
            if (mysqli_connect_errno()) {
                throw new Exception("Could not connect to database.");   
            }
        } 
        /*
        En caso de no ser el error ya contemplado, se envia el
        error en cuestion
        */ 
        catch (Exception $e) {
            throw new Exception($e->getMessage());   
        }			
    }
    /**
    *El proposito de esta funcion es
    * @return el resultado de un 
    * SELECT en la base de datos
    * 
    * Notese que tambien toma un segundo
    * parametro que sirve para establecer 
    * un limite en la cantidad de elementos
    * selecciondos
    **/
    public function select($query = "" , $params = [])
    {
        /*
        el siguiente "try" ejecuta el query de seleccion
        con el parametro dado por el usuario, el cual
        debiera ser el limite de usuarios que recibir

        la funcion "executeStatement" esta declarada 
        mas abajo y su funcionalidad sera explicada 
        una vez llegados a ella
        */
        try {
            $stmt = $this->executeStatement( $query , $params );
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);				
            $stmt->close();
            return $result;
        } 
        /**
        *En caso de error se atrapa el mensaje de error y la funcion 
        * @return false
        */
        catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }
        return false;
    }
    /**
    *Esta funcion, como su nombre lo indica, se encarga
    *escencialmente de ejecutar un query CON parametros
    *para posteriormente 
    * @return el resultado  
    */
    private function executeStatement($query = "" , $params = [])
    {
        try {
            $stmt = $this->connection->prepare( $query );
            if($stmt === false) {
                throw New Exception("Unable to do prepared statement: " . $query);
            }
            /**
            *Se hace uso de la funcion de PHP "bind_params()" la cual 
            * toma como parametros el tipo de dato y el parametro a 
            * insertar en el query
            */
            if( $params ) {
                $stmt->bind_param($params[0], $params[1]);
            }
            $stmt->execute();
            return $stmt;
        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }	
    }
}
