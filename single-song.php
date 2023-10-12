<?php
require_once './includes/db-connection-classes.inc.php';
require_once './includes/config.inc.php';
require_once './includes/songs-helper.php';

$db = new database();
$connection = $db->createConnection(DBCONNSTRING, DBUSER, DBPASS);
$songs = $db->dbquery($connection,"SELECT * FROM songs INNER JOIN artists ON songs.artist_id =
                        artists.artist_id  INNER JOIN
                        genres ON songs.genre_id = genres.genre_id INNER JOIN
                         types ON artist_type_id = type_id WHERE song_id = " . $_GET['id'], null);
$data = $songs->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Assignment 1</title>
        <meta name="author" content="Reese Dykman">
        <meta name="description" content="Single song page">
        <meta name="keywords" content="song, song info, song info page">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./styles/single-song.css" /> 
        <link rel="stylesheet" href="./styles/global-styles.css" /> 
    </head>

    <body>
        <header> 
            <?=generateHeader();?>
        </header>



        <div class="black-box">
            <div class=purple-box>
                <section id = "songInfoContainer">
                    <h1 id = "songTitle"><?=$data[0]["title"]?> </h1>
                    <h1 id = "artistName"> <?=$data[0]["artist_name"]?> </h1>
                    <h2 id = "genre">Genre: <?=$data[0]["genre_name"]?></h2>
                    <h2 id="type">Artist Type: <?=$data[0]["type_name"]?></h2>
                    <h2 id="year">Year: <?=$data[0]["year"]?></h2>
                    <h2 id="duration">Duration: <?=gmdate("i:s", $data[0]["duration"])?></h2>
                </section>
            </div>
            <div class=purple-box>
                <section id = "songStats">
                    <table>
                        <tr>
                            <th>BPM</th>
                            <td><?=$data[0]["bpm"]?></td>
                        </tr>
                        <tr>
                            <th>Energy</th>
                            <td><?=$data[0]["energy"]?></td>
                        </tr>
                        <tr>
                            <th>Danceability</th>
                            <td><?=$data[0]["danceability"]?></td>
                        </tr>
                        <tr>
                            <th>Liveness</th>
                            <td><?=$data[0]["liveness"]?></td>
                        </tr>
                        <tr>
                            <th>Valence</th>
                            <td><?=$data[0]["valence"]?></td>
                        </tr>
                        <tr>
                            <th>Acousticness</th>
                            <td><?=$data[0]["acousticness"]?></td>
                        </tr>
                        <tr>
                            <th>Speechiness</th>
                            <td><?=$data[0]["speechiness"]?></td>
                        </tr>
                        <tr>
                            <th>Popularity</th>
                            <td><?=$data[0]["popularity"]?></td>
                        </tr>
                    
                    </table>
                </section>
            </div>
        </div>
    </body>

    <footer><?=generateFooter()?></footer>



</html>
