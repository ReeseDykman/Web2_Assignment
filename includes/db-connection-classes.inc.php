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

class songSearcher{

    private static $baseSQL ="SELECT title, song_id, artist_name, year, genre_name FROM songs
                            INNER JOIN genres ON songs.genre_id = genres.genre_id
                            INNER JOIN artists ON songs.artist_id = artists.artist_id
                            WHERE ";

    function __construct($conn){
        $this->connection = $conn;
    }
    function genreSearch($criteria){
        $sql = self::$baseSQL . "songs.genre_id=" . $criteria;
        
        $results = database::dbquery($this->connection, $sql, null);
        $results = $results->fetchAll();
        return $results;
    }
    function titleSearch($criteria){
        $sql = self::$baseSQL . "songs.title LIKE '%" . $criteria ."%'";
        
        $results = database::dbquery($this->connection, $sql, null);
        $results = $results->fetchAll();
        return $results;
    }
    function artistSearch($criteria){
        $sql = self::$baseSQL . "songs.artist_id = " . $criteria;
        
        $results = database::dbquery($this->connection, $sql, null);
        $results = $results->fetchAll();
        return $results;
    }
    function lessYearSearch($criteria){
        $sql = self::$baseSQL . "songs.year < " . $criteria;
        
        $results = database::dbquery($this->connection, $sql, null);
        $results = $results->fetchAll();
        return $results;
    }
    function greaterYearSearch($criteria){
        $sql = self::$baseSQL . "songs.year > " . $criteria;
        
        $results = database::dbquery($this->connection, $sql, null);
        $results = $results->fetchAll();
        return $results;
    }

}


?>