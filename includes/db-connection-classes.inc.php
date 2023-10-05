<?php

require_once 'config.inc.php';

class database(){

    public static function createConnection(DBCONNSTRING, DBUSER, DBPASS){

        $database = new pdo(DBCONNSTRING,DBUSER,DBPASS);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $pdo;
    }

    


}


?>