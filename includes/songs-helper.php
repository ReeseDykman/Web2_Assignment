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