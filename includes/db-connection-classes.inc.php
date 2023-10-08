<?php


class database{
    

    public static function createConnection($DBCONNSTRING, $DBUSER, $DBPASS){

        $pdo = new pdo($DBCONNSTRING,$DBUSER,$DBPASS);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $pdo;
    }

    public static function dbquery($connection,$sql, $parameters){
        $statement = null;

        if(isset($parameters)){
            if(!is_array($parameters)){
                $parameters = array($parameters);
            }
            $statement = $connection->prepare($sql);
            $executedOK = $statement->execute($parameters);
            if(!$executedOK)
                throw new PDOException;
        }else{
            $statement = $connection->query($sql);
            if(!$statement)
                throw new PDOException;
        }
        return $statement;
    }
}


?>