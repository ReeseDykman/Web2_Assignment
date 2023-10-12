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
    function generateHeader(){?>
        <div class="title"> 
                <h1>COMP 3521 Assign1</h1>
                <h2>Reese Dykman</h2>
            </div>
            <nav>
                <a href=home.php class="abutton">Home</a>
                <a href=search-results.php class="abutton">Browse</a>
                <a href=song-search.php class="abutton">Search</a>
                <a href=favourites.php class="abutton">Favourites</a>
                <a href=about-us.php class="abutton">About us</a>
            </nav>
<?php
    }
    function generateFooter(){ ?>
        <p>COMP 3523 - WebII</p>
        <p>Copyright Reese Dykman 2023</p>
        <p>https://github.com/ReeseDykman</p>
        <p>https://github.com/ReeseDykman/Web2_Assignment</p>
<?php
    }
    function generateSearchTable($data){ ?>

            <thead>
                <tr>
                    <th>Title</th>
                    <th>Artist</th>
                    <th>Year</th>
                    <th>Genre</th>
                    <th>Popularity</th>
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
                    <td><?=$row['popularity']?></td>
                    <td>
                        <a href=single-song.php?id=<?=$row["song_id"]?> class="bbutton">View</a>
                    </td>
                    <td><a href=includes/add-favourite.inc.php?id=<?=$row["song_id"]?> class="bbutton">Favourite</a></td>
                </tr>
            <?php
            } ?>
            </tbody>
<?php
    }
    function generateFavouritesTable($data){
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
                        <a href=single-song.php?id=<?=$row["song_id"]?> class="bbutton">View Song</a>
                    </td>
                    <td><a href=includes/remove-favourite.inc.php?id=<?=$row["song_id"]?> class="bbutton">Remove</a></td>
                </tr>
            <?php
            } ?>
            </tbody>
<?php
    }
    function GenerateHomeList($header, $data){
        if($header == "Top Genres"){ ?>
            <div class=purple-box>
                <h2><?=$header?></h2>
                <ul> 
            <?php
                foreach($data as $row){?>
                    <li><a href=search-results.php?searchBy=genre&genre=<?=$row['genre_id']?>><?=$row['genre_name']?></a></li>
            <?php
                } ?>
                </ul>
                </div>
            <?php
        }elseif($header == "Top Artists"){ ?>
            <div class=purple-box>
                <h2><?=$header?></h2>
                <ul> 
            <?php
                foreach($data as $row){?>
                    <li><a href=search-results.php?searchBy=artist&artist=<?=$row['artist_id']?>><?=$row['artist_name']?></a></li>
            <?php
                } ?>
                </ul>
                </div>
            <?php
        }else{ ?>
            <div class=purple-box>
                <h1><?=$header?></h1>
                <ul> 
            <?php
                foreach($data as $row){ 
                    $songTitle = $row['title'];
                    if(strlen($songTitle) > 25){
                        $songTitle = substr($songTitle,0,24) . "&hellip;";
                    }?>
                    <li><a href=single-song.php?id=<?=$row['song_id']?>><?=$songTitle?></a> - 
                        <?=$row['artist_name']?>
                    </li>
            <?php } ?>
                </ul>
            </div>
<?php
        }
    }


?>