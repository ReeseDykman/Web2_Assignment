<?php

    function generateArtistOptions($connection, $db){

        $sql = "SELECT * FROM artists";

        $results = $db->dbquery($connection, $sql, null);
        $results = $results->fetchAll();

        foreach($results as $row){
            echo "<option value='" . $row["artist_id"] . "' label='" . $row['artist_name'] . "'></option>";
        }
    }

    function generateGenreOptions($connection, $db){

        $sql = "SELECT * FROM genres";

        $results = $db->dbquery($connection, $sql, null);
        $results = $results->fetchAll();

        foreach($results as $row){
            echo "<option value='" . $row["genre_id"] . "' label='" . $row['genre_name'] . "'></option>";
        }
    }

    function getGenreSearch($db, $connection, $criteria){
         $sql = "SELECT title, song_id, artist_name, year, genre_name FROM songs
                INNER JOIN genres ON songs.genre_id = genres.genre_id
                INNER JOIN artists ON songs.artist_id = artists.artist_id
                WHERE songs.genre_id=" . $criteria;

        $results = $db->dbquery($connection, $sql, null);
        $results = $results->fetchAll();
        return $results;
    }
    function getTitleSearch($db, $connection, $criteria){
        $sql = "SELECT title, song_id, artist_name, year, genre_name FROM songs
                INNER JOIN genres ON songs.genre_id = genres.genre_id
                INNER JOIN artists ON songs.artist_id = artists.artist_id
                WHERE songs.title LIKE '%" . $criteria ."%'";

        $results = $db->dbquery($connection, $sql, null);
        $results = $results->fetchAll();
        return $results;
    }
    function getArtistSearch($db, $connection, $criteria){
        $sql = "SELECT title, song_id, artist_name, year, genre_name FROM songs
                INNER JOIN genres ON songs.genre_id = genres.genre_id
                INNER JOIN artists ON songs.artist_id = artists.artist_id
                WHERE songs.artist_id = " . $criteria;

        $results = $db->dbquery($connection, $sql, null);
        $results = $results->fetchAll();
        return $results;
    }
    function getYearSearch($db, $connection, $lessMore, $lessText, $moreText){
        if($lessMore == 'less'){
            $sql = "SELECT title, song_id, artist_name, year, genre_name FROM songs
                INNER JOIN genres ON songs.genre_id = genres.genre_id
                INNER JOIN artists ON songs.artist_id = artists.artist_id
                WHERE songs.year < " . $lessText;
        }
        else{
            $sql = "SELECT title, song_id, artist_name, year, genre_name FROM songs
                INNER JOIN genres ON songs.genre_id = genres.genre_id
                INNER JOIN artists ON songs.artist_id = artists.artist_id
                WHERE songs.year > " . $moreText;
        }

        $results = $db->dbquery($connection, $sql, null);
        $results = $results->fetchAll();
        return $results;
    }
    function generateSearchList($data){
        ?>
            <ul>
            <?php
            foreach($data as $row){?>
                <li>
                    <a href=single-song.php?id=<?=$row["song_id"]?>>
                    <?=$row['title'], $row['artist_name'], $row['year'], $row['genre_name']?>
                    </a>
                </li>
            <?php
            }
    }



?>