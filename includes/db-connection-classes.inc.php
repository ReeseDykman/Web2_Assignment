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
    function getGenreName($criteria){
        $sql = "SELECT genre_name FROM genres WHERE genre_id = " . $criteria;
        
        $results = database::dbquery($this->connection, $sql, null);
        $results = $results->fetchAll();
        return $results[0]['genre_name'];
    }
    function orderByGenre(){
        $sql = "SELECT title, song_id, artist_name, year, genre_name FROM songs
            INNER JOIN genres ON songs.genre_id = genres.genre_id
            INNER JOIN artists ON songs.artist_id = artists.artist_id ORDER BY genre_name";

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
    function orderByTitle(){
        $sql = "SELECT title, song_id, artist_name, year, genre_name FROM songs
            INNER JOIN genres ON songs.genre_id = genres.genre_id
            INNER JOIN artists ON songs.artist_id = artists.artist_id ORDER BY title";

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
    function getArtistName($criteria){
        $sql = "SELECT artist_name FROM artists WHERE artist_id = " . $criteria;
        
        $results = database::dbquery($this->connection, $sql, null);
        $results = $results->fetchAll();
        return $results[0]['artist_name'];
    }
    function orderByArtist(){
        $sql = "SELECT title, song_id, artist_name, year, genre_name FROM songs
            INNER JOIN genres ON songs.genre_id = genres.genre_id
            INNER JOIN artists ON songs.artist_id = artists.artist_id ORDER BY artist_name";

        $results = database::dbquery($this->connection, $sql, null);
        $results = $results->fetchAll();
        return $results;
    }
    function lessYearSearch($criteria){
        $sql = self::$baseSQL . "songs.year < " . $criteria . " ORDER BY year";
        
        $results = database::dbquery($this->connection, $sql, null);
        $results = $results->fetchAll();
        return $results;
    }
    function greaterYearSearch($criteria){
        $sql = self::$baseSQL . "songs.year > " . $criteria . " ORDER BY year";
        
        $results = database::dbquery($this->connection, $sql, null);
        $results = $results->fetchAll();
        return $results;
    }
    function orderByYear(){
        $sql = "SELECT title, song_id, artist_name, year, genre_name FROM songs
            INNER JOIN genres ON songs.genre_id = genres.genre_id
            INNER JOIN artists ON songs.artist_id = artists.artist_id ORDER BY year";

        $results = database::dbquery($this->connection, $sql, null);
        $results = $results->fetchAll();
        return $results;
    }
    function getFavourite($criteria){
        $sql = self::$baseSQL . "songs.song_id=" . $criteria;
        
        $results = database::dbquery($this->connection, $sql, null);
        $results = $results->fetchAll();
        return $results;
    }

}
class homeSearcher{

    function __construct($conn){
        $this->connection = $conn;
    }

    function getTopGenres(){
        $sql = "SELECT songs.genre_id, genres.genre_name, COUNT(*) AS count FROM songs 
            INNER JOIN genres ON songs.genre_id = genres.genre_id GROUP BY songs.genre_id 
            ORDER BY count DESC LIMIT 10" ;

        $results = database::dbquery($this->connection, $sql, null);
        $results = $results->fetchAll();
        return $results;

    }

    function getTopArtists(){
        $sql = "SELECT songs.artist_id, artists.artist_name, COUNT(*) AS count FROM songs 
            INNER JOIN artists ON songs.artist_id = artists.artist_id GROUP BY songs.artist_id 
            ORDER BY count DESC LIMIT 10" ;

        $results = database::dbquery($this->connection, $sql, null);
        $results = $results->fetchAll();
        return $results;
    }

    function getTopSongs(){
        $sql = "SELECT songs.title, songs.artist_id, artists.artist_name, popularity FROM songs 
            INNER JOIN artists ON songs.artist_id = artists.artist_id 
            ORDER BY popularity DESC LIMIT 10" ;

        $results = database::dbquery($this->connection, $sql, null);
        $results = $results->fetchAll();
        return $results;
    }

    function getOneHitWonders(){
        $sql = "SELECT songs.title, songs.artist_id, artists.artist_name, popularity,
            COUNT(songs.artist_id) as count FROM songs 
            INNER JOIN artists ON songs.artist_id = artists.artist_id GROUP BY songs.artist_id
            HAVING count(songs.artist_id) = 1 ORDER BY songs.popularity DESC LIMIT 10 " ;

        $results = database::dbquery($this->connection, $sql, null);
        $results = $results->fetchAll();
        return $results;
    }

    function getAcoustic(){
        $sql = "SELECT songs.title, songs.artist_id, artists.artist_name, acousticness, duration
                FROM songs INNER JOIN artists ON songs.artist_id = artists.artist_id 
                WHERE songs.acousticness > 40 
                GROUP BY songs.artist_id ORDER BY songs.duration DESC LIMIT 10" ;

        $results = database::dbquery($this->connection, $sql, null);
        $results = $results->fetchAll();
        return $results;
    }

    function getClub(){
        $sql = "SELECT songs.title, songs.artist_id, artists.artist_name, danceability, 
                energy, danceability*1.6+energy*1.4 AS club
                FROM songs INNER JOIN artists ON songs.artist_id = artists.artist_id 
                WHERE songs.danceability > 80 
                ORDER BY club DESC LIMIT 10" ;

        $results = database::dbquery($this->connection, $sql, null);
        $results = $results->fetchAll();
        return $results;
    }

    function getRunning(){
        $sql = "SELECT songs.title, songs.artist_id, artists.artist_name, bpm, energy, valence,
                energy*1.3+valence*1.6 AS run
                FROM songs INNER JOIN artists ON songs.artist_id = artists.artist_id 
                WHERE bpm > 120 AND bpm < 125 
                ORDER BY run DESC LIMIT 10" ;

        $results = database::dbquery($this->connection, $sql, null);
        $results = $results->fetchAll();
        return $results;
    }

    function getStudying(){
        $sql = "SELECT songs.title, songs.artist_id, artists.artist_name, bpm, speechiness, valence, acousticness,
                acousticness*0.8+100 - speechiness+100-valence AS study
                FROM songs INNER JOIN artists ON songs.artist_id = artists.artist_id 
                WHERE bpm > 100 AND bpm < 115 AND speechiness > 1 AND speechiness <20
                ORDER BY study DESC LIMIT 10" ;

        $results = database::dbquery($this->connection, $sql, null);
        $results = $results->fetchAll();
        return $results;
    }

}

?>