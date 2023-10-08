<?php
require_once './includes/db-connection-classes.inc.php';
require_once './includes/config.inc.php';
$db = new database();
$connection = $db->createConnection(DBCONNSTRING, DBUSER, DBPASS);
$songs = $db->dbquery($connection,"SELECT * FROM songs INNER JOIN artists ON songs.artist_id =
                        artists.artist_id  INNER JOIN
                        genres ON songs.genre_id = genres.genre_id INNER JOIN
                         types ON artist_type_id = type_id", null);
$data = $songs->fetchAll();
echo $data[0]["genre_name"];
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
    </head>

    <body>
    
    <h1><?=$data[0]["title"]?> </h1>
    <h2><?=$data[0]["artist_name"]?> , <?=$data[0]["genre_name"]?></h2>
    <h3><?=$data[0]["type_name"]?> , <?=$data[0]["year"]?> , <?=$data[0]["duration"]?></h3>


    </body>




</html>
