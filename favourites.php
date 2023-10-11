<?php
require_once './includes/db-connection-classes.inc.php';
require_once './includes/config.inc.php';
require_once './includes/songs-helper.php';

if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}

if (!isset($_SESSION["favourites"])){
    $_SESSION["favourites"] = [];
}

$favourites = $_SESSION["favourites"];

if(isset($_GET["id"])){
    $favourites[] = $_GET["id"];
    $_SESSION["favourites"] = $favourites;
}

$db = new database();
$connection = $db->createConnection(DBCONNSTRING, DBUSER, DBPASS);
$searcher = new songSearcher($connection);
$data = array();

$favourites = $_SESSION["favourites"];
foreach($favourites as $id){
    $data[] = $searcher->getFavourite($id)[0];
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Assignment 1</title>
        <meta name="author" content="Reese Dykman">
        <meta name="description" content="Song search page">
        <meta name="keywords" content="song, song search, song search page">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles\global-styles.css"/> 
        <link rel="stylesheet" href="styles\results.css"/>
    </head>

    <body>
        <header> 
            <?=generateHeader();?>
        </header>

        <div class="purple-box">
            <div id = 'top-favs'>
                <h1>Favourites Page</h1>
                <a href= "includes/remove-favourite.inc.php?id=all" class="abutton">Clear Favourites</a>
            </div>

            <h2>Browse Favourites</h2>

            <div class="table-wrapper">
                <table>
                    <?=generateFavouritesTable($data)?>
                </table>
            </div>
    
        </div>

        <footer> <?=generateFooter()?> </footer>


    </body>
</html>