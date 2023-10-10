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
    function generateSearchTable($data){
        ?>

            <thead>
                <tr>
                    <th>Title</th>
                    <th>Artist</th>
                    <th>Year</th>
                    <th>Genre</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach($data as $row){
                $songTitle = $row['title'];
                if(strlen($songTitle) > 25){
                    $songTitle = substr($songTitle,0,24) . "&hellip;";
                }
                ?>
                <tr>
                    <td>
                        <a href=single-song.php?id=<?=$row["song_id"]?>><?=$songTitle?></a>
                    </td>
                    <td><?=$row['artist_name']?></td>
                    <td><?=$row['year']?></td>
                    <td><?=$row['genre_name']?></td>
                    <td>
                        <a href=single-song.php?id=<?=$row["song_id"]?>>View Song</a>
                    </td>
                    <td><a href=favourites.php?id=<?=$row["song_id"]?>>Favourite</a></td>
                </tr>
            <?php
            } ?>
            </tbody>
    <?php
    }
?>