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

?>